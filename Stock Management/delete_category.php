<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['cat_id']) && is_numeric($_GET['cat_id']))
	{
		$cat_id = $_GET['cat_id'];
		$result = mysqli_query($con,"DELETE FROM category WHERE cat_id=$cat_id") or die(mysqli_error());
		header("Location: category.php");
	}

?>
