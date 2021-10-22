<?php require_once('includes/connection.php');?>
<?php

if (isset($_POST['submit']))
{
	$rec_qty=$_POST['rec_qty'];
	$id=$_POST['item_code'];
											
	for($i=0; $i < count($_POST['rec_qty']);$i++) {
							
	$sql = mysql_query("INSERT INTO itemlist (quantity) values('".$_POST['rec_qty'][$i]."')") or die ("could not execute query");	
	
	$update = "UPDATE itemlist set quantity='$_POST[rec_qty][$i]' where item_code='$id'";
	
	if($sql){
						
		header("Location: received_item.php?attempt=success");
	}
	else{
						
		header("Location: received_item.php?attempt=empty");
	}
	}
															
}
?>