<?php

class FrmActiveCampaignHooksController {

    public static function load_hooks() {
        add_action( 'frm_entry_form', 'FrmActiveCampaignAppController::hidden_form_fields', 10, 2 );

        // 2.0 hooks
        add_action( 'frm_trigger_activecampaign_action', 'FrmActiveCampaignAppController::trigger_activecampaign', 10, 3 );
        add_action( 'frm_registered_form_actions', 'FrmActiveCampaignSettingsController::register_actions' );


        self::load_admin_hooks();
    }

    public static function load_admin_hooks() {
        if ( ! is_admin() ) {
            return;
        }

        add_action('admin_init', 'FrmActiveCampaignAppController::include_updater', 1);
        add_action( 'admin_enqueue_scripts', 'FrmActiveCampaignHooksController::add_scripts' );
        add_action( 'after_plugin_row_formidable-activecampaign/formidable-activecampaign.php', 'FrmActiveCampaignAppController::min_version_notice' );

        add_action( 'frm_add_settings_section', 'FrmActiveCampaignSettingsController::add_settings_section' );
        add_action( 'wp_ajax_frm_activecampaign_match_fields', 'FrmActiveCampaignSettingsController::match_fields' );



    }

    public static function add_scripts() {

        wp_enqueue_style( 'frmactivecampaign', FRM_ACTIVECAMPAIGN_URL.'/css/frmactivecampaign.css' );
        wp_enqueue_script( 'frmactivecampaign', FRM_ACTIVECAMPAIGN_URL.'/js/frmactivecampaign.js' );

    }

}
