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
				<div class="label">Received requests</div>
				<hr />
				<br />
				<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Requests Supplied Successfully.</div>
							<?php
							}
						}
					?>
				<table class="inventory_table" id="alternatecolor">
					<tr>
						<th width="40">Req. #</th>
						<th width="110">From</th>
						<th>Subject</th>
						<th>Item name</th>
                         <th width="50">Quantity</th>
						 <th width="50">Price</th>
                        <th width="50">Total_Price</th>
						<th width="125">Date</th>
                        <th width="125">Status</th>
						<th width="70">Actions</th>
					</tr>
					<?php
					$result = "SELECT * FROM request where status='Pending' ORDER BY req_id DESC";
					$objQuery = mysqli_query($con,$result) or die ("Error Query [".$result."]");
					$counts=mysqli_num_rows($objQuery);

					if($counts == 0)
					
					{
echo '<div class="error">There is no Pending Request(s)!</div>';
						
					}else{
					while($row = mysqli_fetch_array( $objQuery))
					{
					?>
					<tr>
						<td><?php echo $row["req_id"];?></td>
						<td><?php echo $row["name"];?></td>
						<td><?php echo $row["subject"];?></td>
						<td><?php echo $row["item_name"];?></td>
                        <td><?php echo $row["quantity"];?></td>
						<td><?php echo $row["price"];?></td>
                        <td><?php echo $row["totalprice"];?></td>
						<td><?php echo $row["date"];?></td>
                        <td><?php echo $row["status"];?></td>
						<td><a href='view_requests2.php?id=<?php echo $row["id"];?>'>View</a> |
						<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_request_item.php?id=<?php echo $row["id"];?>';}">Delete</a></td>
					</tr>
					<?php
					}
				}
					?>
				</table>
			</td>
		</tr>
	</table>
<?php require('includes/footer.php');?>