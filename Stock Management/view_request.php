<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>

	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">User</a></li>
						<li><a href="supplier.php">Suppliers</a></li>
						<li><a href="received_item.php">Received Item</a></li>
						<li><a href="item.php">Items</a></li>
						<li><a href="request_items.php"class="current">Request Items</a></li>
						<li><a href="po.php">Purchased Order</a></li>						
						<li><a href="borrow.php">Borrow</a></li>
						<li><a href="report.php">Reports</a></li>
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
					<div class="label">Request Details</div>
					<hr />
					<?php
					function valid($id, $subj, $item_name, $error)
					{
					?>
					<fieldset>
					<legend><div class="legend"><b>View request details</b></div></legend>
					<div id="add_supplierform">
						<form name="form1" method="GET" action="">
							<table>
								<tr>
									<td><input type="hidden" name="req_id" value="<?php echo $id; ?>"/></td>
								</tr>
								<tr>
									<td>Purpose:</td>
									<td><input type="text"  size="30px" name="subject" readonly="readonly" value="<?php echo $subj; ?>"></td>
								</tr>
								<tr>
									<td>Item name :</td>
									<td><input type="text" name="item_name" readonly="readonly" value="<?php echo $item_name; ?>"/></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="submit" value="Add to PO"/></td>
								</tr>		
							</table>		
						</form>
					</div>
					</fieldset>
					<p class="add">
						<a href="request_items.php"><input type="Button" name="Btnadd" style="cursor:pointer;" value="Back"></a>
					</p>
					<?php
					}

					if (isset($_GET['submit']))
					{
						if (is_numeric($_GET['req_id']))
						{
							$id = $_GET['req_id'];
							$subj = mysql_real_escape_string(htmlspecialchars($_GET['subject']));
							$item_name = mysql_real_escape_string(htmlspecialchars($_GET['item_name']));
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
							$result = mysql_query("SELECT * FROM request WHERE id=$id")
							or die(mysql_error());
							$row = mysql_fetch_array($result);

							if($row)
							{
								$subj= $row['subject'];
								$item_name = $row['item_name'];


								valid($id, $subj, $item_name, '');
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
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
