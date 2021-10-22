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
				<div class="label">User Details</div>
				<hr />
				<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_user.php">
					<table>
						<tr>
							<td class="search">Search name :</td>
							<td><input type="text" size="40px" name="search" placeholder="Search here..." /></td>
							<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
						</tr>
				</form>
				<?php
				function valid($id, $name, $department, $position, $address,$contact,$user_type, $username, $password, $error)
				{
				?>
				<fieldset>
				<legend><div class="legend"><b>Update user details</b></div></legend>
				<div id="edit_userform">
					<form name="form1" method="post" action="">
						<table>
							<tr>
								<td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td>
							</tr>
							<tr>
								<td>User type:</td>
								<td><input type="text" style="margin-left:4px;" size="10px" name="utype_id" value="<?php echo $user_type; ?>"></td>
								<td>Address:</td>
								<td><input type="text" style="margin-left:4px;" size="40px" name="address" value="<?php echo $address; ?>"></td>
							</tr>
							<tr>
								<td>Full Name :</td>
								<td><input type="text" style="margin-left:4px;" size="30px" name="name" value="<?php echo $name; ?>"></td>
								<td>Contact:</td>
								<td><input type="text" style="margin-left:4px;" size="20px" name="contact" value="<?php echo $contact; ?>"></td>
							</tr>
							<tr>
								<td>Department:</td>
								<td><input type="text" style="margin-left:4px;" size="30px" name="department" value="<?php echo $department; ?>"></td>
								<td>Username :</td>
								<td><input type="text" style="margin-left:4px;" size="25px" name="username" value="<?php echo $username; ?>"></td>
							</tr>
							<tr>
								<td>Position :</td>
								<td><input type="text" style="margin-left:4px;" size="30px" name="position" value="<?php echo $position; ?>"></td>
								<td>Password :</td>
								<td><input type="password" style="margin-left:4px;" size="25px" name="password" value="<?php echo $password; ?>"></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="add">
								<input type="submit" name="submit" style="cursor:pointer;" value="Update">
								<a href="user.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Cancel"></a>
								</td>
							</tr>		
						</table>		
					</form>
				</div>
				</fieldset>
				<?php
				}

				if (isset($_POST['submit']))
				{
					if (is_numeric($_POST['id']))
					{
						$id = $_POST['id'];
						$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['name']));
						$department = mysqli_real_escape_string($con,htmlspecialchars($_POST['department']));
						$position = mysqli_real_escape_string($con,htmlspecialchars($_POST['position']));
						$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));	
						$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));	
						$user_type = mysqli_real_escape_string($con,htmlspecialchars($_POST['utype_id']));
						$username = mysqli_real_escape_string($con,htmlspecialchars($_POST['username']));
						$password = mysqli_real_escape_string($con,htmlspecialchars($_POST['password']));

						$query = mysqli_query($con,"UPDATE user SET name='$name' ,department='$department' ,position='$position' ,address='$address' ,contact='$contact' ,utype_id='$user_type' ,username='$username' ,password='".$password."' WHERE id='$id'")
						or die(mysqli_error());
						header("Location: user.php?attempt=success");
					}
					else
					{
						echo 'Error!';
					}
				}
				else
				{
					if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
					{
						$id = $_GET['id'];
						$result = mysqli_query($con,"SELECT * FROM user WHERE id=$id")
						or die(mysqli_error());
						$row = mysqli_fetch_array($result);

						if($row)
						{
							$name = $row['name'];
							$department = $row['department'];
							$position = $row['position'];
							$address = $row['address'];
							$contact = $row['contact'];
							$user_type = $row['utype_id'];
							$username = $row['username'];
							$password = $row['password'];

							valid($id, $name,$department,$position,$address,$contact,$user_type, $username, $password,'');
						}
						else
						{
						echo "No results!";
						}
					}
					else
					{
					echo 'Error!';
					}
				}
				?>
				<hr />
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
						$result = "SELECT * FROM user ORDER BY id DESC";
						$objQuery = mysqli_query($con,$result) or die ("Error Query [".$result."]");
				
					while($row = mysqli_fetch_array($objQuery))
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
			</td>
		</tr>
	</table>
<?php require('includes/footer.php');?>