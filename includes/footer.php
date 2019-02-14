   
          </tbody>
      </table>  
      

			<h3>Order Details</h3>
			<div class="table-responsive">
			<?php echo $showMessage; ?>
			<div align="right">
				<a href="index.php?action=clear"><button type="button" class="btn btn-warning">Clear Cart</button></a>
			</div>
			<table class="table table-bordered">
				<tr>
					<th width="10%">Name</th>
                  	<th width="30%">Description</th>
                  	<th width="10%">Price</th>
					<th width="10%">Quantity</th>
					<th width="15%">Total</th>
					<th width="5%">Action</th>
				</tr>
			<?php
			if(isset($_COOKIE["shoppingCart"]))
			{
				//test $_COOKIE
              	//echo $results = print_r($_COOKIE, true);
              	$total = 0;
				$cookieData = stripslashes($_COOKIE['shoppingCart']);
              	//test $cookieData
              	//echo $results = print_r($cookieData, true);
				$cartData = json_decode($cookieData, true);
				foreach($cartData as $keys => $values)
				{
			?>
				<tr>
					<td><?php echo $values['itemName']; ?></td>
                  	<td><?php echo $values['itemDescription']; ?></td>
                  	<td>$ <?php echo $values['itemPrice']; ?></td>
					<td><?php echo $values['itemQuantity']; ?></td>
					
					<td>$ <?php echo number_format($values['itemQuantity'] * $values['itemPrice'], 2);?></td>
					<td><a href="index.php?action=delete&id=<?php echo $values['itemId']; ?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
				</tr>
			<?php	
					$total = $total + ($values['itemQuantity'] * $values['itemPrice']);
				}
			?>
				<tr>
					<td colspan="4" align="right">Total</td>
					<td align="right">$ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
			<?php
			}
			else
			{
				echo '
				<tr>
					<td colspan="6" align="center">Nothing in the cart</td>
				</tr>
				';
			}
			?>
			</table>
			</div>
		</div>
    </div>
      
    </div>
  </body>
</html>
