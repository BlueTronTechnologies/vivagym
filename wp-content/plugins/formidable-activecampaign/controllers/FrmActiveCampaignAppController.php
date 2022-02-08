<?php

class FrmActiveCampaignAppController {
    public static $min_version = '2.0';

    public static function min_version_notice() {
        $frm_version = is_callable( 'FrmAppHelper::plugin_version' ) ? FrmAppHelper::plugin_version() : 0;

        // check if Formidable meets minimum requirements
        if ( version_compare( $frm_version, self::$min_version, '>=' ) ) {
            return;
        }

        $wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );
        echo '<tr class="plugin-update-tr active"><th colspan="' . $wp_list_table->get_column_count() . '" class="check-column plugin-update colspanchange"><div class="update-message">'.
            __( 'You are running an outdated version of Formidable. This plugin needs Formidable v2.0 + to work correctly.', 'frmactivecampaign' ) .
            '</div></td></tr>';
    }

    public static function include_updater() {

        $frm_activecampaign_settings = new FrmActiveCampaignSettings();
        $license_key = $frm_activecampaign_settings->settings->plugin_license_key;

        // setup the updater
        $edd_updater = new EDD_SL_Plugin_Updater( FRM_ACTIVECAMPAIGN_STORE_URL, FRM_ACTIVECAMPAIGN_PLUGIN_FILE, array(
                'version'  => '1.2.3',
                'license'  => $license_key,
                'item_name' => FRM_ACTIVECAMPAIGN_ITEM_NAME,
                'author'  => 'Aman Saini'
            )
        );

        if ( isset( $_GET['frmclrcache'] ) ) {
            delete_transient( 'frm-activecampaign-lists' );
            delete_transient( 'frm-activecampaign-custom-fields' );
            delete_transient( 'frm-activecampaign-forms' );
        }

    }

    public static function path() {
        return dirname( dirname( __FILE__ ) );
    }



    public static function hidden_form_fields( $form, $form_action ) {
        $form->options = maybe_unserialize( $form->options );
        if ( !isset( $form->options['activecampaign'] ) || !$form->options['activecampaign'] || !isset( $form->options['activecampaign_list'] ) || !is_array( $form->options['activecampaign_list'] ) ) {
            return;
        }

        echo '<input type="hidden" name="frm_activecampaign" value="1"/>'."\n";

        if ( $form_action != 'update' ) {
            return;
        }

        global $frm_vars, $frm_editing_entry;
        $list = reset( $form->options['activecampaign_list'] );
        $field_id = $list['fields']['email'];
        $edit_id = ( is_array( $frm_vars ) && isset( $frm_vars['editing_entry'] ) ) ? $frm_vars['editing_entry'] : $frm_editing_entry;
        $email = FrmEntryMeta::get_entry_meta( (int)$edit_id, $field_id );

        echo '<input type="hidden" name="frm_activecampaign_email" value="'. esc_attr( $email ) .'"/>'."\n";
    }

    public static function trigger_activecampaign( $action, $entry, $form ) {
        $settings = $action->post_content;
        self::send_to_activecampaign( $entry, $form, $settings );
    }



    public static function send_to_activecampaign( $entry, $form, $settings ) {

        $entry_id = $entry->id;
        $vars = array();

        foreach ( $settings['fields'] as $field_tag => $field_id ) {


            if ( empty( $field_id ) ) {
                // don't sent an empty value
                continue;
            }

            $vars[$field_tag] = ( isset( $_POST['item_meta'][$field_id] ) ) ? $_POST['item_meta'][$field_id] : '';

            $field = FrmField::getOne( $field_id );
            if ( $field->type == 'user_id' ) {
                $user_data = get_userdata( $vars[$field_tag] );
                if ( $field_tag == 'email' ) {
                    $vars[$field_tag] = $user_data->user_email;
                } else if ( $field_tag == 'first_name' ) {
                        $vars[$field_tag] = $user_data->first_name;
                    } else if ( $field_tag == 'last_name' ) {
                        $vars[$field_tag] = $user_data->last_name;
                    } else {
                    $vars[$field_tag] = $user_info->user_login;
                }
            }else {
                //var_dump($vars[$field_tag]);
                //$vars[$field_tag] = FrmEntriesHelper::display_value( $vars[$field_tag], $field, array( 'type' => $field->type, 'truncate' => false, 'entry_id' => $entry_id ) );
              // $vars1[$field_tag] = FrmEntriesHelper::get_posted_value(  $field, $vars[$field_tag],array( 'type' => $field->type, 'truncate' => false, 'entry_id' => $entry_id ) );
            }


            if ( is_array( $vars[$field_tag] ) ) {
                $vars[$field_tag] = implode( ', ', $vars[$field_tag] );
            }
        }


        if ( ! isset( $vars['email'] ) || empty( $settings['list_id'] ) ) {
            //no email address or list is mapped
            return;
        }
        $subscriber = array();


        if ( $settings['send_ip_address'] == 'yes' ) {
            $subscriber['ip4'] =$entry->ip;
        }

        if ( $settings['instant_autoresponsder'] == 'yes' ) {
            $subscriber['instantresponders['.$settings['list_id'].']'] =1;
        }

        if ( !empty( $settings['list_id'] ) ) {
            $subscriber['p['.$settings['list_id'].']'] = $settings['list_id'];
        }

        $subscriber['status['.$settings['list_id'].']'] =1;

        $update_existing = false;
        $email_field = $vars['email'];
        if ( isset( $_POST['frm_activecampaign_email'] ) ) { //we are editing the entry
            if ( is_email( $_POST['frm_activecampaign_email'] ) ) {
                $update_existing = true;
                $email_field = $_POST['frm_activecampaign_email'];
            } else if ( is_numeric( $_POST['frm_activecampaign_email'] ) && isset( $user_data ) ) {
                    $f = FrmField::getOne( (int) $settings['fields']['email'] );

                    if ( $f && $f->type == 'user_id' ) {
                        if ( (int) $settings['fields']['email'] == (int) $_POST['frm_activecampaign_email'] ) {
                            $update_existing = true;
                            $email_field = $user_data->user_email;
                        } else {
                            //user ID field was changed. Allow it?
                        }
                    }
                }
        }

       // print_r( $vars ); die;

        // email
        $subscriber['email']=$email_field;

        //first name
        $subscriber['first_name'] = !empty( $vars['first_name'] )?' '.$vars['first_name']:'';

        //last name
        $subscriber['last_name']=!empty( $vars['last_name'] )?' '.$vars['last_name']:'';

        //phone
        $subscriber['phone'] =!empty( $vars['phone'] )?' '.$vars['phone']:'';

        //tags
        $subscriber['tags'] =!empty( $vars['tags'] )?' '.$vars['tags']:'';

        // Activecampaign Form
        $subscriber['form'] =!empty( $settings['activecampaign_form'] )?' '.$settings['activecampaign_form']:'';

        // custom fields
        foreach ( $vars as $custom_field_id => $value ) {
            if ( $custom_field_id !='first_name' && $custom_field_id !='last_name' && $custom_field_id !='phone' && $custom_field_id !='email'&& $custom_field_id !='tags' && $custom_field_id !='activecampaign_form' ) {
                $subscriber['field['.$custom_field_id.',0]'] = $value;
            }
        }

        frm_subscribe_to_activecampaign_list( $subscriber );
    }


}
