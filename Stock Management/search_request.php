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
								<li><a href="user.php">Add User</a></li>
							<li><a href="supplier.php" >Add Suppliers</a></li>
						<!--	<li><a href="received_item.php">Recieved Items</a></li>-->
                        <li><a href="category.php" >Add Category</a></li>
							<li><a href="item.php" >Add Items</a></li>
                             <li><a href="addmoreitem.php" >Recieve More Items</a></li>
							<li><a href="request_items.php" class="current">Request Items</a></li>
						<!--	<li><a href="po.php">Purchased Order</a></li>	-->					
							<!--<li><a href="borrow.php">Borrow</a></li>-->
                            <li><a href="admin_report.php">Reports</a></li>
							<!--<li><a href="report.php">Reports</a></li>-->
						</ul>
					</td>
				</tr>
	</table>
	<table id="contentbox">
		<tr>
			<td id="content">
				<div class="name"><b>Welcome, <?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
				<div class="label">Received request items</div>
				<hr />
				<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_request.php">
						<table>
							<tr>
								<td class="search">Search name :</td>
								<td><input type="text" size="40px" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
				<br />
				<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Received requests.</div>
							<?php
							}
						}
					?>
				<table class="inventory_table" id="alternatecolor">
					<tr>
						<th width="40">Req. #</th>
						<th width="110">From</th>
						<th>Subject</th>
						<th width="125">Date</th>
						<th width="70">Actions</th>
					</tr>
					<?php
					$search=$_POST["search"];
					$query="select * from request where name like '%$search%' ";
					$result=mysql_query($query);
				
					while($row = mysql_fetch_array($result))
					{
					?>
					<tr>
						<td><?php echo $row["req_id"];?></td>
						<td><?php echo $row["name"];?></td>
						<td><?php echo $row["subject"];?></td>
						<td><?php echo $row["date"];?></td>
						<td><a href='view_request.php?req_id=<?php echo $row["req_id"];?>'>View</a> |
						<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_request_item.php?id=<?php echo $row["id"];?>';}">Delete</a></td>
					</tr>
					<?php
					}
					?>
				</table>
				<p class="add">
					<a href="request_items.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
				</p>
			</td>
		</tr>
	</table>
<?php require('includes/footer.php');?>