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
							<li><a href="supplier.php">Add Suppliers</a></li>
						<!--	<li><a href="received_item.php">Recieved Items</a></li>-->
                        <li><a href="category.php" >Add Category</a></li>
							<li><a href="item.php" class="current" >Add Items</a></li>
                             <li><a href="addmoreitem.php" >Recieve More Items</a></li>
							<li><a href="request_items.php">Requested Items</a></li>
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
					<div class="label">List of all items</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_item.php">
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
							if($attempt == "saved")
							{
							?>
							<div  class="success">Record successfully saved.</div>
							<?php
							}
							elseif($attempt == "empty")
							{
							?>
							<div  class="error">All fields must be filled out.</div>
							<?php
							}
							elseif($attempt == "Exist")
							{
							?>
							<div  class="error">item code exists</div>
							<?php
							}
						}
					?>
                    
                    
                    
					<?php

						if (isset($_GET['submit']))
							{
								$item_code = mysqli_real_escape_string($con,htmlspecialchars($_GET['item_code']));
								$item_name = mysqli_real_escape_string($con,htmlspecialchars($_GET['item_name']));
								$supplier = mysqli_real_escape_string($con,htmlspecialchars($_GET['supplier_name']));
								$brand = mysqli_real_escape_string($con,htmlspecialchars($_GET['brand_name']));
								$quantity= mysqli_real_escape_string($con,htmlspecialchars($_GET['quantity']));
								$unit = mysqli_real_escape_string($con,htmlspecialchars($_GET['unit_name']));
								$price = mysqli_real_escape_string($con,htmlspecialchars($_GET['price']));
								$item_type = mysqli_real_escape_string($con,htmlspecialchars($_GET['type_name']));
								$category = mysqli_real_escape_string($con,htmlspecialchars($_GET['cat_name']));

								if (
									$item_code == '' ||
									$item_name == '' || 
									$supplier == '' || 
									$brand == '' || 
									$quantity == '' || 
									$unit == ''|| 
									$price == '' ||
									$item_type == '' || 
									$category == ''){
									
									header("Location: item.php?attempt=empty");
								}
								
								
								$qry= "SELECT * FROM itemlist WHERE item_code='$item_code'";
						   $res= mysqli_query($con,$qry);		
								 if(mysqli_affected_rows($con) >0){ 
							
							header("Location: item.php?attempt=Exist");
							
						}
						
						
								else
								{								
									$sql = mysqli_query($con,"INSERT INTO itemlist (item_code,item_name,brand_name,quantity,unit_name,price,type_name,cat_name,supplier_name,dateadded) 
									values('$item_code','$item_name','$brand','$quantity','$unit','$price','$item_type','$category','$supplier',curdate())") 
									or die("Could not execute the insert query.");
																					
									header("Location: item.php?attempt=saved");

								
							}}
							
					?>
					<fieldset>
					<legend><div class="legend"><b>Please fill-up the space provided below</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="get" action="">
							<table>
								<tr>
									<td>Item Code :</td>
									<td><input type="text" size="15px" required name="item_code" placeholder="Enter item code..." ></td>									
								</tr>
								<tr>
									<td>Description :</td>
									<td><input type="text"  size="30px" required name="item_name" placeholder="Enter item description..." ></td>
									<td>Quantity :</td>
									<td><input type="text"  size="10px"  required name="quantity" placeholder="Enter qty..."></td>									
								</tr>
								<tr>
									<td>Supplier :</td>
									<td><?php
											$sql = mysqli_query($con,"select * from supplier ");											
											echo '<select name="supplier_name" required>';
											echo '<option value="">None...</option>';
											 while($row = mysqli_fetch_assoc($sql))
											{
											echo '<option value="'. $row['supplier_name'].'">'. $row['supplier_name'].'</option>';
											}
											echo'</select>';
										?>
									</td>
									<td>Unit :</td>
									<td><?php
											$sql = mysqli_query($con,"select * from unit ");											
											echo '<select name="unit_name" required>';
											echo '<option value="">None...</option>';
											 while($row = mysqli_fetch_assoc($sql))
											{
											echo '<option value="'. $row['unit_name'].'">'. $row['unit_name'].'</option>';
											}
											echo'</select>';
										?>
									</td>
								</tr>
								<tr>
									<td>Brand :</td>
									<td><input type="text"  size="25px" required name="brand_name" placeholder="Enter brand..."></td>
									<td>Item type :</td>
									<td><?php
											$sql = mysqli_query($con,"select * from item_type ");											
											echo '<select name="type_name" required >';
											echo '<option value="">None...</option>';
											 while($row = mysqli_fetch_assoc($sql))
											{
											echo '<option value="'. $row['type_name'].'">'. $row['type_name'].'</option>';
											}
											echo'</select>';
										?>
									</td>
								</tr>
								<tr>
									<td>Price :</td>
									<td><input type="text" required  size="15px" name="price" placeholder="Enter price..."></td>
									<td>Category:</td>
									<td><?php
											$sql = mysqli_query($con,"select * from category ");											
											echo '<select name="cat_name" required >';
											echo '<option value="">None...</option>';
											 while($row = mysqli_fetch_assoc($sql))
											{
											echo '<option value="'. $row['cat_name'].'">'. $row['cat_name'].'</option>';
											}
											echo'</select>';
										?>
									</td>
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
					<?php
						function formatMoney($number, $fractional=false) {
							if ($fractional) {
								$number = sprintf('%.2f', $number);
							}
							while (true) {
								$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
								if ($replaced != $number) {
									$number = $replaced;
								} else {
									break;
								}
							}
							return $number;
						}	
					?>
					<table class="inventory_table" id="alternatecolor">
						<tr>
							<th width="60">Code</th>
							<th>Description</th>
							<th>Brand</th>
							<th width="60">Qty left</th>
							<th width="60">Unit</th>
							<th width="60">Price</th>
							<th width="70">Actions</th>
						</tr>
						<?php
							include('includes/ps_pagination.php');
							
							$sql ='SELECT * FROM itemlist ORDER BY item_code DESC';
						
							//Create a PS_Pagination object
							$pager = new PS_Pagination($con, $sql, 15, 20);

							//The paginate() function returns a mysqli result set for the current page
							$rs = $pager->paginate();
						
							while($row = mysqli_fetch_array($rs))
							{							
						?>
						<tr>
							<td><?php echo $row['item_code'];?></td>
							<td><?php echo $row['item_name'];?></td>
							<td><?php echo $row['brand_name'];?></td>
							<td><?php echo $row['quantity'];?></td>
							<td><?php echo $row['unit_name'];?></td>
							<td><?php $p=$row['price'];echo formatMoney($p, true);?></td>
							<td><a href='edit_item.php?item_id=<?php echo $row['item_id']?>'>Edit</a> |
							<a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_item.php?item_id=<?php echo $row['item_id']?>';}">Delete</a></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="7"><?php
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
