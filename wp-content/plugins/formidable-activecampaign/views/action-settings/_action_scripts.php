
<script type="text/javascript">
jQuery(document).ready(function($){
$('#frm_notification_settings').on('change', '.frm_single_activecampaign_settings select[name$="[list_id]"]', frmActiveCampaignFields);

});

function frmActiveCampaignFields(){
    var form_id = jQuery('input[name="id"]').val();
    var id = jQuery(this).val();
    var key = jQuery(this).closest('.frm_single_activecampaign_settings').data('actionkey');
    var div = jQuery(this).closest('.activecampaign_list').find('.frm_activecampaign_fields');
    div.empty().append('<span class="spinner frm_activecampaign_loading_field"></span>');
    jQuery('.frm_activecampaign_loading_field').fadeIn('slow');
    jQuery.ajax({
        type:'POST',url:ajaxurl,
        data:{action:'frm_activecampaign_match_fields', form_id:form_id, list_id:id, action_key:key},
        success:function(html){
            div.replaceWith(html).fadeIn('slow');
        }
    });
}


</script>