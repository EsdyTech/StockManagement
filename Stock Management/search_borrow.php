<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
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
					<form name="formsearch" method="post"onsubmit="return validateForm()"  action="search_borrow.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" name="search" size="40px" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form><br />			
					<table class="inventory_table" id="alternatecolor">
						<tr>
							<th width="30px">Id</th>
							<th>Barrow Item</th>
							<th>Person</th>
							<th>Dept</th>
							<th>Position</th>
							<th width="30px">Quantity</th>
							<th width="80px">Date Barrow</th>
							<th width="80px">Date Return</th>
							<th>Action</th>
						</tr>
						<?php
						$search=$_POST["search"];
						$query="select * from borrow where bar_item like '%$search%' || person_bar like '%$search%' ORDER BY bar_id DESC";
						$result=mysql_query($query);
				 
						while($row = mysql_fetch_array($result))
						{
						?>
						<tr>
							<td><?php echo $row["bar_id"];?></td>
							<td><?php echo $row["bar_item"];?></td>
							<td><?php echo $row["person_bar"];?></td>
							<td><?php echo $row["department"];?></td>
							<td><?php echo $row["position"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td><?php echo $row["date_bar"];?></td>
							<td><?php echo $row["date_returned"];?></td>
							<td ><a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_bar_item.php?bar_id=<?php echo $row['bar_id']?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					<p class="add">
						<a href="borrow.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
