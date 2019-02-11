<?php include 'includes/header.php'; ?>
<?php include 'includes/items.php'; ?>

<?php
//index.php

$cost = 0;
$number_of_items = 0;
foreach($items as $item) 
{
    $cost += $item->Price;
    $number_of_items++;
    //loop through the data

    echo "<tr>
          <td>$item->Name</td>
          <td>$item->Description</td>
          <td>$item->Price</td>
          </tr>";
    }
?>
            
<?php include 'includes/footer.php'; ?>           
