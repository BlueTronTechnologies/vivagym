(function($) {
    $(function() {
        $('body').on('click', '.clrcache-activecampaign', function(event) {
            event.preventDefault()
            window.location.search += '&frmclrcache=1';
        })
    });
})(jQuery);