<?php include 'includes/header.php'; ?>
<?php include 'includes/items.php'; ?>

<?php

$cost = 0;
$number_of_items = 0;
foreach($items as $item) 
{
    $cost += $item->Price;
    $number_of_items++;
    
    echo '
        <tr>
          <td>' . $item->Name . '</td>  
          <td>' . $item->Description . '</td>
          <td>' . $item->Price . '</td>
        </tr>
          ';
    }
?>

<?
# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction) 
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showData();
	 	break;
	default: # 1)Ask user to enter their name 
	 	showForm();
}

function showForm()
{# shows form so user can enter their name.  Initial scenario
	global $items;
    //get_header(); #defaults to header_inc.php	
	
	echo 
	/*<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourName,"Please Enter Your Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
    */
	'
	<p align="center">Please place your order here</p> 
	<form action="" method="post" onsubmit="return checkForm(this);">
             ';
  
    
    foreach($items as $item)
      {
        //echo "<p>ID:$item->ID  Name:$item->Name</p>"; 
        //echo '<p>Taco <input type="text" name="item_1" /></p>';

          echo '<p>' . $item->Name . ' <input type="text" name="item_' . $item->ID . '" /></p>';

      }       
 
      echo '
            <p>
            <input type="submit" value="Submit order">
            </p>
            <input type="hidden" name="act" value="display" />
            </form>
            ';
	//get_footer(); #defaults to footer_inc.php
}

function showData()
{#form submits here we show entered name
	
    //dumpDie($_POST);
    //get_header(); #defaults to footer_inc.php
	
	foreach($_POST as $name => $value)
    {//loop the form elements
        
        //if form name attribute starts with 'item_', process it
        if(substr($name,0,5)=='item_')
        {
            //explode the string into an array on the "_"
            $name_array = explode('_',$name);

            //id is the second element of the array
			//forcibly cast to an int in the process
            $id = (int)$name_array[1];
            
            $thisItem = getItem($id);
            //dumpDie($thisItem);
			/*
				Here is where you'll do most of your work
				Use $id to loop your array of items and return 
				item data such as price.
				
				Consider creating a function to return a specific item 
				from your items array, for example:
				
				$thisItem = getItem($id);
				
				Use $value to determine the number of items ordered 
				and create subtotals, etc.
			
			*/
            //echo "<p>You ordered $value of item number $id</p>";
            if($value !== ""){
                 $subtotal = $value * $thisItem->Price;
            
            echo "<p>You ordered $value of $thisItem->Name(s) which cost $subtotal</p>";
            
            }
           
        }

    }

	echo '<p align="center"><a href="">RESET</a></p>';
	//get_footer(); #defaults to footer_inc.php
}

/*
public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
*/
function getItem($id){
    global $items;
    foreach($items as $item){
        if($item->ID == $id){
            return $item;
        }
    }
    
    
}
?>

<?php include 'includes/footer.php'; ?>           
