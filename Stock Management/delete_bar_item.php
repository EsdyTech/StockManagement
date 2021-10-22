<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['bar_id']) && is_numeric($_GET['bar_id']))
	{
		$id = $_GET['bar_id'];
		$result = mysql_query("DELETE FROM borrow WHERE bar_id=$id") or die(mysql_error());
		header("Location: borrow.php");
	}

?>
