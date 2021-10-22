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

$qqs= $_GET['qqs'];
 echo "
 <select class='form-control' onchange='showUsss(this.value)' name='item_name' required='required'  >";
 echo" <option value=''>Select Item Name</option>";
$sqll="SELECT * FROM itemlist WHERE supplier_name = '".$qqs."'";
$resultt = mysqli_query($con,$sqll);
while($rowws = mysqli_fetch_array($resultt)) {
	
  echo "
  <option value=\"".htmlspecialchars($rowws['item_name'])."\">".$rowws['item_name']."    </option>
 ";
}

echo"</select>";

?>

</body>
</html>
