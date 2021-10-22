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
					<div class="label">Add New Suppliers Information</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_supplier.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" name="search" size="40px" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
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
							<div  class="success">Suppliers record successfully saved.</div>
							<?php
							}
							elseif($attempt == "exist")
							{
							?>
							<div  class="error">Unable to add supplier name already exist.</div>
							<?php
							}
							elseif($attempt == "empty")
							{
							?>
							<div  class="error">All fields must be filled out.</div>
							<?php
							}
							elseif($attempt == "invalid")
							{
							?>
							<div  class="error">Invalid email address.</div>
							<?php
							}
						}
					?>
					<?php
						if (isset($_POST['submit']))
							{
								$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['supplier_name']));
								$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
								$person = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact_person']));
								$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
								$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));

								if ($name == '' || $address == '' || $person == '' || $contact == '' || $email == '')
								{
									header("Location: supplier.php?attempt=empty");
								}
								else{
									if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email))
									{
										header("Location: supplier.php?attempt=invalid");
									}
									else{
										$sql = 'SELECT * FROM supplier WHERE supplier_name = "'.$name.'"'; 
										if ($result = mysqli_query($con,$sql)) 
										{
											if(mysqli_num_rows($result)) 
											{
												header("Location: supplier.php?attempt=exist");	
											}
											else{
												
												$sql = mysqli_query($con,"INSERT INTO supplier (supplier_name,address,contact_person,contact,email,dateadded) 
																	values('$name','$address','$person','$contact','$email',curdate())") 
																	or die("Could not execute the insert query.");
												
												header("Location: supplier.php?attempt=saved");
											}
										}
									}
								}
							}
					?>
					<fieldset>
					<legend><div class="legend"><b>Please fill-up the space provided below</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="POST" action="">
							<table>
								<tr>
									<td>Supplier Name :</td>
									<td><input type="text" size="30px" name="supplier_name" placeholder="Enter fullname..." ></td>
								</tr>
								<tr>
									<td>Address :</td>
									<td><input type="text" size="50px" name="address" placeholder="Enter address..."></td>
								</tr>
								<tr>
									<td>Contact person :</td>
									<td><input type="text" size="30px" name="contact_person" placeholder="Enter name..."></td>
								</tr>
								<tr>
									<td>Contact # :</td>
									<td><input type="text" size="25px" name="contact" placeholder="Enter contact #..."></td>
								</tr>
								<tr>
									<td>Email :</td>
									<td><input type="text" size="30px" name="email" placeholder="Enter email..."></td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td class="add">
									<input type="submit" name="submit" style="cursor:pointer;" value="Save">
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
							<th>Supplier Name</th>
							<th>Address</th>
							<th>Contact Person</th>
							<th>Contact #</th>
							<th>Email</th>
                            <th>DateAdded</th>
							<th width="70">Actions</th>
						</tr>
						<?php
							include('includes/ps_pagination.php');
							$sql = 'SELECT * FROM supplier ORDER BY supplier_id DESC';
							 
							//Create a PS_Pagination object
							$pager = new PS_Pagination($con, $sql, 15, 20);

							//The paginate() function returns a mysqli result set for the current page
							$rs = $pager->paginate();
						
							while($row = mysqli_fetch_array($rs))
							{
						?>
						<tr>
							<td><?php echo $row["supplier_id"];?></td>
							<td><?php echo $row["supplier_name"];?></td>
							<td><?php echo $row["address"];?></td>
							<td><?php echo $row["contact_person"];?></td>
							<td><?php echo $row["contact"];?></td>
							<td><?php echo $row["email"];?></td>
                            <td><?php echo $row["dateadded"];?></td>
							<td><a href='edit_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>'>Edit</a> |
							<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="8"><?php
									//Display the navigation
									//echo $pager->renderFullNav();
									echo '<div class="pager" >'.$pager->renderFullNav().'</div>';
								?>
							</td>
						</tr>
					</table>										
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
