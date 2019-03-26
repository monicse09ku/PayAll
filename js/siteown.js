function show_alert(alert_class, message, alert_box = '#alert-box') {
    var html = '<div class="alert ' +alert_class+ ' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+ message+'</div>';
    $(alert_box).html(html);
	$(alert_box).show();
    
    setTimeout(function() {
	    $(alert_box).fadeOut();	    
	}, 2000);
}

function check_valid_email(email) {
	let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}