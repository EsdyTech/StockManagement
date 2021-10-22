<?php require_once('includes/connection.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php require('includes/header.php');?>

	<table id="sidebar">
		<tr id="navbox">
			<td>
				<ul id="nav">
					<li><a href="index.php"class="current">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="loginform.php">Login</a></li>
				</ul>
			</td>
		</tr>
	</table>
	<br>
    <div id="loginform">
		<form name="form1" method="post" action="login.php">			
			<table align="center">
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td id="login"colspan="2">User Login</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>				
				<td  colspan="2">
					<?php
						if(isset($attempt))
						{
							if($attempt == "null")
							{
							?>
							<div class="error">Enter your username and password.</div>
							<?php
							}
							elseif($attempt == "fail")
							{
							?>
							<div  class="error">Incorrect username or password,<br />make sure caps lock key is off.</div>
							<?php
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" size="20"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" size="20"></td>
			</tr>
			<tr><td colspan="2" align="right"></td>
			</tr>
			<tr>
				<td></td>
				<td class="add" >
					<input type="submit" name="submit" style="cursor:pointer" value="Login" /> 
					<a href="index.php"><input type="button"name="submit" style="cursor:pointer" value="Exit" /></a>
				</td>
			</tr>	
            </table>		
		</form>
</div>
<br>





<?php require('includes/footer.php');?>

</div>
</body>
</html>
