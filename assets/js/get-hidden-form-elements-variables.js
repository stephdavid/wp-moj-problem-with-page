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

var res = '<?php echo $res ?>';
var browser = '<?php echo $browser ?>';
var version = '<?php echo $version ?>';
var os = '<?php echo $version ?>';
var useragent = '<?php echo $useragent ?>';
var language = '<?php echo $language ?>';



