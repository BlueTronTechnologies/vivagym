    <table class="form-table">
     <tr class="form-field" valign="top">
            <td width="200px"><label><?php _e('Plugin License key', 'frmactivecampaign') ?></label></td>
        	<td>
                <input  style="max-width:300px" type="text" name="frm_activecampaign_plugin_license_key" id="frm_activecampaign_plugin_license_key" value="<?php echo $frm_activecampaign_settings->settings->plugin_license_key ?>" class="frm_long_input" />

                 <?php if(get_option( 'frm_activecampaign_license_status')=='valid'){ ?>
                 <img  style="vertical-align:middle" src="<?php echo FRM_ACTIVECAMPAIGN_URL.'/css/active.png' ?>"> Active
             <?php    }else{ ?>
                 <img  style="vertical-align:middle" src="<?php echo FRM_ACTIVECAMPAIGN_URL.'/css/inactive.png' ?>"> Inactive
              <?php   } ?>
               <br/><span class="frm_icon_font frm_activecampaign_resp">Enter a valid license key to get plugins updates in future. </span>
        	</td>
        </tr>
         <tr class="form-field" valign="top">
            <td width="200px"><label><?php _e('ActiveCampaign API Url', 'frmactivecampaign') ?></label></td>
            <td>
                <input type="text" name="frm_activecampaign_api_url" id="frm_activecampaign_api_url" value="<?php echo $frm_activecampaign_settings->settings->api_url ?>" class="frm_long_input" />
              <br/>  <span class="frm_icon_font frm_activecampaign_resp">Add full url e.g https://abctest748.api-us1.com </span>

            </td>
        </tr>
        <tr class="form-field" valign="top">
            <td width="200px"><label><?php _e('ActiveCampaign API Key', 'frmactivecampaign') ?></label></td>
        	<td>
                <input type="text" name="frm_activecampaign_api_key" id="frm_activecampaign_api_key" value="<?php echo $frm_activecampaign_settings->settings->api_key ?>" class="frm_long_input" />
              <br/>  <span class="frm_icon_font frm_activecampaign_resp">Enter the ActiveCampaign API key. API key is visible on your ActiveCampaign dashboard</span>
        	</td>
        </tr>

    </table>

