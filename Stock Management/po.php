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
  alert("Please enter PO no.");
  return false;
  }
}
</script>
<script language="javascript"type="text/javascript">
function validate()
{
var x=document.forms["form1"]["supplier_name"].value;
if (x==null || x=="")
  {
  alert("Select supplier name.");
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
					<div class="label">Purchase order </div>
					<hr />
					<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">PO successfully saved.</div>
							<?php
							}
							if($attempt == "empty")
							{
							?>
							<div class="error">You did not select items to purchase.</div>
							<?php
							}
						}
					?>
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="order_details.php">
						<table>
							<tr>
								<td class="search">Search PO # :</td>
								<td><input type="text" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
					<div id="add_supplierform">
						<form name="form1" method="POST" onsubmit="return validate()" action="add_po.php">
							<table>															
								<tr>
									<td><b>Select Supplier :</b></td>
									<td  class="add">
										<?php
											
											$sql = mysql_query("select * from supplier where supplier_id=supplier_id ");											
											echo '<select name="supplier_name" >';
											echo '<option value="">None...</option>';
											 while($row = mysql_fetch_assoc($sql))
											{
											echo '<option value="'. $row['supplier_name'].'">'. $row['supplier_name'].'</option>';
											}
											echo'</select>';
										?>
										<input type="submit" name="submit" style="cursor:pointer;" value="Veiw items"/>
									</td>
								</tr>																						
							</table>					
						</form>
						<br />
					</div>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
