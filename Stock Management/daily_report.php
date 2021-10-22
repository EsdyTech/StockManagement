<?php require_once('includes/header.php');?>
<?php error_reporting(0);?>

  <?php
require_once('includes/connection.php');

//$a=$_POST['dayfrom'];
if($_POST['daily']=='New Items'){

echo '<br>
<div align="center">New Item Report For:<strong>"'.$_POST['dayto'].'"</strong>
<br />
    </strong></div>';


echo'<table border="1px" class="inventory_table" id="alternatecolor" style="margin:0 auto;"	>
  <tr>
    <th width="174">Code</th>
    <th width="294">Name</th>
    <th width="294">Brand</th>
    <th width="294">Qty</th>
    <th width="294">Unit</th>
    <th width="294">Price</th>
    <th width="294">Type</th>
    <th width="294">Category</th>
    <th width="294">Supplier Name </th>
	    <th width="85">Date</th>
    <th width="127">Total</th>
  </tr>';


$b=$_POST['dayto'];
 
$result1 = mysqli_query($con,"SELECT * FROM itemlist WHERE dateadded='$b'");
$grandTotal =0;
while($row = mysqli_fetch_array($result1))
{
  $totalPrice = $row['price'] * $row['quantity'];
  $grandTotal += $totalPrice;

  echo '<tr>';
    echo '<td>'.$row['item_code'].'</td>';
    echo '<td>'.$row['item_name'].'</td>';
    echo '<td>'.$row['brand_name'].'</td>';
    echo '<td>'.$row['quantity'].'</td>';
    echo '<td>'.$row['unit_name'].'</td>';
    echo '<td>'.$row['price'].'</td>';
    echo '<td>'.$row['type_name'].'</td>';
    echo '<td>'.$row['cat_name'].'</td>';
	echo '<td>'.$row['supplier_name'].'</td>';
	    echo '<td>'.$row['dateadded'].'</td>';

    echo '<td>'.$totalPrice.'</td>';
  echo '</tr>';
 }
 
 
 echo'<tr>
    <td colspan="10" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
	'.$grandTotal.'
	  <div align="center">
	    

      </div></td>
  </tr>
</table><br /><br />

<div align="center"><a href="admin_report.php">Back </a></div>
<br /><br />';
 
 
}






else if($_POST['daily']=='Supplied Items'){

echo '<br>
<div align="center">Supplied Items Report For:<strong>"'.$_POST['dayto'].'"</strong>
<br />
    </strong></div>';


echo'<table border="1px" class="inventory_table" id="alternatecolor" style="margin:0 auto;"	>
  <tr>
	 <th width="85">Name</th>
    <th width="174">Purpose</th>
    <th width="294">Item Name </th>
	 <th width="294">Unit</th>
	  <th width="294">Quantity</th>
	   <th width="294">Price</th>
	    <th width="294">Status</th>
		 <th width="294">Requested Date</th>
		     <th width="85">Supplied Date</th>
    <th width="127">Total</th>
  </tr>';

$b=$_POST['dayto'];
 
$result1 = mysqli_query($con,"SELECT * FROM supplied WHERE supplied_date='$b'");
$grandTotal = 0;
while($row = mysqli_fetch_array($result1))
{
  $totalPrice = $row['req_price'] * $row['req_quantity'];
  $grandTotal += $totalPrice;
  echo '<tr>';
	echo '<td>'.$row['req_name'].'</td>';
    echo '<td>'.$row['req_purpose'].'</td>';
	 echo '<td>'.$row['req_item'].'</td>';
	echo '<td>'.$row['req_unit'].'</td>';
	echo '<td>'.$row['req_quantity'].'</td>';
	echo '<td>'.$row['req_price'].'</td>';
	echo '<td>'.$row['req_status'].'</td>';
	echo '<td>'.$row['req_date'].'</td>';
	 echo '<td>'.$row['supplied_date'].'</td>';

    echo '<td>'.$totalPrice.'</td>';
  echo '</tr>';
 }
 
 echo'<tr>
    <td colspan="9" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
'.$grandTotal.'
	  <div align="center">
	    

      </div></td>
  </tr>
</table><br /><br />

<div align="center"><a href="admin_report.php">Back </a></div>
<br /><br />';
 
 
 
}



