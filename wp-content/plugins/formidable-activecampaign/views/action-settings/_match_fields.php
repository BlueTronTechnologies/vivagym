<div class="frm_activecampaign_fields <?php echo $action_control->get_field_id( 'frm_activecampaign_fields' ) ?>">
<p><label class="frm_left_label">Email<span class="frm_required">*</span></label>

	<select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[email]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
	$selected = ( isset( $list_options['fields']['email'] ) && $list_options['fields']['email'] == $form_field->id ) ? ' selected="selected"' : '';
?>
		<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
		<?php } ?>
	</select>
</p>


<?php if ( !empty( $activecampaign_forms ) ) { ?>
	<p><label class="frm_left_label">ActiveCampaign Form</label>
	<select name="<?php echo $action_control->get_field_name( 'activecampaign_form' ) ?>">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>

 <?php   foreach ( $activecampaign_forms as $activecampaign_form ) {
		if ( is_object( $activecampaign_form ) ) {
			$selected = ( isset( $list_options['activecampaign_form'] ) && $list_options['activecampaign_form'] == $activecampaign_form->id ) ? ' selected="selected"' : '';
		?>
			 <option value="<?php echo $activecampaign_form->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $activecampaign_form->name, 40 ) ?></option>
		<?php
		}

	} ?>
	</select>
</p>
<?php } ?>

<p><label class="frm_left_label">First Name</label>

	<select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[first_name]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
	$selected = ( isset( $list_options['fields']['first_name'] ) && $list_options['fields']['first_name'] == $form_field->id ) ? ' selected="selected"' : '';
?>
		<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
		<?php } ?>
	</select>
</p>

<p><label class="frm_left_label">Last Name</label>

	<select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[last_name]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
	$selected = ( isset( $list_options['fields']['last_name'] ) && $list_options['fields']['last_name'] == $form_field->id ) ? ' selected="selected"' : '';
?>
		<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
		<?php } ?>
	</select>
</p>
<p><label class="frm_left_label">Phone</label>

	<select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[phone]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
	$selected = ( isset( $list_options['fields']['phone'] ) && $list_options['fields']['phone'] == $form_field->id ) ? ' selected="selected"' : '';
?>
		<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
		<?php } ?>
	</select>
</p>

<p><label class="frm_left_label">Tags</label>

	<select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[tags]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
	$selected = ( isset( $list_options['fields']['tags'] ) && $list_options['fields']['tags'] == $form_field->id ) ? ' selected="selected"' : '';
?>
		<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
		<?php } ?>
	</select>
</p>



<?php

// custom fields
if ( is_object( $list_fields ) && !is_wp_error( $list_fields ) ) {
	if ( !empty( $list_fields->result_code ) ) {
		//  returned empty
		if ( $list_fields->result_code =='1' ) {
			foreach ( $list_fields as $key => $list_field ) {
				if ( $key !='result_code' && $key !='result_message' && $key !='result_output' ) {

?>
				<p><label class="frm_left_label"><?php echo ucfirst( $list_field->title ); ?> </label>

	   <select name="<?php echo $action_control->get_field_name( 'fields' ) ?>[<?php echo $list_field->id; ?>]">
		<option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
		<?php foreach ( $form_fields as $form_field ) {
						$selected = ( isset( $list_options['fields'][$list_field->id ] ) && $list_options['fields'][$list_field->id] == $form_field->id ) ? ' selected="selected"' : '';
?>
				<option value="<?php echo $form_field->id ?>" <?php echo $selected ?>><?php echo FrmAppHelper::truncate( $form_field->name, 40 ) ?></option>
				<?php } ?>
			</select>
		</p>

			<?php
				}
			}
		}
	}
}
?>


<?php
$send_ip = !empty( $list_options['send_ip_address'] ) ? $list_options['send_ip_address']:'';
$instant_autoresponsder = !empty( $list_options['instant_autoresponsder'] ) ? $list_options['instant_autoresponsder'] :'';
?>
<p><label class="frm_left_label"><?php _e( 'Send IP Address', 'frmactivecampaign' ) ?></label>
	<select name="<?php echo $action_control->get_field_name( 'send_ip_address' ) ?>" id="<?php echo $action_control->get_field_id( 'send_ip_address' ) ?>">
		<option value="no"><?php _e( 'No', 'frmactivecampaign' ) ?></option>
		<option value="yes" <?php selected( $send_ip, 'yes' ); ?>><?php _e( 'Yes', 'frmactivecampaign' ) ?></option>
	</select>
</p>
<p><label class="frm_left_label"><?php _e( 'Instant Responder?', 'frmactivecampaign' ) ?></label>
	<select name="<?php echo $action_control->get_field_name( 'instant_autoresponsder' ) ?>" id="<?php echo $action_control->get_field_id( 'instant_autoresponsder' ) ?>">
		<option value="no"><?php _e( 'No', 'frmactivecampaign' ) ?></option>
		<option value="yes" <?php selected( $instant_autoresponsder, 'yes' ); ?>><?php _e( 'Yes', 'frmactivecampaign' ) ?></option>
	</select>
</p>

</div>
