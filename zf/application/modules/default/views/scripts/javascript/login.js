<?php header('Content-type: text/javascript'); ?>
<?php if ($this->redirect=="") { ?>
$( document ).ready(function() {
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-_])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return pattern.test(emailAddress);
	};
	$( "#submit" ).click(function( event ) {
		var emailaddress = $("#emailField").val();
		if( !isValidEmailAddress( emailaddress ) ) { alert("<?= $this->lostpassword_failed ?>"); } else {
	$.post("/zf/public/default/index/login", $("#loginForm").serialize(), function(response) { if (response.success==true) { document.location = '/zf/public/default/index/secure'; } else { alert('<?= $this->identify_msg ?>'); } }, "json");
		}
	});
});
<?php } else { ?>
$( document ).ready(function() {
	function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-_])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return pattern.test(emailAddress);
	};
	$( "#submit" ).click(function( event ) {
	var emailaddress = $("#emailField").val();
	if( !isValidEmailAddress( emailaddress ) ) { alert("<?= $this->lostpassword_failed ?>"); } else {
	$.post("/zf/public/default/index/login", $("#loginForm").serialize(), function(response) { if (response.success==true) { document.location = '/zf/public/defeult/index/secure?os_location=<?= $this->redirect ?>'; } else { alert('<?= $this->identify_msg ?>'); } }, "json");
	}
	});
});
<?php } ?>