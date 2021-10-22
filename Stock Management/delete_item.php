<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['item_id']) && is_numeric($_GET['item_id']))
	{
		$item_id = $_GET['item_id'];
		$result = mysqli_query($con,"DELETE FROM itemlist WHERE item_id=$item_id") or die(mysqli_error());
		header("Location: item.php");
	}

?>
