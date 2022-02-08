<?php

class FrmActiveCampaignSettingsController {

    public static function add_settings_section( $sections ) {
        $sections['activecampaign'] = array( 'class' => 'FrmActiveCampaignSettingsController', 'function' => 'route' );
        return $sections;
    }



    public static function match_fields() {
        $form_id = isset( $_POST['form_id'] ) ? (int) $_POST['form_id'] : false;
        $list_id = isset( $_POST['list_id'] ) ? $_POST['list_id'] : false;
        if ( ! $form_id || ! $list_id ) {
            die();
        }
        $list_fields = frm_fetch_activecampaign_custom_fields($list_id);
        $form_fields = FrmField::getAll( 'fi.form_id='. (int) $form_id ." and fi.type not in ('break', 'divider', 'html', 'captcha', 'form')", 'field_order' );

        if ( isset( $_POST['action_key'] ) ) {
            $action_control = FrmFormActionsController::get_form_actions( 'activecampaign' );
            $action_control->_set( $_POST['action_key'] );
            include FrmActiveCampaignAppController::path() .'/views/action-settings/_match_fields.php';
        }

        die();
    }


    public static function register_actions( $actions ) {
        $actions['activecampaign'] = 'FrmActiveCampaignAction';

        include_once FrmActiveCampaignAppController::path() . '/models/FrmActiveCampaignAction.php';

        return $actions;
    }

    public static function display_form() {
        $frm_activecampaign_settings = new FrmActiveCampaignSettings();

        if ( method_exists( 'FrmAppHelper', 'plugin_version' ) )
            $frm_version = FrmAppHelper::plugin_version();
        else
            global $frm_version; //version fallback < v1.07.02

        require_once FrmActiveCampaignAppController::path() . '/views/settings/form.php';
    }

    public static function process_form() {
        $frm_activecampaign_settings = new FrmActiveCampaignSettings();

        //$errors = $frm_activecampaign_settings->validate($_POST,array());
        $errors = array();

        $frm_activecampaign_settings->update( $_POST );

        if ( empty( $errors ) ) {
            $frm_activecampaign_settings->store();
            $message = __( 'Settings Saved', 'frmactivecampaign' );
        }

        require_once FrmActiveCampaignAppController::path() . '/views/settings/form.php';
    }

    public static function route() {
        $action = FrmAppHelper::get_param( 'action' );
        if ( $action == 'process-form' )
            return self::process_form();
        else
            return self::display_form();
    }




}
