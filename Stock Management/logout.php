<?php
session_start();
session_destroy();
echo "<script language=\"Javascript\" type=\"text/javascript\">
	alert(\"You are logged out.\"); 
	window.location=\"index.php\";
	</script>";

?>