<?php

class FrmActiveCampaignSettings{
    var $settings;

    function __construct(){
        $this->set_default_options();
    }

    function default_options(){
        return array(
            'api_key'       => '',
            'api_url'       => '',
            'plugin_license_key'    => '' //html, text, or mobile
        );
    }

    function set_default_options($settings=false){
        $default_settings = $this->default_options();

        if(!$settings)
            $settings = $this->get_options();
        else if($settings === true)
            $settings = new stdClass();

        if(!isset($this->settings))
            $this->settings = new stdClass();

        foreach($default_settings as $setting => $default){
            if ( is_object($settings) && isset($settings->{$setting}) ) {
                $this->settings->{$setting} = $settings->{$setting};
            }

            if ( !isset($this->settings->{$setting}) ) {
                $this->settings->{$setting} = $default;
            }
        }
    }

    function get_options(){
        $settings = get_option('frm_activecampaign_options');

        if(!is_object($settings)){
            if($settings){ //workaround for W3 total cache conflict
                $settings = unserialize(serialize($settings));
            }else{
                // If unserializing didn't work
                if(!is_object($settings)){
                    if($settings) //workaround for W3 total cache conflict
                        $settings = unserialize(serialize($settings));
                    else
                        $settings = $this->set_default_options(true);
                    $this->store();
                }
            }
        }else{
            $this->set_default_options($settings);
        }

        return $this->settings;
    }

    function update($params){
        $settings = $this->default_options();

        foreach ( $settings as $setting => $default ) {
            if ( isset($params['frm_activecampaign_'. $setting]) ) {
                $this->settings->{$setting} = $params['frm_activecampaign_'. $setting];
            }
            unset($setting, $default);
        }
    }

    function store(){

        $old_key ='';
        $old_settings = get_option('frm_activecampaign_options');
        if(!empty($old_settings->plugin_license_key)){
            $old_key = $old_settings->plugin_license_key;
        }


        // Save the posted value in the database
        update_option( 'frm_activecampaign_options', $this->settings);

          // activate license
        $settings = get_option('frm_activecampaign_options');

        $status = get_option( 'frm_activecampaign_license_status' );
        // new key has been entered
        if ( $old_key != $settings->plugin_license_key ) {

            // Activate the license if needed
            // data to send in our API request
            $api_params = array(
                'edd_action'=> 'activate_license',
                'license'  => $settings->plugin_license_key,
                'item_name' => urlencode( FRM_ACTIVECAMPAIGN_ITEM_NAME )
            );
            // Call the custom API.
            $response = wp_remote_get( add_query_arg( $api_params, FRM_ACTIVECAMPAIGN_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

            // make sure the response came back okay
            if ( is_wp_error( $response ) )
                return false;

            // decode the license data
            $license_data = json_decode( wp_remote_retrieve_body( $response ) );

            // $license_data->license will be either "active" or "inactive"

            update_option( 'frm_activecampaign_license_status', $license_data->license );

        }

    }


}