<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>

	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="comm_available_item.php" class="current">Available Items</a></li>
						<li><a href="request_form.php" >Request Items</a></li>
                        	<li><a href="comm_report.php">Report</a></li>
                      <!--  <li><a href="comm_requestform.php">Request</a></li>-->
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
					<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">List of all available items</div>
					<hr />
					<form name="formsearch" method="post" onsubmit="return validateForm()" action="search_comm_avail_item.php">
						<table>
							<tr>
								<td class="search">Search for :</td>
								<td><input type="text" name="search" size="40px" placeholder="Search here..." /></td>
								<td><input type="submit" value="Search" style="cursor:pointer;"/></td>
							</tr>
						</table>
					</form>
					<br />
					<table class="inventory_table" id="alternatecolor">
						<tr>
							<th width="60">Code</th>
							<th>Description</th>
							<th>Brand</th>
							<th width="60">Qty left</th>
							<th width="60">Unit</th>
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
							<td><?php echo $row["item_code"];?></td>
							<td><?php echo $row["item_name"];?></td>
							<td><?php echo $row["brand_name"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td><?php echo $row["unit_name"];?></td>
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
					</table><br />
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
