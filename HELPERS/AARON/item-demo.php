<?php
/**
 * item-demo2.php, based on demo_postback_nohtml.php is a single page web application that allows us to request and view 
 * a customer's name
 *
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch 
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 * 
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the 
 * unique identifier for the next step of a multi-step process
 *
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

# '../' works for a sub-folder.  use './' for the root  
//require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
include './items.php'; 
/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

//END CONFIG AREA ----------------------------------------------------------

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
	global $config;
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
	'<h3 align="center"> demo food truck </h3>
	<p align="center">Please place your order here</p> 
	<form action="" method="post" onsubmit="return checkForm(this);">
             ';
  
    
    foreach($config->items as $item)
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
	
	
	echo '<h3 align="center">demo food truck </h3>';
    
    $main_subtotal = 0;
	
	foreach($_POST as $name => $value)
    {//loop the form elements  // FLAG_FOR_LOOP
        
        //if form name attribute starts with 'item_', process it
        if(substr($name,0,5)=='item_')
        { // FLAG_IF_B
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
            if($value !== "")
            { // FLAG_IF_A
                $subtotal = $value * $thisItem->Price;            
                echo "<p>You ordered $value of $thisItem->Name(s) which cost $subtotal</p>";
                
            
            } // FLAG_IF_A
                $main_subtotal = $main_subtotal + $subtotal;
                echo "<p>Your running total is   $main_subtotal</p>";
                echo "<br><br>";
            

           
        } // FLAG_IF_B
        
        



    } // FLAG_FOR_LOOP
    
        $tax_rate = 0.10 ; // Seattle Standard Tax Rate of 10%
        $main_tax_value = $tax_rate * $main_subtotal;
        $main_total_value = $main_subtotal + $main_tax_value;

        echo "<p>Your total tax is:   $main_tax_value </p>";
        echo "<p>Your total bill due is:   $main_total_value </p>";
    



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
    global $config;
    foreach($config->items as $item){
        if($item->ID == $id){
            return $item;
        }
    }
    
    
}
?>