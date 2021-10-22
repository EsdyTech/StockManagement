<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>

	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="auth_available_item.php">Available Items</a></li>
						<li><a href="auth_received_item.php">Received Items</a></li>
						<li><a href="auth_supplier.php"class="current">Suppliers</a></li>
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">Suppleir Details</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_auth_supplier.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" name="search" size="40px" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
					<?php
					function valid($supplier_id, $name, $address, $contact, $person, $email,  $error)
					{
					?>
					<fieldset>
					<legend><div class="legend"><b>Update supplier details</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="GET" action="">
							<table>
								<tr>
									<td><input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>"/></td>
								</tr>
								<tr>
									<td>Full Name :</td>
									<td><input type="text" style="margin-left:4px;" size="30px" name="supplier_name" value="<?php echo $name; ?>"></td>
								</tr>
								<tr>
									<td>Address :</td>
									<td><input type="text" style="margin-left:4px;" size="50px" name="address" value="<?php echo $address; ?>"></td>
								</tr>
								<tr>
									<td>Contact # :</td>
									<td><input type="text" style="margin-left:4px;" size="25px" name="contact" value="<?php echo $contact; ?>"></td>
								</tr>
								<tr>
									<td>Contact person :</td>
									<td><input type="text" style="margin-left:4px;" size="30px" name="contact_person" value="<?php echo $person; ?>"></td>
								</tr>
								<tr>
									<td>Email :</td>
									<td><input type="text" style="margin-left:4px;" size="30px" name="email" value="<?php echo $email; ?>"></td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td class="add">
									<input type="submit" name="submit" style="cursor:pointer;" value="Update">
									<a href="auth_supplier.php"><input type="Button" name="Btncancel" style="cursor:pointer;" value="Cancel"></a></td>
								</tr>		
							</table>		
						</form>
					</div>
					</fieldset>
					<?php
					}

					if (isset($_GET['submit']))
					{
						if (is_numeric($_GET['supplier_id']))
						{
							$supplier_id = $_GET['supplier_id'];
							$name = mysqli_real_escape_string($con,htmlspecialchars($_GET['supplier_name']));
							$address = mysqli_real_escape_string($con,htmlspecialchars($_GET['address']));
							$contact= mysqli_real_escape_string($con,htmlspecialchars($_GET['contact']));
							$person = mysqli_real_escape_string($con,htmlspecialchars($_GET['contact_person']));
							$email = mysqli_real_escape_string($con,htmlspecialchars($_GET['email']));
							

							mysqli_query($con,"UPDATE supplier SET supplier_name='$name', address='$address', contact='$contact', email='$email', contact_person='$person' WHERE supplier_id='$supplier_id'")
							or die(mysqli_error());
							header("Location: auth_supplier.php?attempt=success");
						
						}
						else
						{
							echo 'Error!';
						}
					}
					else
					{
						if (isset($_GET['supplier_id']) && is_numeric($_GET['supplier_id']) && $_GET['supplier_id'] > 0)
						{
							$supplier_id = $_GET['supplier_id'];
							$result = mysqli_query($con,"SELECT * FROM supplier WHERE supplier_id=$supplier_id")
							or die(mysqli_error());
							$row = mysqli_fetch_array($result);

							if($row)
							{
								$name = $row['supplier_name'];
								$address = $row['address'];
								$contact = $row['contact'];
								$person = $row['contact_person'];
								$email = $row['email'];
								

								valid($supplier_id, $name, $address, $contact, $person, $email, '');
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
							<th>Supplier Name</th>
							<th>Address</th>
							<th>Contact Person</th>
							<th>Contact #</th>
							<th>Email</th>
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
							<td><a href='auth_edit_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>'>Edit</a></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					<br />
					<?php
						//Display the navigation
						//echo $pager->renderFullNav();
						echo '<div class="pager" >'.$pager->renderFullNav().'</div>';
					?>					
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
