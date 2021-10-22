<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
			
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">User</a></li>
						<li><a href="supplier.php">Suppliers</a></li>
						<li><a href="received_item.php">Received Item</a></li>
						<li><a href="item.php"class="current">Items</a></li>
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
					<div class="label">Search results</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_item.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" size="40px" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
					<br />
					<table class="inventory_table" id="alternatecolor">
						<tr>
							<th width="60">Code</th>
							<th>Item</th>
							<th>Brand</th>
							<th width="60">Quantity</th>
							<th width="60">Unit</th>
							<th width="60">Price</th>
							<th width="70">Actions</th>
						</tr>
						<?php
						$search=$_POST["search"];
						$query="select * from itemlist where  item_name like '%$search%' || brand_name like '%$search%' || supplier_name like '%$search%' ORDER BY item_id DESC";
						$result=mysqli_query($con,$query);
					
						while($row = mysqli_fetch_array($result))
						{
						?>
						<tr>
							<td><?php echo $row['item_code'];?></td>
							<td><?php echo $row['item_name'];?></td>
							<td><?php echo $row['brand_name'];?></td>
							<td><?php echo $row['quantity'];?></td>
							<td><?php echo $row['unit_name'];?></td>
							<td><?php echo $row['price'];?></td>
							<td><a href='edit_item.php?item_id=<?php echo $row['item_id']?>'>Edit</a> |
							<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_item.php?item_id=<?php echo $row['item_id']?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					<p class="add">
						<a href="item.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
