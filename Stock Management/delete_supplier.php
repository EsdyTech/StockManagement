<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['supplier_id']) && is_numeric($_GET['supplier_id']))
	{
		$supplier_id = $_GET['supplier_id'];
		$result = mysqli_query($con,"DELETE FROM supplier WHERE supplier_id=$supplier_id") or die(mysqli_error());
		header("Location: supplier.php");
	}

?>
