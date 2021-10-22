<?php
function selected_supplier(){
	
	$sql = mysql_query("select * from supplier");											
	 while($row = mysql_fetch_assoc($sql))
	{
	echo $row['supplier_name'];
	}

}
?>