<?php
/*
Plugin Name: Formidable ActiveCampaign Addon
Description: Add users to your ActiveCampaign list from your Formidable forms
Version: 1.2.3
Plugin URI: http://webholics.org
Author URI: http://webholics.org
Author: Webholics
*/
// don't load directly
if ( !defined( 'ABSPATH' ) ) die( '-1' );

define( "FRM_ACTIVECAMPAIGN_URL", plugins_url()."/".basename( dirname( __FILE__ ) ) );
define( "FRM_ACTIVECAMPAIGN_DIR_URL", WP_PLUGIN_DIR."/".basename( dirname( __FILE__ ) ) );

define( 'FRM_ACTIVECAMPAIGN_STORE_URL', 'https://www.webholics.org' );
define('FRM_ACTIVECAMPAIGN_PLUGIN_FILE', __FILE__ );


// the name of your product. This should match the download name in EDD exactly
define( 'FRM_ACTIVECAMPAIGN_ITEM_NAME', 'Formidable ActiveCampaign Addon' );

if ( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    // load our custom updater
    include dirname( __FILE__ ) . '/models/EDD_SL_Plugin_Updater.php';
}

function frm_activecampaign_forms_autoloader( $class_name ) {
    $path = dirname( __FILE__ );

    // Only load Frm classes here
    if ( ! preg_match( '/^FrmActiveCampaign.+$/', $class_name ) ) {
        return;
    }

    if ( preg_match( '/^.+Controller$/', $class_name ) ) {
        $path .= '/controllers/'. $class_name .'.php';
    } else {
        $path .= '/models/'. $class_name .'.php';
    }

    if ( file_exists( $path ) ) {
        include $path;
    }
}

// Add the autoloader
spl_autoload_register( 'frm_activecampaign_forms_autoloader' );

// Load hooks
FrmActiveCampaignHooksController::load_hooks();


/**
 * Get lists from ActiveCampaign
 *
 * @author Aman Saini
 * @since  1.0
 * @return Campaigns Array
 */
function frm_fetch_activecampaign_lists( ) {
    $lists='';
    $frm_activecampaign_settings = new FrmActiveCampaignSettings();
    $api_key = $frm_activecampaign_settings->settings->api_key;
    $api_url = $frm_activecampaign_settings->settings->api_url;

    if ( !empty( $api_key ) && !empty( $api_url ) ) {
        $result = wp_remote_get( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=list_list&ids=all&api_output=json' );
        if ( !is_wp_error( $result ) ) {
            $response = json_decode( wp_remote_retrieve_body( $result ) );
            if ( $response->result_code!=0 ) {
                $lists = $response;
                set_transient( 'frm-activecampaign-lists', $lists, 60*60*60 );
            }
        }

    }
    return $lists;
}



/**
 * Get User defined Custom fields from ActiveCampaign
 *
 * @author Aman Saini
 * @since  1.0
 * @return Custom Fields Array
 */
function frm_fetch_activecampaign_custom_fields( ) {
    $fields ='';
    $frm_activecampaign_settings = new FrmActiveCampaignSettings();
    $api_key = $frm_activecampaign_settings->settings->api_key;
    $api_url = $frm_activecampaign_settings->settings->api_url;
    if ( !empty( $api_key ) && !empty( $api_url ) ) {
        $data = wp_remote_get( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=list_field_view&ids=all&api_output=json' );
        if ( !is_wp_error( $data ) ) {
            $response = json_decode( wp_remote_retrieve_body( $data ) );
            if ( $response->result_code!=0 ) {
                $fields = $response;
                set_transient( 'frm-activecampaign-custom-fields', $fields, 60*60*60 );
            }
        }
    }

    return $fields;
}

/**
 * Get list of from ActiveCampaign
 *
 * @author Aman Saini
 * @since  1.2.1
 * @return Forms Array
 */
function frm_fetch_activecampaign_forms( ) {
    $forms ='';
    $frm_activecampaign_settings = new FrmActiveCampaignSettings();
    $api_key = $frm_activecampaign_settings->settings->api_key;
    $api_url = $frm_activecampaign_settings->settings->api_url;
    if ( !empty( $api_key ) && !empty( $api_url ) ) {
        $data = wp_remote_get( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=form_getforms&api_output=json' );
        if ( !is_wp_error( $data ) ) {
            $response = json_decode( wp_remote_retrieve_body( $data ) );
            if ( $response->result_code!=0 ) {
                $forms = $response;
                set_transient( 'frm-activecampaign-forms', $forms, 60*60*60 );
            }
        }
    }

    return $forms;
}

/**
 * Add user to ActiveCampaign
 *
 * @author Aman Saini
 * @since  1.0
 * @return Status Code
 */
function frm_subscribe_to_activecampaign_list( $subscriber ) {

    $frm_activecampaign_settings = new FrmActiveCampaignSettings();
    $api_key = $frm_activecampaign_settings->settings->api_key;
    $api_url = $frm_activecampaign_settings->settings->api_url;

    if ( !empty( $api_key ) && !empty( $api_url ) ) {

        //check if contact already exists
        $result = wp_remote_get( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=contact_view_email&api_output=json&email='.$subscriber['email'] ) ;
        if ( !is_wp_error( $result ) ) {
            $response = json_decode( wp_remote_retrieve_body( $result ) );

            // Contact Exists --  Edit Contact
            if ( $response->result_code!=0 ) {
                $subscriber['overwrite']='0';
                $subscriber['id']=$response->id;
                $body =http_build_query( $subscriber, '', '&' );
                $response = wp_remote_retrieve_body( wp_remote_post( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=contact_edit&api_output=json' , array( 'headers'=>array( 'content-type'=>'application/x-www-form-urlencoded' ), 'body'=>$body ) ) );
                $status = json_decode( $response );

            }else {
                $body =http_build_query( $subscriber, '', '&' );
                // Add new contact
                $response = wp_remote_retrieve_body( wp_remote_post( $api_url.'/admin/api.php?api_key='.$api_key.'&api_action=contact_add&api_output=json' , array( 'headers'=>array( 'content-type'=>'application/x-www-form-urlencoded' ), 'body'=>$body ) ) );
                $status = json_decode( $response );

            }
        }
      //  var_dump($status);
        //return $status;
    }

}
