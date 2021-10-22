<?php
					
if (isset($_GET['submit']))
	{
		$id=$_POST['item_id'];
		$quantity=$_POST['rec_qty'];
								

			if ($quantity == ''){
									
				header("Location: received_item.php?attempt=empty");
			}
			else
			{								
				$sql = mysql_query("INSERT INTO itemlist (quantity) values('$quantity')",$conn) or die("Could not execute the insert query.");
									
				mysql_query("UPDATE itemlist SET quantity='$qty' WHERE item_id='$id'");
				header("location: received_item.php?attempt=success");													

			}
	}
					
?>