
<table class="form-table frm-no-margin">
<tbody>
<tr class="activecampaign_list">
    <td>
    <p>
        <?php
        if ( $lists ) { ?>
        <label class="frm_left_label" style="clear:none;"><?php _e('List', 'frmactivecampaign') ?> <span class="frm_required">*</span></label>
        <select name="<?php echo $action_control->get_field_name('list_id') ?>">
            <option value=""><?php _e( '&mdash; Select &mdash;' ); ?></option>
            <?php foreach($lists as  $key => $list){ ?>
          <?php  if ( $key !='result_code' && $key !='result_message' && $key !='result_output' ){ ?>
            <option value="<?php echo $list->id; ?>" <?php selected($list_id,$list->id) ?>><?php echo FrmAppHelper::truncate($list->name, 40) ?></option>
            <?php } ?>
            <?php } ?>
        </select>
         <a href="javascript:void(0)" class="clrcache-activecampaign button"  >Clear Cache</a>
        <?php } else {
            _e('No ActiveCampaign list found, Please check API key is correct or try again ', 'frmactivecampaign');
        } ?>
    </p>
<div class="clear"></div>

<?php
//if ( isset($list_fields) && is_object($list_fields) ) {
    include(dirname(__FILE__) .'/_match_fields.php');
//} else { ?>
<div class="frm_activecampaign_fields"></div>
<?php
//} ?>

</td>
</tr>
</tbody>
</table>
