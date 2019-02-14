<?php
/**
 * items.php
 *
 * These are the three items that can be added to the cart.
 * It includes the item class itself, and the three item objects.
 *
 * @package ITC250
 * @authors Aaron Lewis <aaron.lewis@seattlcentral.edu>, Liyun Cecil <liyuncecil@gmail.com>, Derrick Mou <jtrvsconan@gmail.com>, Derek Hendrick <mooserkay@gmail.com>
 * @version 1.1 2019/2/14
 * @link http://derekheducation.dreamhosters.com/p3/index.php
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 */

$myItem = new Item(1, 'Taco', 'Our tacos are awesome', 4.95, 10);
/*$myItem->addExtra('sour cream');
$myItem->addExtra('cheese');
$myItem->addExtra('guacamole');
$myItem->addExtra('salsa');
//out go to bag of food items*/
$items[] = $myItem;

$myItem = new Item(2, 'Hot Dog', 'Our hot dogs are awesome', 5.95, 20);
/*$myItem->addExtra('ketchup');
$myItem->addExtra('onions');
$myItem->addExtra('spicy mustard');
$myItem->addExtra('saurkraut');*/
$items[] = $myItem;

$myItem = new Item(3, 'Sundae', 'Our sundaes are awesome', 3.95, 25);
/*$myItem->addExtra('chocolate');
$myItem->addExtra('nuts');
$myItem->addExtra('whipped cream');
$myItem->addExtra('cherry');*/
$items[] = $myItem;

class Item
{
    //properties
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
  	public $Inventory = 0;
    public $Extras = array(); //presents 1 to many relationships
    
    //constructor
    public function __construct($ID, $Name, $Description, $Price, $Inventory)
    {
        //$this->ID points to the variable $ID
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
      	$this->Inventory = $Inventory;
    }//end constructor
    
    //methods
    public function addExtra($extra)
    {    
        $this->Extras[] = $extra;   
    }//end function addExtra();
}//end Item class
