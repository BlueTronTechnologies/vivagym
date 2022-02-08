	function ac_event(event, eventdata) {
    return ajax({
        url: activecampaignevent.ajax_url,
		type: 'POST',
        data: {
			action: 'ac_event',
			event: event,
            eventdata: eventdata
		},
		success: function (response) {
			console.log('response', response);
		}
    });
    
    function ajax(options) {
        var request = new XMLHttpRequest();
        var url = options.url;
        var data = encodeData(options.data);
        
        if (options.type === 'GET') {
            url = url + (data.length ? '?' + data : '');
        }
        request.open(options.type, options.url, true);
        request.onreadystatechange = onreadystatechange;
        
        if (options.type === 'POST') {
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send(data);
        } else {
            request.send(null);
        }
        return;
        
        function onreadystatechange() {
            if (request.readyState === 4 && request.status === 200){
                options.success(request.responseText);
            }
        }
        function encodeData(data) {
            var query = [];
            for (var key in data) {
                var field = encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
                query.push(field);
            }
            return query.join('&');
        }
    }
}