<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>



<?php require_once('includes/connection.php');?>



<?php
error_reporting(0);

$ssq=$_GET['ssq'];

$query="SELECT * FROM itemlist WHERE item_name = '".$ssq."'";
$res = mysqli_query($con,$query);
while($rowwsi= mysqli_fetch_array($res)) {
	
  echo "
  <input type='text' name='qtystck' id='qtystck' readonly value='".$rowwsi['quantity']."' placeholder='Quantity' />
 ";
}








?>
</body>
</html>
