<?php
//include the connection file
require_once('includes/connection.php');

//save the data on the DB and send the email
if(isset($_POST['action']) && $_POST['action'] == 'submitform')
{
	//recieve the variables
	$req_id=$_POST['req_id'];	
	$name=$_POST['name'];	
	$subj = $_POST['subject'];
	$unit=$_POST['unit'];								
	$quantity=$_POST['ord_qty'];
	$items = $_POST['order'];
	$price = $_POST['price'];

	if($items == ''||$quantity =='')
		{	
			header("Location: comm_requestform.php?attempt=empty");
		}
	else{
		for($i=0; $i < count($_POST['order']);$i++) {
$totalprice=$price[$i]*$quantity[$i];

		$insert_query = mysql_query("INSERT INTO request (req_id,name,subject,item_name,quantity,unit,price,totalprice, date,status) 
							values('$req_id','$name','$subj','".$items[$i]."','".$quantity[$i]."','".$unit[$i]."','".$price[$i]."','".$totalprice."',now(),'Pending') ") 
							or die ("could not execute query");
		}


	if($insert_query )
	{
		//send the email
		$to = "ouremail@ourisp.com";
		$subject = "New contact from the website";

		//headers and subject
		$headers  = "MIME-Version: 1.0rn";
		$headers .= "Content-type: text/html; charset=iso-8859-1rn";
		$headers .= "From: ".$name." <".$email.">rn";

		$body = "New contact";
		$body .= "Name: ".$name."";
		$body .= "Email: ".$email."";
		$body .= "Subject: ".$subj."";
		$body .= "Item code: ".$item_code."";
		$body .= "Item: ".$items."";
		$body .= "Quantity: ".$quantity."";
		$body .= "Unit: ".$unit."";
		$body .= "Price: ".$price."";

		mail($to, $subject, $body, $headers);

		//ok message
		header("Location:comm_requestform.php?attempt=success");
	}
	}
}

?>