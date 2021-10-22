<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
<script type="text/javascript">
function changeVal(t1){
if (!/^[\d-'.']*$/.test(t1.value)) {//validates for numbers
alert('Only valid numbers allowed!');
t1.value = t1.value.replace(/[^\d-'.']/g,'');
}
}
</script>
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">User</a></li>
						<li><a href="supplier.php">Suppliers</a></li>
						<li><a href="received_item.php">Recieved Items</a></li>
						<li><a href="item.php">Items</a></li>
						<li><a href="request_items.php">Request Items</a></li>
						<li><a href="po.php">Purchased Order</a></li>						
						<li><a href="borrow.php"class="current">Borrow</a></li>
						<li><a href="report.php">Reports</a></li>
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">Barrow item form</div>
					<hr />
					<?php
						if(isset($attempt))
						{
							if($attempt == "saved")
							{
							?>
							<div  class="success">Record successfully saved.</div>
							<?php
							}
							elseif($attempt == "empty")
							{
							?>
							<div  class="error">You did not select item to borrow.</div>
							<?php
							}
						}
					?>
					<?php

						if (isset($_POST['submit']))
						{
						$bar_no=$_POST['id'];
						$employee=$_POST['employee'];
						$quantity=$_POST['bar_qty'];
						$item_code=$_POST["item_code"];
						$items = $_POST['borrow'];
						$status = $_POST['status'];
												
						for($i=0; $i < count($_POST['borrow']);$i++) {
							
						$sql = mysql_query("INSERT INTO borrowed_item (id,employee_name,item_code,item_name,quantity,date_borrow,status) 
											values('$bar_no','$employee','".$item_code[$i]."','".$items[$i]."','".$quantity[$i]."',now(),'$status') ") 
											or die ("could not execute query");
							
						}

						if($sql){
						
						header("Location: borrow.php?attempt=saved");
						}else{
						
						header("Location: borrow.php?attempt=empty");
						}															
						}
					?>
					<form name="form1" method="POST" action="">
					<table>
						<tr>
							<td style="font-family:arial;font-size:15px;"><b>Borrow # :</b></td>
							<td><input type="text" size="15px" readonly="readonly" name="id"  value="<?php
								$id = mysql_query("select MAX(id) as max_id from borrowed_item");										
								$row = mysql_fetch_array($id);
								echo $row['max_id'] + 1;  										
								?>"/>
							</td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:15px;"><b>Date borrow :</b></td>
							<td>
							<input type="text"size="15px" name="date" readonly="readonly" value="<?php echo date("Y-m-d"); ?>"/>
							<input type="hidden" name="employee"  value="<?php echo $username; ?>"/>
							<input type="hidden" name="status"  value="Borrowed"/>
							</td>
						</tr>										
					</table>		

					<br />

						<table class="inventory_table" >
							<tr>
								<th width="20">Code</th>
								<th>Description</th>
								<th width="60">Quantity</th>									
							</tr>
							<?php								
							$sql = mysql_query('SELECT * FROM itemlist ');									 																	
							while($row = mysql_fetch_array($sql))
							{
							$item_code=$row["item_code"];
							$item=$row["item_name"];
							?>
							<tr>
								<td><input type="text" name='item_code[]' size="5px" value="<?php echo $item_code; ?>" style="border:0px;" readonly="readonly"/></td>
								<td style="text-align:left"><input type="checkbox" name='borrow[]' value="<?php echo $item; ?>"/><?php echo $item;?></td>
								<td><input type="text" name="bar_qty[]" onkeyup="changeVal(this)" size="5px" /></td>			
							</tr>
							<?php
							}
							?>
						</table>
						<p  class="add">
							<input type="submit" name="submit" style="cursor:pointer" value="Borrow">
						</p>
					</form>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
