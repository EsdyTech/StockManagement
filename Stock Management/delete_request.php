<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['req_id']) && is_numeric($_GET['req_id']))
	{
		$id = $_GET['req_id'];
		$result = mysqli_query($con,"DELETE FROM request WHERE id=$id") or die(mysqli_error());
		header("Location: request_form.php");
	}

?>
