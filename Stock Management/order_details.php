<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>

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
					<div class="label">Order details </div>
					<hr />
					<?php

						if (isset($_POST['submit']))
						{
						$po_id=$_POST['po_id'];
						$supplier=$_POST['supplier_name'];						
						$unit=$_POST['unit'];								
						$price=$_POST['price'];
						$quantity=$_POST['ord_qty'];
						$item_code=$_POST["item_code"];
						$items = $_POST['order'];
												
						for($i=0; $i < count($_POST['order']);$i++) {
							
						$sql = mysql_query("INSERT INTO purchase_item (po_id,item_code,item_name,supplier_name,ord_qty,unit,price,total,ord_date) 
											values('$po_id','".$_POST['item_code'][$i]."','".$_POST['order'][$i]."','$supplier','".$_POST['ord_qty'][$i]."','".$_POST['unit'][$i]."','".$_POST['price'][$i]."','$total',curdate()) ") 
											or die ("could not execute query");
							
						}

						if($sql){
						
						header("Location: po.php?attempt=success");
						}else{
						
						header("Location: po.php?attempt=empty");
						}															
						}
					?>
					<div id="add_supplierform">						
						<table>
							<tr>
								<td><b>PO #:</b></td>
								<td><?php
									$search=$_POST["search"];
									$query="select * from purchase_item where po_id like '%$search%'limit 1";
									$result=mysql_query($query);									 																	
									while($row = mysql_fetch_array($result))
									{
									echo $row["po_id"];
									}									
									?>
								</td>
							</tr>
							<tr>
								<td><b>Supplier:</b></td>
								<td><?php
									$search=$_POST["search"];
									$query="select * from purchase_item where po_id like '%$search%'limit 1";
									$result=mysql_query($query);									 																	
									while($row = mysql_fetch_array($result))
									{
									echo $row["supplier_name"];
									}									
									?>
								</td>
							</tr>
							<tr>
								<td width="100"><b>Date ordered:</b></td>
								<td><?php echo date("m/d/Y"); ?></td>
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
						<table class="inventory_table" id="alternatecolor">
								<tr>
									<th width="50">Code</th>
									<th>Description</th>
									<th width="70">Ordered Qty</th>
									<th width="60">Unit</th>
									<th width="70">Price</th>
									<th width="70">Total</th>
								</tr>
								<?php
								$search=$_POST["search"];
								$query="select * from purchase_item where po_id like '%$search%'";
								$result=mysql_query($query);									 																	
								while($row = mysql_fetch_array($result))
								{																
								echo '<tr>';
								echo '<td>'. $row["item_code"] .'</td>';
								echo '<td>'. $row["item_name"] .'</td>';
								echo '<td>'. $row["ord_qty"] .'</td>';
								echo '<td>'. $row["unit"] .'</td>';
								
								echo '<td>';
								$p=$row['price'];		
								echo formatMoney($p, true);'</td>';
																
								echo '<td>';
								$p=$row['ord_qty']*$row['price'];
								echo formatMoney($p, true);'</td>';								
								echo '</tr>';								
								}
								?>
								<tr>
									<td colspan="5" style="text-align:right"><b>Grand total:</b></td>
									<td><b><?php
										$sql = mysql_query("SELECT supplier_name,SUM(total) FROM purchase_item GROUP BY supplier_name");
										while($row = mysql_fetch_array($sql))
										{
											$total=$row['SUM(total)'];
											echo formatMoney($total, true);							 
										}
										?></b>
									</td>
								</tr>
							</table>
							<p class="add">
								<a href="print_request.php"><input type="button" style="cursor:pointer;"  value="Print requests"/></a>
							</p>
							<p class="add">
								<a href="po.php"><input type="Button" name="Btncancel" style="cursor:pointer;" value="Back to PO"></a>
							</p>
					</div>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
