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
					<div class="label">Item Details</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_item.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" name="search" size="40px" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
					</form>
					<?php
					function valid($item_id, $item_code,$item_name, $supplier,$brand, $quantity, $unit, $price,$item_type,$category, $error)
					{
					?>
					<fieldset>
					<legend><div class="legend"><b>Update item details</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="GET" action="">
							<table>
								<tr>
									<td><input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/></td>
								</tr>
								<tr>
									<td>Item code :</td>
									<td><input type="text" size="15px" readonly="readonly" name="item_code" value="<?php echo $item_code; ?>"/></td>
								</tr>
								<tr>
									<td>Description:</td>
									<td><input type="text"  size="30px" name="item_name" value="<?php echo $item_name; ?>"></td>
									<td>Quantity :</td>
									<td><input type="text" size="10px" name="quantity" value="<?php echo $quantity; ?>"></td>																		
								</tr>
								<tr>
									<td>Supplier:</td>
									<td><input type="text"  size="30px" name="supplier_name" value="<?php echo $supplier; ?>"></td>
									<td>Unit :</td>
									<td><input type="text" size="9px" name="unit_name" value="<?php echo $unit; ?>"></td>																		
								</tr>
								<tr>
									<td>Brand :</td>
									<td><input type="text" size="25px" name="brand_name" value="<?php echo $brand; ?>"></td>
									<td>Item type :</td>
									<td><input type="text" size="20px" name="type_name" value="<?php echo $item_type; ?>"></td>
								</tr>
								<tr>
									<td>Price :</td>
									<td><input type="text" size="15px" name="price" value="<?php echo $price; ?>"></td>
									<td>Category :</td>
									<td><input type="text" size="40px" name="cat_name" value="<?php echo $category; ?>"></td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td class="add">
									<input type="submit" name="submit" style="cursor:pointer;" value="Update">
									<a href="item.php"><input type="Button" name="Btncancel" style="cursor:pointer;" value="Cancel"></a></td>
								</tr>		
							</table>		
						</form>
					</div>
					</fieldset>
					<?php
					}

					if (isset($_GET['submit']))
					{
						if (is_numeric($_GET['item_id']))
						{
							$item_id = $_GET['item_id'];
							$item_code = mysqli_real_escape_string($con,htmlspecialchars($_GET['item_code']));
							$item_name = mysqli_real_escape_string($con,htmlspecialchars($_GET['item_name']));
							$supplier = mysqli_real_escape_string($con,htmlspecialchars($_GET['supplier_name']));
							$brand = mysqli_real_escape_string($con,htmlspecialchars($_GET['brand_name']));
							$quantity = mysqli_real_escape_string($con,htmlspecialchars($_GET['quantity']));
							$unit = mysqli_real_escape_string($con,htmlspecialchars($_GET['unit_name']));
							$price = mysqli_real_escape_string($con,htmlspecialchars($_GET['price']));
							$item_type = mysqli_real_escape_string($con,htmlspecialchars($_GET['type_name']));
							$category = mysqli_real_escape_string($con,htmlspecialchars($_GET['cat_name']));
							
							
							
							
							
							

							mysqli_query($con,"UPDATE itemlist SET item_code='$item_code',
															 item_name='$item_name', 
															 supplier_name='$supplier', 
															 brand_name='$brand',
															 quantity='$quantity',
															 unit_name='$unit',
															 price='$price', 
															 type_name='$item_type',
															 cat_name='$category'
										 WHERE item_id='$item_id'")or die(mysqli_error());
										 
							header("Location: item.php?attempt=saved");
						
						}
						else
						{
							echo 'Error!';
						}
					}
					else
					{
						if (isset($_GET['item_id']) && is_numeric($_GET['item_id']) && $_GET['item_id'] > 0)
						{
							$item_id = $_GET['item_id'];
							$result = mysqli_query($con,"SELECT * FROM itemlist WHERE item_id=$item_id")
							or die(mysqli_error());
							$row = mysqli_fetch_array($result);

							if($row)
							{
								$item_code = $row['item_code'];
								$item_name = $row['item_name'];
								$supplier = $row['supplier_name'];
								$brand = $row['brand_name'];
								$quantity = $row['quantity'];
								$unit = $row['unit_name'];
								$price = $row['price'];
								$item_type = $row['type_name'];
								$category = $row['cat_name'];

								valid($item_id, $item_code,$item_name, $supplier,$brand, $quantity, $unit, $price,$item_type,$category, '');
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
							<th width="60">Quantity</th>
							<th width="60">Unit</th>
							<th width="60">Price</th>
							<th width="70">Actions</th>
						</tr>
						<?php
							include('includes/ps_pagination.php');
							
							$sql ='SELECT * FROM itemlist ORDER BY item_id DESC';
						
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
