<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
if(isset($_GET['id']))
{
$_SESSION['id']=$_GET["id"];
}

?>

	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">User</a></li>
						<li><a href="supplier.php">Suppliers</a></li>
						<li><a href="received_item.php">Received Item</a></li>
						<li><a href="item.php">Items</a></li>
						<li><a href="request_items.php"class="current">Request Items</a></li>
						<li><a href="po.php">Purchased Order</a></li>						
						<li><a href="borrow.php">Borrow</a></li>
						<li><a href="report.php">Reports</a></li>
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">Request Details</div>
					<hr />
                    
                    
                   <?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Successful</div>
							<?php
							}
							
							elseif($attempt == "empty")
							{
							?>
                     	  <div  class="error">Change Status of Requests</div>
							<?php
							}
						}
					?>
                    
                    
                    
                    
					<?php
					$idd=$_SESSION['id'];
					$sql = mysqli_query($con,"select * from request where id='$idd' ");											
					$row = mysqli_fetch_assoc($sql);
					$id=$row['id'];	
					$name=$row['name'];	
					$unit=$row['unit'];	
					$date=$row['date'];	
					$price=$row['price'];	
					$totalprice=$row['totalprice'];	
						$subj=$row['subject'];	
							$item_name=$row['item_name'];	
								$qty=$row['quantity'];					
						$status=$row['status'];	
					
					
					?>
					<fieldset>
					<legend><div class="legend"><b>View request details</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="post" action="view_requests2.php">
							<table>
								<tr>
									<td><input type="hidden" name="req_id" value="<?php echo $id; ?>"/></td>
								</tr>
                                <tr>
									<td><input type="hidden" name="unit" value="<?php echo $unit; ?>"/></td>
								</tr>
                                <tr>
									<td><input type="hidden" name="date" value="<?php echo $date; ?>"/></td>
								</tr>
                                <tr>
                                <td>Request Name:</td>
									<td><input type="text" name="request_name" readonly="readonly" value="<?php echo $name; ?>"/></td>
								</tr>
								<tr>
									<td>Purpose:</td>
									<td><input type="text"  size="30px" name="subject" readonly="readonly" value="<?php echo $subj; ?>"></td>
								</tr>
								<tr>
									<td>Item name :</td>
									<td><input type="text" name="item_name" readonly="readonly" value="<?php echo $item_name; ?>"/></td>
								</tr>
                                <tr>
									<td>Price:</td>
									<td><input type="text" name="price" readonly="readonly" value="<?php echo $price; ?>"/></td>
								</tr>
                                <tr>
                                <td>Quantity Requested:</td>
									<td><input type="text" name="qty_req" readonly="readonly" value="<?php echo $qty; ?>"/></td>
								</tr>
                                <td>Total Amount:</td>
									<td><input type="text" name="totalprice" readonly="readonly" value="<?php echo $totalprice; ?>"/></td>
								</tr>
                                <tr>
									<td>Status:</td>
									<td><select name="status">
                                     <option value="<?php echo $status;?>"><?php echo $status;?></option>
                                      <option value="Supplied">Supplied</option>
                                    </select>
                                    
                                    </select>
                                    </td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="submit" value="Add to Supplied"/></td>
								</tr>		
							</table>		
						</form>
					</div>
					</fieldset>
					<p class="add">
						<a href="request_items.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
					<?php
					
			if(isset($_POST['submit']))
		{
				$req_id=$_POST['req_id'];	
				$price=$_POST['price'];	
				$unit=$_POST['unit'];	
				$date=$_POST['date'];	
				$totalprice=$_POST['totalprice'];	
				$request_name=$_POST['request_name'];	
				$subj = $_POST['subject'];
				$item_name=$_POST['item_name'];	
				$qty_req=$_POST['qty_req'];
				$status=$_POST['status'];
				$datee = date("Y-m-d");
	
	if($status == 'Pending')
		{	
			echo'<div  class="error">Change Status of Requests</div>';


		}
	else{
		

		

				$insert = "INSERT INTO supplied (req_id,req_name,req_purpose,req_item,req_unit,req_quantity,req_price,req_status,req_date,supplied_date) values('$req_id','$request_name','$subj','$item_name','$unit','$qty_req','$price','$status','$date','$datee')"; 
				
				 $rees=mysqli_query($con,$insert);
		if (mysqli_affected_rows($con) == 1)
		 {
		 
		$qry= "SELECT * FROM itemlist WHERE item_name='$item_name'";
   $res= mysqli_query($con,$qry);		
	 $rows = mysqli_fetch_assoc($res);
	$qtystck=$rows['quantity'];
	$remqty=$qtystck-$qty_req;
		
		 $qrys= "UPDATE itemlist SET quantity='$remqty' WHERE item_name='$item_name'";
	   $ress=mysqli_query($con,$qrys);
	     if(mysqli_affected_rows($con)==1){
							 
		 $qryw= "UPDATE request SET status='$status' WHERE id='$req_id'";
	   $resw=mysqli_query($con,$qryw);
	     if(mysqli_affected_rows($con)==1){
		 
			echo'	<div class="success">Record successfully updated.</div>';
			

			}
		
		
		}
		
		 }
		 else{
		 echo "Problem in SQL query". mysqli_error($con);
			}
			
}

}

                 
              
					
					
					
					
					?>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
