<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
			
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">Add User</a></li>
							<li><a href="supplier.php" class="current">Add Suppliers</a></li>
						<!--	<li><a href="received_item.php">Recieved Items</a></li>-->
                        <li><a href="category.php" >Add Category</a></li>
							<li><a href="item.php" >Add Items</a></li>
                             <li><a href="addmoreitem.php" >Recieve More Items</a></li>
							<li><a href="request_items.php">Request Items</a></li>
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
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">Search results</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_supplier.php">
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
							<th>Id</th>
							<th>Supplier Name</th>
							<th>Address</th>
							<th>Contact Person</th>
							<th>Contact #</th>
							<th>Email</th>
							<th width="70">Actions</th>
						</tr>
						<?php
							$search=$_POST["search"];
							$query="select * from supplier where supplier_name like '%$search%' || address like '%$search%' || contact_person like '%$search%'";
							$result=mysqli_query($con,$query);
						
						while($row = mysqli_fetch_array($result))
						{
						?>
						<tr>
							<td><?php echo $row["supplier_id"];?></td>
							<td><?php echo $row["supplier_name"];?></td>
							<td><?php echo $row["address"];?></td>
							<td><?php echo $row["contact_person"];?></td>
							<td><?php echo $row["contact"];?></td>
							<td><?php echo $row["email"];?></td>
							<td><a href='edit_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>'>Edit</a> |
							<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					<p class="add">
						<a href="supplier.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
