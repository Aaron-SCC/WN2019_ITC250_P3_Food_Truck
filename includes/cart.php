<$php
//cart.php

$showMessage = '';

if(isset($_POST['addToCart']))
{
	// Disallow incorrect data and provide feedback
  	if(!is_numeric($_POST['quantity'])||strpos($_POST['quantity'],'.')!==false)
    {
      header("location:index.php?integer=1");
    }
  	else
    {
		if(isset($_COOKIE['shoppingCart']))
		{
			$cookieData = stripslashes($_COOKIE['shoppingCart']);

			$cartData = json_decode($cookieData, true);
		}
		else
		{
			$cartData = array();
		}

		$listItemId = array_column($cartData, 'itemId');

		// in_array: Checks if a value exists in an array
		if(in_array($_POST['id'], $listItemId))
		{
			foreach($cartData as $keys => $values)
			{
				if($cartData[$keys]['itemId'] == $_POST['id'])
				{
					$cartData[$keys]['itemQuantity'] = $cartData[$keys]['itemQuantity'] + $_POST['quantity'];
				}
			}
		}
		else
		{
			$itemArray = array(
				'itemId'				=>	$_POST['id'],
				'itemName'				=>	$_POST['name'],
          		'itemDescription'		=>	$_POST['description'],
				'itemPrice'				=>	$_POST['price'],
				'itemQuantity'			=>	$_POST['quantity']
			);
			$cartData[] = $itemArray;
		}

		$itemData = json_encode($cartData);

		// setting expiration time of the cookie to 30 days
		setcookie('shoppingCart', $itemData, time() + (3600 * 24 * 30));
		header("location:index.php?added=1");
	}
}

if(isset($_GET['action']))
{
	if($_GET['action'] == 'delete')
	{
		$cookieData = stripslashes($_COOKIE['shoppingCart']);
		$cartData = json_decode($cookieData, true);
		foreach($cartData as $keys => $values)
		{
			if($cartData[$keys]['itemId'] == $_GET["id"])
			{
				unset($cartData[$keys]);
				$itemData = json_encode($cartData);
				// setting expiration time of the cookie to 30 days
				setcookie("shoppingCart", $itemData, time() + (3600 * 24 * 30));
				header("location:index.php?remove=1");
			}
		}
	}
	if($_GET["action"] == "clear")
	{
		setcookie("shoppingCart", "", time() - 3600);
		header("location:index.php?clearcart=1");
	}
}
// get the operation status and show message.
if(isset($_GET["integer"]))
{
	$showMessage = '<div align="center" class="alert alert-warning" role="alert">Only integer!</div>';
}

if(isset($_GET["added"]))
{
	$showMessage = '<div align="center" class="alert alert-success" role="alert">Item has been added to the shopping cart.</div>';
}

if(isset($_GET["remove"]))
{
	$showMessage = '<div align="center" class="alert alert-warning" role="alert">Item has been removed from shopping cart.</div>';
}
if(isset($_GET["clearcart"]))
{
	$showMessage = '<div align="center" class="alert alert-danger" role="alert">Shopping cart has been emptied.</div>';
}

?>