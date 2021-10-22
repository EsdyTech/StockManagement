<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php error_reporting(0);?>

  <?php
require_once('includes/connection.php');

if($_POST['monthly']=='Requested Items'){

echo '<br>
<div align="center">Requested Items Report For:<strong>"'.$_POST['dayfrom'].'"</strong>&nbsp;&nbsp;To:<strong>"'.$_POST['dayto'].'"
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

$a=$_POST['dayfrom'];
$b=$_POST['dayto'];
 
$result1 = mysqli_query($con,"SELECT * FROM request WHERE date BETWEEN '$a' AND '$b' AND name='$username'");

while($row = mysqli_fetch_array($result1))
{
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
    echo '<td>';
	echo '</div></td>';
  echo '</tr>';
 }
 
 echo'<tr>
    <td colspan="9" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
	
	  <div align="center">
	    

      </div></td>
  </tr>
</table><br /><br />

<div align="center"><a href="user_report.php">Back </a></div>
<br /><br />';
 
 
 
}



?>  
