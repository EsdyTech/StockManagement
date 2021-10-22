<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<script type="text/javascript">
function showDiv(prefix,chooser) 
{
        for(var i=0;i<chooser.options.length;i++) 
		{
        	var div = document.getElementById(prefix+chooser.options[i].value);
            div.style.display = 'none';
        }
 
		var selectedOption = (chooser.options[chooser.selectedIndex].value);
		if(selectedOption == "1")
		{
			displayDiv(prefix,"1");
		}
		if(selectedOption == "2")
		{
			displayDiv(prefix,"2");
		}
		if(selectedOption == "3")
		{
			displayDiv(prefix,"3");
		}
		if(selectedOption == "4")
		{
			displayDiv(prefix,"4");
		}
		if(selectedOption == "5")
		{
			displayDiv(prefix,"5");
		}
} 
function displayDiv(prefix,suffix) 
{
        var div = document.getElementById(prefix+suffix);
        div.style.display = 'block';
}
</script>
	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="user.php">Add User</a></li>
							<li><a href="supplier.php">Add Suppliers</a></li>
						<!--	<li><a href="received_item.php">Recieved Items</a></li>-->
                        <li><a href="category.php" >Add Category</a></li>
							<li><a href="item.php" >Add Items</a></li>
                             <li><a href="addmoreitem.php" >Recieve More Items</a></li>
							<li><a href="request_items.php">Request Items</a></li>
						<!--	<li><a href="po.php">Purchased Order</a></li>	-->					
							<!--<li><a href="borrow.php">Borrow</a></li>-->
                            <li><a href="admin_report.php"  class="current">Reports</a></li>
							<!--<li><a href="report.php">Reports</a></li>-->
					</ul>
				</td>
			</tr>
	</table>
				
	<table id="contentbox">
		<tr>
			<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
				<hr />
				<div id="report">
				Select category:
				<select name="portal" id="cboOptions" onChange="showDiv('div',this)">
					<option value="1">...</option>
					<option value="2">Daily report</option>
					<option value="3">Monthly report</option>
				</select>
				<br /><br />
						  
				<div id="div1" style="display:none;"></div>	
				<div id="div2" style="display:none;">
					<form action="daily_report.php" method="post" >
						Daily report: 
						<select name="daily">
							<option value="">...</option>
							<option value="New Items">New Items</option>
                            <option value="Added Items">Added Items</option>
                            <option value="Requested Items">Requested Items</option>
							<option value="Supplied Items">Supplied Items</option>
						</select>&nbsp;&nbsp;&nbsp;
						Date: <input name="dayto" size="24px"  type="text" class="tcal" />
						<input name="" type="submit" style="cursor:pointer;" value="Print Report" />
					</form>
				</div>
				
				<div id="div3" style="display:none;">
					<form action="monthly_report.php" method="post" >
						Monthly report: 
						<select name="monthly">
							<option value="">...</option>
							<option value="New Items">New Items</option>
                            <option value="Added Items">Added Items</option>
                            <option value="Requested Items">Requested Items</option>
							<option value="Supplied Items">Supplied Items</option>
						</select>&nbsp;&nbsp;&nbsp;
						From: <input name="dayfrom" size="24px"  type="text" class="tcal" />&nbsp;&nbsp;
						To: <input name="dayto" size="24px"  type="text" class="tcal" />
						<input name="" type="submit" style="cursor:pointer;" value="Print Report" />
					</form>
				</div>
				
				<div id="div4" style="display:none;">
					<form action="" method="post">
						Quarterly report: 
						<select name="masterfile">
							<option value="">...</option>
							<option value="">Items</option>
							<option value="">Purchases</option>
							<option value="">Suppliers</option>
						</select>&nbsp;&nbsp;&nbsp;
						From: <input name="dayfrom" size="24px" type="text" class="tcal" />&nbsp;&nbsp;
						To: <input name="dayto" size="24px"  type="text" class="tcal" />
						<input name="" type="submit" style="cursor:pointer;" value="Print Report" />
					</form>
				</div>
				
				<div id="div5" style="display:none;">
					<form action="" method="post">
						Annual report: 
						<select name="masterfile">
							<option value="">...</option>
							<option value="">Items</option>
							<option value="">Purchases</option>
							<option value="">Suppliers</option>
						</select>&nbsp;&nbsp;&nbsp;
						From: <input name="dayfrom" size="24px"  type="text" class="tcal" />&nbsp;&nbsp;
						To: <input name="dayto" size="24px"  type="text" class="tcal" />
						<input name="" type="submit" style="cursor:pointer;" value="View Report" />
					</form>
				</div>
				</div>
			</td>
		</tr>
	</table>
<?php require('includes/footer.php');?>
