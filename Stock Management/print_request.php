<?php require_once('includes/connection.php');?>
<?php include('includes/get_username.php');?>
<link href="printstyle.css" media="all" rel="stylesheet" type="text/css" />

<table align="center">
<tr>
<td>
<div class="printtitle">BSU Supply Office</div>
<b>Alubijid External Studies Center<br />
Alubijid, Misamis Oriental</b>
<hr />
<div id="print">
						<table class="date">
							<tr>
								<td width="110"><b>Date ordered:</b></td>
								<td><?php echo date("m/d/Y"); ?></td>
							</tr>
							<tr>
								<td><b>Supplier:</b></td>
								<td><?php
									
									$query="select * from purchase_order where po_id=po_id limit 1";
									$result=mysql_query($query);									 																	
									while($row = mysql_fetch_array($result))
									{
									echo $row["supplier_name"];
									}									
									?>
								</td>
							</tr>						
						</table>
						<br />
						<?php

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


							?>
						<table class="inventory_table">
								<tr>
									<th width="50">PO no.</th>
									<th>Item name</th>
									<th width="70">Qty ordered</th>
									<th width="60">Unit</th>
									<th width="60">Price</th>
									<th width="60">Total</th>
								</tr>
								<?php
								
								$query="select * from purchase_item ";
								$result=mysql_query($query);									 																	
								while($row = mysql_fetch_array($result))
								{																
								echo '<tr>';
								echo '<td>'. $row["po_id"] .'</td>';
								echo '<td>'. $row["item_name"] .'</td>';
								echo '<td>'. $row["ord_qty"] .'</td>';
								echo '<td>'. $row["unit"] .'</td>';
								
								echo '<td>';
								$p=$row['price'];		
								echo formatMoney($p, true);'</td>';
																
								echo '<td>'; 
								$t=$row['total'];		
								echo formatMoney($t, true);'</td>';
								
								echo '</tr>';								
								}
								?>
							</table>
							<p>
							<b>Grand total: P</b>
							<?php
								$sql = mysql_query("SELECT sum(total) FROM purchase_item ");
								while($row = mysql_fetch_array($sql))
								{
									$total=$row['sum(total)'];
									echo formatMoney($total, true);							 
								}
							?>
							 </p><br />
							<p><b>Supply Office Incharge:</b>___________________________</p><br />
							<p><b>Approved by:</b>______________________________<br />
							<div style="margin-left:100px">
							Mr. Reynaldo S. Cabillan<br />
							Center Administrator<br />
							BSU,AESC</div>
							</p>
					</div>
</td>
</tr>
</table>