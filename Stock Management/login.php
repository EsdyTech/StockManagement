<?php
session_start();
include('includes/connection.php');

$username=$_POST['username'];
$password=$_POST['password'];

if(!empty($username) && !empty($password))
	{

		$command="select * from user WHERE  username = '".$username."' and password='".$password."'";
		$result1=mysqli_query($con,$command);
		$count=mysqli_num_rows($result1);
		
		$utype_id = "SELECT utype_id FROM user WHERE username='$username'";
        $result2 = mysqli_query($con,$utype_id);
        $result3 = mysqli_fetch_row($result2);
		
		if($count==0)
		{
			header("location:loginform.php?attempt=fail");
		}
		else{
			$sql="select * from user WHERE username='".$username."'";
			$result=mysqli_query($con,$sql);
			while($row=mysqli_fetch_row($result)){
				
					$_SESSION["id"]=$row[0];
					$_SESSION["username"]=$row[5];
										
				switch($result3[0]){

                        case '1':
							header("location: item.php");
                        break;
						
						case '2':
							header("location: auth_available_item.php");
                        break;
						
						case '3':
							header("location: request_form.php");
                        break;

                        default:
							header("location:loginform.php?attempt=unauthorized");
                        break;

                    }
			}
		}
	}
else
	{
		header("location:loginform.php?attempt=null");
	}
?>