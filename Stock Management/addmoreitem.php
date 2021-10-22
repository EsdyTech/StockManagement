<?php require_once('includes/header.php');?>
<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<?php 
if(isset($_GET["attempt"]))
{
$attempt=$_GET["attempt"];
}
?>
<script language="javascript"type="text/javascript">
function validateForm()
{
var x=document.forms["formsearch"]["search"].value;
if (x==null || x=="")
  {
  alert("Please enter PO #");
  return false;
  }
}
</script>


<script>
function showUsers(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","search3.php?qqs="+str,true);
        xmlhttp.send();
    }
}
</script>

<script>
function showUsss(str) {
    if (str == "") {
        document.getElementById("txtHints").innerHTML = "";
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
                document.getElementById("txtHints").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","search4.php?ssq="+str,true);
        xmlhttp.send();
    }
}
</script>


<script>

	function sum() {
      var qtystck = document.getElementById('qtystck').value;
      var addqty = document.getElementById('addqty').value;
      var newqty = parseInt(qtystck) + parseInt(addqty);
      if (!isNaN(newqty)) {
         document.getElementById('newqty').value = newqty;
      }
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
                             <li><a href="addmoreitem.php" class="current">Recieve More Items</a></li>
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
					<div class="label">Add More to Existing Item</div>
					<hr />
					<?php
						if(isset($attempt))
						{
							if($attempt == "success")
							{
							?>
							<div class="success">Record successfully updated.</div>
							<?php
							}
							elseif($attempt == "saved")
							{
							?>
							<div  class="success">Record successfully saved.</div>
							<?php
							}
							elseif($attempt == "exist")
							{
							?>
							<div  class="error"><b>Unable to add name already exist.</div>
							<?php
							}
							elseif($attempt == "empty")
							{
							?>
							<div  class="error">All fields must be filled out.</div>
							<?php
							}
						}
					?>
                    
                    
                    <?php
						if (isset($_POST['submit']))
							{
							
							$date=date("Y-m-d");
							$supplier_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['supplier_name']));
							$item_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['item_name']));
								$qtystck = mysqli_real_escape_string($con,htmlspecialchars($_POST['qtystck']));
								$addqty = mysqli_real_escape_string($con,htmlspecialchars($_POST['addqty']));
								$newqty = mysqli_real_escape_string($con,htmlspecialchars($_POST['newqty']));

								if ($qtystck == '' || $addqty == '' || $newqty == '')
								{
									header("Location:addmoreitem.php?attempt=empty");
								}
							
							else{
						$insert = "INSERT INTO added_item (supplier_name,item_name,qty_stck,qty_added,new_qty,date_added) values('$supplier_name','$item_name','$qtystck','$addqty','$newqty','$date')"; 
				
				 $rees=mysqli_query($con,$insert);
				if (mysqli_affected_rows($con) == 1)
				{	
							
				$qry= "UPDATE itemlist SET quantity='$newqty' WHERE supplier_name='$supplier_name' AND item_name='$item_name '";
				$res=mysqli_query($con,$qry);
				if(mysqli_affected_rows($con) == 1){
					echo'	<div class="success">Record successfully updated.</div>';
				}
				}
			else
			{
				echo "<center>An Error Occurred..!</center>";
							
							
							
							}
							
							}	
									
							}
					?>
                    
					<form name="formsearch" method="post" action="addmoreitem.php">
						<table>
							<tr>
								<td class="search">Select Supplier Name :</td>
                                <td><?php
											$sql = mysqli_query($con,"select * from supplier");											
											echo '<select name="supplier_name" onChange="showUsers(this.value)" required>';
											echo '<option value="">None...</option>';
											 while($row = mysqli_fetch_assoc($sql))
											{
											echo '<option value="'. $row['supplier_name'].'">'. $row['supplier_name'].'</option>';
											}
											echo'</select>';
										?></td>
                                <tr>
                                <td class="search">Select Item Name:</td>
                                <td>
									<?php
          							echo"<div id='txtHint'></div>";
        					 		 ?>
                                 </td>
                                 <tr>
                                <td class="search">Quantity In stock</td>
                                <td><?php
          							echo"<div id='txtHints'></div>";
        					 		 ?></td>
                                </tr>
                                 <tr>
                                <td class="search">Enter Quantity:</td>
                                <td><input type="text" name="addqty" id="addqty" required placeholder="Enter Quantity" /></td>
                                </tr>
                                <tr>
                                <td class="search">New Quantity Available:</td>
                                <td><input type="text" name="newqty" id="newqty" required readonly="readonly" onMouseover="return sum()" placeholder="New Quantity" /></td>
                                </tr>
                                <tr>
                             <td align="center"><input type="submit" name="submit"  required value="Add Item" style="cursor:pointer;"/></td>
                                </tr>
							</tr> 
						</table>
                        
					</form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					<br />
                    
				</td>
			</tr>
	</table>
<?php require('includes/footer.php');?>
