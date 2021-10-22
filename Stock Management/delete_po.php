<?php require_once ("includes/connection.php"); ?>
<?php
if (isset($_GET['po_id']) && is_numeric($_GET['po_id']))
	{
		$po_id = $_GET['po_id'];
		$result = mysql_query("DELETE FROM purchase_order WHERE po_id = $po_id") or die(mysql_error());
		header("Location: po.php");
	}

?>
