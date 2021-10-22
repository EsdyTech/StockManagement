<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
<?php
session_start();
?>

	<table id="sidebar">
			<tr id="navbox">
				<td>
					<ul id="nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php"class="current">About</a></li>
						<li><a href="loginindex.php">Login</a></li>
					</ul>
				</td>
			</tr>
	</table>
<table id="contentbox">
	<tr>
		<td id="content">
			<div class="loginname">About Online Supply Inventory System</div>
			<br />
			<div id="about">
			Online Supply Inventory system deals primarily with determining the size and placement 
			of the materials within a facility or within multiple locations of a supply chain network. 
			It is also concerned with the importance of forecasting the required inventory, availability of physical space, 
			and cost in carrying those inventories to maintain the planned course of production against the random fluctuations, 
			or shortage of materials. One way of managing inventory is to have a web-based system in place 
			that can instantly track and update the information about the tools or equipment.
			</div><br /><br /><br /><br /><br /><br /><br /><br /><br />
		</td>
	</tr>
</table>	
<?php require('includes/footer.php');?>
