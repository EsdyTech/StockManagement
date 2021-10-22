<?php require_once('includes/connection.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php require_once('includes/header.php');?>

	<table id="sidebar">
		<tr id="navbox">
			<td>
				<ul id="nav">
					<li><a href="index.php"class="current">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="loginindex.php">Login</a></li>
				</ul>
			</td>
		</tr>
	</table>
	<table id="contentbox">
		<tr>
			<td id="content">
			<div class="loginname"><blink>Welcome to Our Online Stock Management Portal</blink></div>					
			<div id="image"><img src="image/stock.jpg " width='774px' height='335px'/></div>					
			</td>
		</tr>
	</table>	
	<?php require('includes/footer.php');?>

</div>
</body>
</html>
