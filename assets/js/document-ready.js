$(document).ready(function(){
	$('#contact_form').validate({
	'rules': <?php echo json_encode($form_rules); ?>
	});
});
