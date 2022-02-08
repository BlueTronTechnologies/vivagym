<?php

class FrmActiveCampaignAction extends FrmFormAction {

	function __construct() {
		$action_ops = array(
			'classes'   => 'frm_activecampaign_icon frm_icon_font',
			'limit'     => 99,
			'active'    => true,
			'priority'  => 25,
			'event'     => array( 'create', 'update' ),
		);

		$this->FrmFormAction( 'activecampaign', __( 'Add to ActiveCampaign', 'frmactivecampaign' ), $action_ops );
	}

	function form( $form_action, $args = array() ) {
		extract( $args );

		$list_options = $form_action->post_content;
		$list_id = $list_options['list_id'];

		$lists = get_transient( 'frm-activecampaign-lists' );

		if ( false === $lists || empty( $lists ) ) {
			$lists = frm_fetch_activecampaign_lists();
		}

		$list_fields = get_transient( 'frm-activecampaign-custom-fields' );

		if ( false === $list_fields || empty( $list_fields ) ) {
			$list_fields = frm_fetch_activecampaign_custom_fields();
		}

		$activecampaign_forms = get_transient( 'frm-activecampaign-forms' );

		if ( false === $activecampaign_forms || empty( $activecampaign_forms ) ) {
			$activecampaign_forms = frm_fetch_activecampaign_forms();
		}

		$form_fields = FrmField::getAll( 'fi.form_id='. (int) $form->id ." and fi.type not in ('break', 'divider', 'end_divider', 'html', 'captcha', 'form')", 'field_order' );

		if ( !is_object( $lists ) || is_wp_error( $lists ) ) {
			$lists=false;
		}

		$action_control = $this;

		include FrmActiveCampaignAppController::path() .'/views/action-settings/activecampaign_options.php';
		//include_once(FrmActiveCampaignAppController::path() .'/views/action-settings/_action_scripts.php');
	}

	function get_defaults() {
		return array(
			'list_id'=> '',
			'fields' => array(),
			'send_ip_address'=>'no',
			'optin'=>'no'
		);
	}

	function get_switch_fields() {
		return array(
			'fields' => array(),
			'groups' => array( array( 'id' ) ),
		);
	}

}
