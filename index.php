<?php include 'includes/header.php'; ?>

<?php
//index.php
$cost = 0;
$number_of_items = 0;
foreach($items as $item) 
{
    $cost += $item->Price;
    $number_of_items++;
    //loop through the data
?>
    	  <tr>
          <form method='post'>
          <input type='hidden' name='id' value='<?php echo $item->ID; ?>' />
            
          <input type='hidden' name='name' value='<?php echo $item->Name; ?>' />
          <td><?php echo $item->Name; ?></td>
            
          <input type='hidden' name='description' value='<?php echo $item->Description; ?>' />
          <td><?php echo $item->Description; ?></td>
          
		  <input type='hidden' name='price' value='<?php echo $item->Price; ?>' />
          <td><?php echo $item->Price; ?></td>
            
          <td><?php echo $item->Inventory; ?></td>
          
          <td>
          	<input type='text' name='quantity' value='1' class='form-control' />
          </td>
          
          
          <td>
         	<input type='submit' name='addToCart' style='margin-top:5px;' class='btn btn-success' value='Add to Cart' />
          </td>
          </form>
          </tr>
<?php
}
?>
            
<?php include 'includes/footer.php'; ?>
