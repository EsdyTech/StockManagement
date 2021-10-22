<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
<script type="text/javascript">
function changeVal(t1){
if (!/^[\d-'.']*$/.test(t1.value)) {//validates for numbers
alert('Only valid numbers allowed!');
t1.value = t1.value.replace(/[^\d-'.']/g,'');
}
}
</script>


<script language="javascript"type="text/javascript">
function validateForm()
{

var d=document.forms["request"]["subject"].value;
if (d==null || d=="")
  {
  alert("Empty purpose field.");
  return false;
  }


}
</script>

<script>
function validation3()
{ 
	
var ass = document.getElementsByName('assignment[]');//here rr[] is the name of the textbox
 
        for (var i = 0; i < ass.length; i++)
        {        
        if (ass[i].value > 10)
        {
        alert("Assignment Score Must not be greater than 10");
        ass[i].focus();
        return false;            
        }
        }		
}
</script>




<table id="sidebar">
	<tr id="navbox">
		<td>
			<ul id="nav">
				<li><a href="comm_available_item.php">View available items</a></li>
			</ul>
		</td>
	</tr>
</table>
<table id="contentbox">
			<tr>
				<td id="content">
				<div class="name">Welcome, <b><?php echo $username; ?></b> | <a href="logout.php">Logout</a></div>
				<div class="label">Request form</div>
				<hr />
				<?php
					if(isset($attempt))
					{
						if($attempt == "success")
						{
						?>
						<div class="success">Request successfully sent.</div>
						<?php
						}
						if($attempt == "empty")
						{
						?>
						<div class="error">All fields must be filled out.</div>
						<?php
						}
					}
				?>
				<div id="requestform">
				<form name="request"  method="post"  onsubmit="return validateForm()" action="mail.php">
					<table>
					<tr>
					<td><input type="hidden" id="action" name="action" value="submitform" />
						<input type="hidden" name="req_id" 
						value="<?php
						$id = mysql_query("select MAX(req_id) as max_req_id from request");										
						$row = mysql_fetch_array($id);
						echo $row['max_req_id'] + 1;  										
						?>">
						<input type="hidden" name="name" value="<?php echo $username; ?>" />
					</td>
					</tr>
					<tr>
					<td><b>Purpose:</b></td> 
					<td><input type="text" name="subject" size="40"></td>
					</tr>
					</table>
					<br />
					<table class="inventory_table" >
						<tr>
							<th width="30">Code</th>
							<th>Description</th>
                            <th width="60">Unit</th>									
                            <th>Price</th>
							<th width="60">Quantity</th>
                            <th width="60">Total Price</th>
						</tr>
						<?php								
						$sql = mysql_query('SELECT * FROM itemlist ');									 																	
						while($row = mysql_fetch_array($sql))
						{
						$item_code=$row["item_code"];
						$unit=$row["unit_name"];
						$price=$row["price"];
						?>
						<tr>
							<td><?php echo $item_code; ?></td>
							<td style="text-align:left"><input type="checkbox" name='order[]' value="<?php echo $row["item_name"]; ?>"/><?php echo $row["item_name"];?></td>
                            <td><input type="text" name='unit[]' size="5px" value="<?php echo $unit; ?>" style="border:0px;" readonly="readonly"/></td>			
                            <td><input type="text" name='price[]' size="5px"   value="<?php echo $price; ?>" style="border:0px;" readonly="readonly"/></td>							
                            <td><input type="text" name="ord_qty"   size="5px" /></td>
                              <td><input type="text" name="totalprice[]" style="border:0px;"  readonly="readonly"  size="5px" /></td>
						</tr>
						<?php
						}
						?>
						</table>
					<p  class="add">
						<input type="submit" name="submit" style="cursor:pointer" value="Send request">
					</p>
				</form>
				</div>
				</td>
			</tr>
</table>	
<?php require('includes/footer.php');?>
