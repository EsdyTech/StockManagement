<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
			
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
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_user.php">
						<table>
							<tr>
								<td class="search">Search name :</td>
								<td><input type="text" size="40px" name="search" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
					<br />
					<table class="inventory_table" id="alternatecolor">
						<tr>
							<th>Id</th>
							<th>User type</th>
							<th>Full name</th>
							<th>Department</th>
							<th>Position</th>
							<th>Address</th>
							<th>Contact</th>
							<th>Actions</th>
						</tr>
						<?php
						$search=$_POST["search"];
						$query="select * from user where name like '%$search%' || username like '%$search%'";
						$result=mysqli_query($con,$query);
						
						while($row = mysqli_fetch_array($result))
						{
						?>
						<tr>
							<td><?php echo $row["id"];?></td>
							<td><?php echo $row["utype_id"];?></td>
							<td><?php echo $row["name"];?></td>
							<td><?php echo $row["department"];?></td>
							<td><?php echo $row["position"];?></td>
							<td><?php echo $row["address"];?></td>
							<td><?php echo $row["contact"];?></td>
							<td><a href='edit_user.php?id=<?php echo $row["id"];?>'>Edit</a> |
								<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
								{window.location='delete_user.php?id=<?php echo $row["id"];?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
					</table>
					<p class="add">
						<a href="user.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
