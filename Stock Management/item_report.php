<a href="report.php">Back </a>
<div align="center">Item Report From:<strong> <?php echo $_POST['dayfrom']; ?></strong>&nbsp;&nbsp;To:<strong> <?php echo $_POST['dayto']; ?>
<br />
    </strong></div>
<table border="1px" style="margin:0 auto;"	>
  <tr>
    <th width="85">Date</th>
    <th width="174">Code</th>
    <th width="294">Supplier Name </th>
    <th width="127">Total</th>
  </tr>
  <?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("supplier_inventory", $con);

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}		
$a=$_POST['dayfrom'];
$b=$_POST['dayto'];
 
$result1 = mysql_query("SELECT * FROM itemlist WHERE date BETWEEN '$a' AND '$b'");

while($row = mysql_fetch_array($result1))
{
  echo '<tr>';
    echo '<td>'.$row['date'].'</td>';
    echo '<td>'.$row['item_code'].'</td>';
	echo '<td>'.$row['supplier_name'].'</td>';
    echo '<td>';
	$eee=$row['total'];
	echo formatMoney($eee, true);
	
	echo '</div></td>';
    
  echo '</tr>';
 }

mysql_close($con);
?>  
<tr>
    <td colspan="3" ><div align="right"><strong>Grand Total</strong></div></td>
    <td width="127">
	
	  <div align="center">
	    <?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("pos", $con);		
$a=$_POST['dayfrom'];
$b=$_POST['dayto'];
 
$result1 = mysql_query("SELECT sum(total) FROM stockinsumarry WHERE pdate BETWEEN '$a' AND '$b'");
while($row = mysql_fetch_array($result1))
{
    $rrr=$row['sum(total)'];
	echo formatMoney($rrr, true);
 }

mysql_close($con);
?> 
      </div></td>
  </tr>
</table><br /><br />

