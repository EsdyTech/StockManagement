<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php
error_reporting(0);
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
<script>
function showUs(str) {
    if (str == "") {
        document.getElementById("txtHintss").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintss").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","search2.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


<script>

	function sum() {
      var price = document.getElementById('price').value;
      var qty = document.getElementById('qty').value;
      var totamount = parseInt(price)* parseInt(qty);
      if (!isNaN(totamount)) {
         document.getElementById('totamount').value = totamount;
      }
}

</script>

<table id="sidebar">
	<tr id="navbox">
		<td>
			<ul id="nav">
				<li><a href="comm_available_item.php" class="current">Available Items</a></li>
						<li><a href="request_form.php" >Request Items</a></li>
                        	<li><a href="user_report.php">Report</a></li>
                      <!--  <li><a href="comm_requestform.php">Request</a></li>-->
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
				<form name="request"  method="post"  onsubmit="return validateForm()" action="request_form.php">
                <input type="hidden" name="req_id" 
						value="<?php
						$id = mysqli_query($con,"select MAX(req_id) as max_req_id from request");										
						$row = mysqli_fetch_array($id);
						echo $row['max_req_id'] + 1;  										
						?>">
					<table>
					<tr>
                    <td><b>Select Item:</b></td> 
					<td>
                    <?php
						$sql = mysqli_query($con,"select * from itemlist ");											
					echo '<select name="name" onChange="showUs(this.value)" >';
							echo '<option  value="">None...</option>';
						 while($row = mysqli_fetch_assoc($sql))
						{
						echo '<option value="'. $row['item_name'].'">'. $row['item_name'].'</option>';
						}
						echo'</select>';
										?>
                    
                    
					</td>
					</tr>
                   
                   <?php
          			echo"<div id='txtHintss'></div>";
        				 ?>
                   
                    <?php
          			echo"<div id='txtHintss'></div>";
        			 ?> 
                     
                      <?php
          			echo"<div id='txtHintss'></div>";
        			 ?> 
                    <tr>
					<td><b>Purpose:</b></td> 
					<td><input type="text" name="subject" size="40"></td>
					</tr>
                    <tr>
					<td><b>Quantity:</b></td> 
					<td><input type="text" name="qty"  id="qty" size="40"></td>
					</tr>
                    <tr>
					<td><b>Total Cost/Amount:</b></td> 
					<td><input type="text" onMouseover="return sum()" name="totamount" id="totamount" size="40"></td>
					</tr>
					</table>
					<br />
					<table class="inventory_table" >
						<tr>
                        <th width="30">S/N</th>
							<th width="30">name</th>
							<th>Purpose</th>
                            <th width="30">Item Name</th>									
                            <th>Quantity</th>
							<th width="30">Units</th>
                            <th width="30">Price</th>
                             <th width="30">Total Price</th>
                              <th width="30">Date</th>
                               <th width="30">Status</th>
							   <th width="30">Action</th>
						</tr>
						<?php								
						$sql = mysqli_query($con,'SELECT * FROM request where name="'.$username.'"');									 																	
						while($row = mysqli_fetch_array($sql))
						{$sn=$sn+1;
						
						
						?>
						<tr>
							<td><?php echo $sn; ?></td>
                            <td><?php echo $row['name']; ?></td>
							<td style="text-align:left"><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>			
                            <td><?php echo $row['quantity']; ?></td>							
                            <td><?php echo $row['unit']; ?></td>
                              <td><?php echo $row['price']; ?></td>
                              <td><?php echo$row['totalprice']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['status']; ?></td>
							 <td> 
								 <?php if($row['status'] == 'Pending'){?>
								 <a href="JavaScript:if(confirm('Are you sure you want to delete this record?')==true)
							{window.location='delete_request.php?req_id=<?php echo $row['id']?>';}">Delete</a>
									<?php }?>
						</td>
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
                
                
                
                
                
                
   <?php 
                
                
                
                if(isset($_POST['submit']))
{
	//recieve the variables
	$req_id=$_POST['req_id'];	
	$name=$_POST['name'];	
	$subj = $_POST['subject'];
	$unit=$_POST['unit'];								
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$totamount=$_POST['totamount'];
	$date = date('Y-m-d');

	if($subj == ''||$qty =='')
		{	
			header("Location: request_form.php?attempt=empty");
		}
	else{
		

		$insert_query = mysqli_query($con,"INSERT INTO request (req_id,name,subject,item_name,quantity,unit,price,totalprice,date,status) values('$req_id','$username','$subj','$name','$qty','$unit','$price','$totamount','$date','Pending')") 
							or die ("could not execute query");
		
							if(mysqli_affected_rows()==1){
								echo'	<div class="success">Record successfully updated.</div>';
								echo "<script type = \"text/javascript\">
								window.location = (\"request_form.php\");
								</script>";									}
									

		// //send the email
		// $to = "Ahmedsodiq7@gmail.com";
		// $subject = "New contact from the website";

		// //headers and subject
		// $headers  = "MIME-Version: 1.0rn";
		// $headers .= "Content-type: text/html; charset=iso-8859-1rn";
		// $headers .= "From: ".$name." <".$email.">rn";

		// $body = "New contact";
		// $body .= "Name: ".$name."";
		// $body .= "Email: ".$email."";
		// $body .= "Subject: ".$subj."";
		// $body .= "Item code: ".$item_code."";
		// $body .= "Item: ".$items."";
		// $body .= "Quantity: ".$quantity."";
		// $body .= "Unit: ".$unit."";
		// $body .= "Price: ".$price."";

		// mail($to, $subject, $body, $headers);

		//ok message
	
	}
}

                 
                
                ?>
                
				</td>
			</tr>
</table>	
<?php require('includes/footer.php');?>
