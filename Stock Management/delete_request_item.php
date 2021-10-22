<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		$result = mysqli_query($con,"DELETE FROM request WHERE id=$id") or die(mysqli_error());
		header("Location: request_items.php");
	}

?>
