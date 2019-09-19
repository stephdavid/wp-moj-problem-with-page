<?php require 'form.libs.php'; ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>What is wrong with this page</title>
	<link rel="stylesheet" href="style.css"/>
	<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="form-validation.js"></script>
	<script>
		//this function will get the user info variables and pass them to the hidden form fields
		function getinfo()
		{	
		document.getElementById("res").value = (screen.width+"x"+screen.height)
		document.getElementById("browser").value = (navigator.appName)
		document.getElementById("version").value = (navigator.appVersion)
		document.getElementById("os").value = (navigator.platform)
		document.getElementById("useragent").value = (navigator.userAgent)
		document.getElementById("language").value = (navigator.language)
		document.getElementById("url").value = (window.location.href)
		}
	</script>

	<script>
		$(document).ready(function(){
			$('#contact_form').validate({
				'rules': <?php echo json_encode($form_rules); ?>
			});
		});
	</script>

</head>
<body onLoad="getinfo()"> <!-- get all user browser info when page loads -->
<!--
	<script>alert("User-agent: " + navigator.userAgent);</script>
	<script>alert("Browser: " + navigator.appName);</script>
	<script>alert("Browser version: " + navigator.appVersion);</script>
	<script>alert("Operating System API: " + navigator.platform);</script>
	<script>alert("Resolution: " + screen.width+"x"+screen.height);</script>
	<script>alert("Language: " + navigator.language);</script>
	<script>alert("URL: " + window.location.href);</script>
 -->
	<script>
		function myFunction() {
  			var d = new Date();
  			var n = d.getTimezoneOffset();
  			document.getElementById("timezone").innerHTML = n;
		}
		// n.b. the returned value is not a constant, because of the practice of using Daylight Saving Time.
		// From the end of March to the end of October the offset for the UK(GMT) will display as -60
	</script>
	<h1>What is wrong with this page?</h1>
	<p>Help us improve the experience for yourself on future visits or for other visitors. Please don’t include any personal information.</p>
	<form name="contact_form" id="contact_form" method="post" action="form.submit.php">
	<!--<form name="reportProblem" action="comment.html" method="post"> -->
	<fieldset>
			<legend>Information about the problem you experienced</legend>
			<label for="first">What were you doing and what went wrong? (This information must be provided)</label><br>
	  		<textarea rows="6" cols="100" name="first" id="first"></textarea><br>
			<label for="second">What could we improve?</label><br>
	  		<textarea rows="6" cols="100" name="second" id="second"></textarea><br>
		</fieldset>
			
		<button type="submit">Submit</button>
		
		<input type="hidden" id="url" name="url" value="">
		<input type="hidden" id="browser" name="browser" value="">
		<input type="hidden" name="version" id="version" value="">
		<input type="hidden" id="res" name="res" value="">
		<input type="hidden" id="os" name="os" value="">
		<input type="hidden" id="useragent" name="useragent" value="">
		<input type="hidden" id="language" name="language" value="">
		<input type="hidden" id="timezone" name="timezone" value="">
	</form>

</body>
</html> 
