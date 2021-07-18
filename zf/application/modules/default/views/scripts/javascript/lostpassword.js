<?php header('Content-type: text/javascript'); ?>
$( document ).ready(function() {
	function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-_])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return pattern.test(emailAddress);
	};
	$( "#submit" ).click(function( event ) {
		var emailaddress = $("#emailField").val();
		if( !isValidEmailAddress( emailaddress ) ) { alert("<?= $this->lostpassword_failed ?>"); } else {
	$.post("/zf/public/json/lostpassword", $("#loginForm").serialize(), function(response) { if (response.success==true) { document.location = '/zf/public/'; } else { alert('<?= $this->lostpassword_msg ?>'); } }, "json");
		}
	});
});
