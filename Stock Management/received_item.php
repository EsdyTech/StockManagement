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
						<li><a href="received_item.php"class="current">Received Items</a></li>
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
					<div class="label">Add new item</div>
					<hr />
					<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Quantity successfully saved.</div>
							<?php
							}
						}
					?>
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_order.php">
						<table>
							<tr>
								<td class="search">Search PO # :</td>
								<td><input type="text" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					<br />
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
