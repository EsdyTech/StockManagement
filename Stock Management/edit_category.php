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
                        <li><a href="category.php" class="current">Add Category</a></li>
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
				<div class="label">Add Category</div>
				<hr />
				
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
						if (is_numeric($_GET['cat_id']))
						{
							$cat_id = $_GET['cat_id'];
							$cat_id = mysqli_real_escape_string($con,htmlspecialchars($_GET['cat_id']));
							$cat_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['cat_name']));
							
							mysqli_query($con,"UPDATE category SET cat_name='$cat_name' WHERE cat_id='$cat_id'")or die(mysqli_error());
										 
							header("Location: category.php?attempt=saved");
						
						}}
				?>
				<fieldset>
				<legend><div class="legend"><b>Please fill-up the space provided below</b></div></legend>
				<div id="add_userform">
					<form name="form1" method="post" action="">
						<table>
							<?php
					$result = "SELECT * FROM category WHERE cat_id='$_GET[cat_id]'";
					$objQuery = mysqli_query($con,$result) or die ("Error Query [".$result."]");
					$row = mysqli_fetch_array($objQuery);
					
					?>
						
							<tr>
								<td>Category :</td>
								<td><input type="text"size="40px" value="<?php echo $row['cat_name'];?>"  required name="cat_name" placeholder="Enter Category Name..."></td>
								
							</tr>
                            <tr>
								<td><input type="submit" value="Update" size="40px" name="submit" ></td>
								
							</tr>
								
						</table>		
					</form>
				</div>
				</fieldset>
				<hr />
				<table class="inventory_table" id="alternatecolor">
					<tr>
						<th>Id</th>
						<th>Category Name</th>
						<th>Actions</th>
					</tr>
					<?php
					$result = "SELECT * FROM category ORDER BY cat_id ASC";
					$objQuery = mysqli_query($con,$result) or die ("Error Query [".$result."]");
				
					while($row = mysqli_fetch_array($objQuery))
					{
					?>
					<tr>
						<td><?php echo $row["cat_id"];?></td>
						<td><?php echo $row["cat_name"];?></td>
						<td><a href='edit_category.php?id=<?php echo $row["cat_id"];?>'>Edit</a> |
							<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_category.php?cat_id=<?php echo $row["cat_id"];?>';}">Delete</a></td>
					</tr>
					<?php
					}
					?>
				</table>
			</td>
		</tr>
	</table>
<?php require('includes/footer.php');?>