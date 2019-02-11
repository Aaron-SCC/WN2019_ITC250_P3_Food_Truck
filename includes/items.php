<?php
//index.php

$myItem = new Item(1, 'Taco', 'Our tacos are awesome', 4.95);
/*$myItem->addExtra('sour cream');
$myItem->addExtra('cheese');
$myItem->addExtra('guacamole');
$myItem->addExtra('salsa');
//out go to bag of food items*/
$items[] = $myItem;

$myItem = new Item(2, 'Hot Dog', 'Our hot dogs are awesome', 5.95);
/*$myItem->addExtra('ketchup');
$myItem->addExtra('onions');
$myItem->addExtra('spicy mustard');
$myItem->addExtra('saurkraut');*/
$items[] = $myItem;

$myItem = new Item(3, 'Sundae', 'Our sundaes are awesome', 3.95);
/*$myItem->addExtra('chocolate');
$myItem->addExtra('nuts');
$myItem->addExtra('whipped cream');
$myItem->addExtra('cherry');*/
$items[] = $myItem;

class Item{
    //properties
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array(); //presents 1 to many relationships
    
    //constructor
    public function __construct($ID, $Name, $Description, $Price){
        //$this->ID points to the variable $ID
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
    }//end constructor
    
    //methods
    public function addExtra($extra){
        
        $this->Extras[] = $extra;
        
    }//end function addExtra();
}//end Item class
?>

        
