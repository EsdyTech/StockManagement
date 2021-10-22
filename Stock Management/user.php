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
							<li><a href="user.php" class="current">Add User</a></li>
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
				<div class="name"><b>Welcome, <?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
				<div class="label">Add New Users Information</div>
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
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Record successfully updated.</div>
							<?php
							}
							elseif($attempt == "saved")
							{
							?>
							<div  class="success">Record successfully saved.</div>
							<?php
							}
							elseif($attempt == "exist")
							{
							?>
							<div  class="error"><b>Unable to add name already exist.</div>
							<?php
							}
							elseif($attempt == "empty")
							{
							?>
							<div  class="error">All fields must be filled out.</div>
							<?php
							}
						}
					?>
				<?php
					if (isset($_POST['submit']))
					{
						$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['name']));
						$department = mysqli_real_escape_string($con,htmlspecialchars($_POST['department']));
						$position = mysqli_real_escape_string($con,htmlspecialchars($_POST['position']));
						$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
						$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
						$usertype = mysqli_real_escape_string($con,htmlspecialchars($_POST['utype_id']));
						$username = mysqli_real_escape_string($con,htmlspecialchars($_POST['username']));
						$password = mysqli_real_escape_string($con,htmlspecialchars($_POST['password']));

						if ($name == '' || $department == '' || $position == '' || $address == '' || $contact == '' || $usertype == '' || $username == '' || $password == '')
						{
							header("Location: user.php?attempt=empty");
						}
						else{
						
							$sql = 'SELECT * FROM user WHERE username = "'.$username.'"'; 
							if ($result = mysqli_query($con,$sql)) 
							{
								if(mysqli_num_rows($result)) 
								{
									header("Location: user.php?attempt=exist");	
								}
								else{
									mysqli_query($con,"INSERT INTO user (name,department,position,address,contact,utype_id,username,password,date) 
									values('$name','$department','$position','$address','$contact','$usertype','$username','$password',curdate())")
									or die("Could not execute the insert query.");
									
									header("Location: user.php?attempt=saved");
								}
							}
						}
					}
				?>
				<fieldset>
				<legend><div class="legend"><b>Please fill-up the space provided below</b></div></legend>
				<div id="add_userform">
					<form name="form1" method="post" action="">
						<table>
							<tr>
								<td>User type :</td>
								<td><?php
										$sql = mysqli_query($con,"select * from user_type");											
										echo '<select name="utype_id" >';
										echo '<option value="">None...</option>';
										while($row = mysqli_fetch_assoc($sql))
										{
										echo '<option value="'. $row['utype_id'].'">'. $row['user_type'].'</option>';
										}
										echo'</select>';
									?>
								</td>
								<td>Full Name :</td>
								<td><input type="text"size="30px" name="name" placeholder="Enter name..."></td>
							</tr>
							<tr>
								<td>Department :</td>
								<td><?php
										$sql = mysqli_query($con,"select * from department");											
										echo '<select name="department" >';
										echo '<option value="">None...</option>';
										while($row = mysqli_fetch_assoc($sql))
										{
										echo '<option value="'. $row['description'].'">'. $row['description'].'</option>';
										}
										echo'</select>';
									?></td>
								<td>Position :</td>
								<td><input type="text"size="30px" name="position" placeholder="Enter position..."></td>
							</tr>
							<tr>
								<td>Address :</td>
								<td><input type="text"size="40px" name="address" placeholder="Enter address..."></td>
								<td>Contact # :</td>
								<td><input type="text"size="25px" name="contact" maxlength="11" placeholder="Enter contact number..."></td>
							</tr>
							<tr>
								<td>Username :</td>
								<td><input type="text" size="25px" name="username" placeholder="Enter username..."></td>
								<td>Password :</td>
								<td><input type="password" size="25px" name="password" placeholder="Enter password..."></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="add">
								<input type="submit" name="submit" style="cursor:pointer;margin-left:4px;" value="Save">
								<input type="reset" name="Btncancel" style="cursor:pointer;" value="Clear"></td>
							</tr>		
						</table>		
					</form>
				</div>
				</fieldset>
				<hr />
				<table class="inventory_table" id="alternatecolor">
					<tr>
						<th>Id</th>
						<th>User type</th>
						<th>Full name</th>
						<th>Dpeartment</th>
						<th>Position</th>
						<th>Address</th>
						<th>Contact</th>
						<th>Actions</th>
					</tr>
					<?php
					$result = "SELECT * FROM user,user_type where user.utype_id=user_type.utype_id ORDER BY id DESC";
					$objQuery = mysqli_query($con,$result) or die ("Error Query [".$result."]");
				
					while($row = mysqli_fetch_array($objQuery))
					{
					?>
					<tr>
						<td><?php echo $row["id"];?></td>
						<td><?php echo $row["user_type"];?></td>
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