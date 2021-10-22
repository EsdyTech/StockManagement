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
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="auth_available_item.php">Available Items</a></li>
						<li><a href="auth_received_item.php"class="current">Received Items</a></li>
						<li><a href="auth_supplier.php">Suppliers</a></li>
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
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="auth_search_order.php">
						<table>
							<tr>
								<td class="search">Search PO no. :</td>
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
