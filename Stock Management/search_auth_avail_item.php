<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
			
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="auth_available_item.php"class="current">Available Items</a></li>
						<li><a href="auth_received_item.php">Received Items</a></li>
						<li><a href="auth_supplier.php">Suppliers</a></li>
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
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_auth_avail_item.php">
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
							<th>Item name</th>
							<th>Brand</th>
							<th width="60">Qty left</th>
							<th width="60">Unit</th>
						</tr>
						<?php
							$search=$_POST["search"];
							$query="select * from itemlist where  item_id like '%$search%' || item_name like '%$search%' || brand_name  like '%$search%'ORDER BY item_id ASC";
							$result=mysqli_query($con,$query);
						
						while($row = mysqli_fetch_array($result))
						{
						?>
						<tr>
							<td><?php echo $row["item_code"];?></td>
							<td><?php echo $row["item_name"];?></td>
							<td><?php echo $row["brand_name"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td><?php echo $row["unit_name"];?></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					<p class="add">
						<a href="auth_available_item.php"><input type="Button" name="Btncancel" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