else if($_POST['daily']=='Added Items'){

echo '<br>
<div align="center">Added Items Report For:<strong>"'.$_POST['dayto'].'"</strong>
<br />
    </strong></div>';


echo'<table border="1px" class="inventory_table" id="alternatecolor" style="margin:0 auto;"	>
  <tr>
	 <th width="300">Name</th>
    <th width="300">Item Name</th>
    <th width="174">Quantity in stock</th>
	 <th width="174">Quantity Added</th>
	  <th width="174">New Quantity in stock</th>
		 <th width="174">Date Added</th>
    <th width="127">Total</th>
  </tr>';

$b=$_POST['dayto'];
 
$result1 = mysqli_query($con,"SELECT * FROM added_item WHERE date_added='$b'");
$grandTotal = 0;

while($row = mysqli_fetch_array($result1))
{
  $grandTotal +=  $row['new_qty'];
  echo '<tr>';
    echo '<td>'.$row['supplier_name'].'</td>';
	echo '<td>'.$row['item_name'].'</td>';
    echo '<td>'.$row['qty_stck'].'</td>';
	 echo '<td>'.$row['qty_added'].'</td>';
	echo '<td>'.$row['new_qty'].'</td>';
	echo '<td>'.$row['date_added'].'</td>';
    echo '<td>'.$row['new_qty'].'</td>';
  echo '</tr>';
 }
 
 echo'<tr>
    <td colspan="6" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
	'.$grandTotal.'
	  <div align="center">
	    

      </div></td>
  </tr>
</table><br /><br />

<div align="center"><a href="admin_report.php">Back </a></div>
<br /><br />';
 
 
 
}



else if($_POST['daily']=='Requested Items'){

echo '<br>
<div align="center">Requested Items Report For:<strong>"'.$_POST['dayto'].'"</strong>
<br />
    </strong></div>';


echo'<table border="1px" class="inventory_table" id="alternatecolor" style="margin:0 auto;"	>
  <tr>
	 <th width="300">Request Name</th>
    <th width="300">Purpose</th>
    <th width="174">Item Name</th>
	 <th width="174">Quantity</th>
	  <th width="174">Unit</th>
		 <th width="174">Price</th>
		  <th width="174">Total Price</th>
		   <th width="174">Date Requested</th>
		    <th width="174">Status</th>
    <th width="127">Total</th>
  </tr>';

$b=$_POST['dayto'];
 
$result1 = mysqli_query($con,"SELECT * FROM request WHERE date='$b'");
$grandTotal = 0;
while($row = mysqli_fetch_array($result1))
{
  $grandTotal += $row['totalprice'];

  echo '<tr>';
    echo '<td>'.$row['name'].'</td>';
	echo '<td>'.$row['subject'].'</td>';
    echo '<td>'.$row['item_name'].'</td>';
	 echo '<td>'.$row['quantity'].'</td>';
	echo '<td>'.$row['unit'].'</td>';
	echo '<td>'.$row['price'].'</td>';
	echo '<td>'.$row['totalprice'].'</td>';
	echo '<td>'.$row['date'].'</td>';
	echo '<td>'.$row['status'].'</td>';
    echo '<td>'.$row['totalprice'].'</td>';
  echo '</tr>';
 }
 
 echo'<tr>
    <td colspan="9" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
	'.$grandTotal.'
	  <div align="center">
	    

      </div></td>
  </tr>
</table><br /><br />

<div align="center"><a href="admin_report.php">Back </a></div>
<br /><br />';
 
 
 
}



?>  
