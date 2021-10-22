<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
<script language="javascript"type="text/javascript">
function validateForm()
{
var x=document.forms["formsearch"]["search"].value;
if (x==null || x=="")
  {
  alert("Please enter PO #");
  return false;
  }
}
</script>	
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">User</a></li>
						<li><a href="supplier.php">Suppliers</a></li>
						<li><a href="received_item.php"class="current">Recieved Items</a></li>
						<li><a href="item.php">Items</a></li>
						<li><a href="request_items.php">Request Items</a></li>
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
					<div class="label">Ordered items</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_order.php">
						<table>
							<tr>
								<td class="search">Search PO # :</td>
								<td><input type="text" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form><br />
					
					<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Record successfully updated.</div>
							<?php
							}
							if($attempt == "empty")
							{
							?>
							<div class="error">Enter quantity.</div>
							<?php
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
									<th width="60">Price</th>
									<th width="80">Received Qty</th>
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
								
								echo '<td>'. '
								<form name="form" method="POST" action="save_qty.php">
								<input type="hidden" name="item_id" />
								<input type="text" size="6px" name="rec_qty[]" />								
								'.'</td>';	
								echo '</tr>';
								
								}
								echo '<tr>';
								echo '<td colspan="5" style="text-align:right;"></td>';
								echo '<td>'.'<input name="submit" type="submit" style="cursor:pointer;" value="Save" />'.'</td>';
								echo '</form>';
								echo '</tr>';
								?>
							</table><br />
					
					
					<p class="add">
						<a href="received_item.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
