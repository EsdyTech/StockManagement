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
						<li><a href="comm_available_item.php">Available Items</a></li>
						<li><a href="comm_received_item.php">Received Items</a></li>
						<li><a href="comm_supplier.php"class="current">Suppliers</a></li>
						<li><a href="comm_requestform.php">Request</a></li>
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">List of suppliers</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_user_supplier.php">
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
						}
					?>
					<?php
						if (isset($_POST['submit']))
							{
								$name = mysql_real_escape_string(htmlspecialchars($_POST['supplier_name']));
								$address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
								$person = mysql_real_escape_string(htmlspecialchars($_POST['contact_person']));
								$contact = mysql_real_escape_string(htmlspecialchars($_POST['contact']));
								$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));

								if ($name == '' || $address == '' || $person == '' || $contact == '' || $email == '')
								{
									header("Location: user_supplier.php?attempt=empty");
								}
								else{
									$sql = 'SELECT * FROM supplier WHERE supplier_name = "'.$name.'"'; 
									if ($result = mysql_query($sql)) 
									{
										if(mysql_num_rows($result)) 
										{
											header("Location: user_supplier.php?attempt=exist");	
										}
										else{
											
											$sql = mysql_query("INSERT INTO supplier (supplier_name,address,contact_person,contact,email) 
																values('$name','$address','$person','$contact','$email')",$conn) 
																or die("Could not execute the insert query.");
											
											header("Location: user_supplier.php?attempt=saved");
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
							<th width="70">Action</th>
						</tr>
						<?php
							include('includes/ps_pagination.php');
							$sql = 'SELECT * FROM supplier ORDER BY supplier_id DESC';
							 
							//Create a PS_Pagination object
							$pager = new PS_Pagination($conn, $sql, 15, 20);

							//The paginate() function returns a mysql result set for the current page
							$rs = $pager->paginate();
						
							while($row = mysql_fetch_array($rs))
							{
						?>
						<tr>
							<td><?php echo $row["supplier_id"];?></td>
							<td><?php echo $row["supplier_name"];?></td>
							<td><?php echo $row["address"];?></td>
							<td><?php echo $row["contact_person"];?></td>
							<td><?php echo $row["contact"];?></td>
							<td><?php echo $row["email"];?></td>
							<td><a href='user_edit_supplier.php?supplier_id=<?php echo $row["supplier_id"];?>'>Edit</a></td>
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
