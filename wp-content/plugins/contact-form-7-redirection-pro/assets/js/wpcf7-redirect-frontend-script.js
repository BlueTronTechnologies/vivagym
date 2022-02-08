var wpcf7_redirect;

function Wpcf7_redirect(){

    this.init = function(){
        this.wpcf7_redirect_mailsent_handler();
    };

    this.wpcf7_redirect_mailsent_handler = function() {
    	document.addEventListener( 'wpcf7mailsent', function( event ) {
            var form = jQuery(event.target);

            jQuery(document.body).trigger('wpcf7r-mailsent' , [event] );

            if( typeof event.detail.apiResponse != 'undefined' && event.detail.apiResponse ){
                var apiResponse = event.detail.apiResponse;

                //handle api response
                if( typeof apiResponse.api_url_request != 'undefined' && apiResponse.api_url_request ){
                    wpcf7_redirect.handle_api_action( apiResponse.api_url_request );
                }

                //handle api response
                if( typeof apiResponse.api_json_xml_request != 'undefined' && apiResponse.api_json_xml_request ){
                    wpcf7_redirect.handle_api_action( apiResponse.api_json_xml_request  );
                }
                //handle fire javascript action
                if( typeof apiResponse.fire_script != 'undefined' && apiResponse.fire_script ){
                    wpcf7_redirect.handle_javascript_action( apiResponse.fire_script );
                }
                //catch redirect to paypal
                if( typeof apiResponse.redirect_to_paypal != 'undefined' && apiResponse.redirect_to_paypal ){
                    wpcf7_redirect.handle_redirect_action( apiResponse.redirect_to_paypal );
                }
                //catch redirect action
                if( typeof apiResponse.redirect != 'undefined' && apiResponse.redirect ){
                    wpcf7_redirect.handle_redirect_action( apiResponse.redirect );
                }
            }

    	}, false );

        document.addEventListener( 'wpcf7invalid', function( event ) {
            var form = jQuery(event.target);

            jQuery(document.body).trigger('wpcf7r-invalid' , [event] );

            if( typeof event.detail.apiResponse != 'undefined' && event.detail.apiResponse ){
                response = event.detail.apiResponse;
                if( response.invalidFields ){
                    //support for multistep by ninja
                    wpcf7_redirect.ninja_multistep_mov_to_invalid_tab(event,response);
                }
            }
        });
    };

    this.handle_api_action = function( send_to_api_result , request ){
        jQuery.each(send_to_api_result, function(k,v){
            if( ! v.result_javascript ){
                return;
            }

            response = typeof v.api_response != 'undefined' ? v.api_response : '';
            request = typeof v.request != 'undefined' ? v.request : '';

            eval(v.result_javascript);
        });

    };

    this.ninja_multistep_mov_to_invalid_tab = function( event,response ){
        if( jQuery('.fieldset-cf7mls-wrapper').length ){
            var form = jQuery(event.target);
            var first_invalid_field = response.invalidFields[0];
            var parent_step = jQuery(first_invalid_field.into).parents('fieldset');

            form.find('.fieldset-cf7mls').removeClass('cf7mls_current_fs');

            parent_step.addClass('cf7mls_current_fs').removeClass('cf7mls_back_fs');

            if (form.find('.cf7mls_progress_bar').length) {
                form.find('.cf7mls_progress_bar li').eq(form.find("fieldset.fieldset-cf7mls").index(previous_fs)).addClass("current");
                form.find('.cf7mls_progress_bar li').eq(form.find("fieldset.fieldset-cf7mls").index(current_fs)).removeClass("active current");
            }

        }
    }
    this.handle_redirect_action = function( redirect ){

        jQuery(document.body).trigger('wpcf7r-handle_redirect_action' , [redirect] );

        jQuery.each(redirect , function( k, v ){
            var redirect_url = typeof v.redirect_url != 'undefined' && v.redirect_url ? v.redirect_url : '';
            var type = typeof v.type != 'undefined' && v.type ? v.type : '';

            if( redirect_url && type == 'redirect' ){
                window.location = redirect_url;
            }else if( redirect_url && type == 'new_tab' ){
                window.open( redirect_url );
            }

        });
    };

    this.handle_javascript_action = function( scripts ){
        jQuery(document.body).trigger('wpcf7r-handle_javascript_action' , [scripts] );

        jQuery.each( scripts , function(k,script){
            eval(script); //not using user input
        });
    };

    this.htmlspecialchars_decode = function( string ) {
    	var map = {
            '&amp;': '&',
            '&#038;': "&",
            '&lt;': '<',
            '&gt;': '>',
            '&quot;': '"',
            '&#039;': "'",
            '&#8217;': "’",
            '&#8216;': "‘",
            '&#8211;': "–",
            '&#8212;': "—",
            '&#8230;': "…",
            '&#8221;': '”'
        };

        return string.replace(/\&[\w\d\#]{2,5}\;/g, function(m) { return map[m]; });
    };

    this.init();
}

jQuery(document).ready(function() {
    wpcf7_redirect = new Wpcf7_redirect();
});
