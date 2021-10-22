<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>


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
						<li><a href="po.php"class="current">Purchased Order</a></li>						
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
					<div class="label">Order details</div>
					<hr />
					
					<div id="add_supplierform">
						<form name="form1" method="POST" action="order_details.php">
							<table>
								<tr>
									<td><input type="hidden" name="id"></td>
								</tr>
								<tr>
									<td><b>PO # :</b></td>
									<td><input type="text" readonly="readonly" size="15px" name="po_id" 
										value="<?php
										$id = mysql_query("select MAX(po_id) as max_po_id from purchase_item");										
										$row = mysql_fetch_array($id);
										echo $row['max_po_id'] + 1;  										
										?>">
									</td>
								</tr>								
								<tr>
									<td><b>Supplier :</b></td>
									<td class="add">
									<input type="text" size="30px" name="supplier_name" readonly="readonly"
										value="<?php
										$supplier = mysql_query("select * from supplier ");										
										$row = mysql_fetch_array($supplier);
										echo $row=$_POST['supplier_name'];  										
										?>">
									</td>										
								</tr>
							</table>
							<br />
							<?php

							function formatMoney($number, $fractional=false) {
								if ($fractional) {
									$number = sprintf('%.2f', $number);
								}
								while (true) {
									$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
									if ($replaced != $number) {
										$number = $replaced;
									} else {
										break;
									}
								}
								return $number;
							}	
							?>
							<table class="inventory_table" >
								<tr>
									<th width="20">Code</th>
									<th>Description</th>
									<th width="60">Quantity</th>
									<th width="60">Unit</th>
									<th width="70">Price</th>									
								</tr>
								<?php								
								$supplier=$_POST['supplier_name'];
								$sql = mysql_query('SELECT * FROM itemlist WHERE supplier_name="'. $supplier .'" ');									 																	
								while($row = mysql_fetch_array($sql))
								{
								$item_code=$row["item_code"];
								$unit=$row["unit_name"];
								$price=$row["price"];
								?>
								<tr>
									<td><input type="text" name='item_code[]' size="5px" value="<?php echo $item_code; ?>" style="border:0px;" readonly="readonly"/></td>
									<td style="text-align:left"><input type="checkbox" name='order[]' value="<?php echo $row["item_name"]; ?>"/><?php echo $row["item_name"];?></td>
									<td><input type="text" name="ord_qty[]" onkeyup="changeVal(this)" size="5px" /></td>
									<td><input type="text" name='unit[]' size="5px" value="<?php echo $unit; ?>" style="border:0px;" readonly="readonly"/></td>
									<td><input type="text" name='price[]' size="8px" value="<?php echo formatMoney($price, true); ?>" style="border:0px;" readonly="readonly"/></td>			
								</tr>
								<?php
								}
								?>
							</table>
							<p  class="add">
							<input type="submit" name="submit" style="cursor:pointer" value="Save request">
							</p>
						</form>						
					</div>
					<p class="add">
						<a href="po.php"><input type="Button" name="Btncancel" style="cursor:pointer;" value="Back"></a>						
					</p>
				</td>
				
			</tr>
	</table>
<?php require('includes/footer.php');?>
