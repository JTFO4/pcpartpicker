<!DOCTYPE html>
<html>
<body>

<h2>A TOTALLY NORMAL CART</h2>
<?php
  session_start();
  require_once('cart_class.php');

  if (isset($_POST['subAdd']))
  {
    $myObj = new Cart();
    $myObj->addToCart($_POST['addsku'], $_POST['addquant']);
  }
  if (isset($_POST['subQuantC']))
  {
    $myObj = new Cart();
    $myObj->changeQuantity($_POST['changesku'], $_POST['changequant']);
  }
  if (isset($_POST['subRC']))
  {
    $myObj = new Cart();
    $myObj->removeFromCart($_POST['removesku']);
  }


?>

<h3>Add To Cart</h3>
<form method="post" action="cartTest.php">
  SKU:<br>
  <input type="text" name="addsku" value="">
  <br>
  Quantity:<br>
  <input type="text" name="addquant" value="">
  <br><br>
  <input type="submit" name="subAdd" value ="Submit">
</form> 

<h3>Change Quantity</h3>
<form method="post" action="cartTest.php">
  SKU:<br>
  <input type="text" name="changesku" value="">
  <br>
  Quantity:<br>
  <input type="text" name="changequant" value="">
  <br>
  <input type="submit" name="subQuantC" value ="Submit">
</form> 

<h3>Remove From Cart</h3>
<form method="post" action="cartTest.php">
  SKU:<br>
  <input type="text" name="removesku" value="" >
  <br>
  <input type="submit" name="subRC" value ="Submit">
</form> 

<h3>Cart Contents</h3>
<?php

//Make sure that the session variable actually exists!
if(isset($_SESSION['arraySKU'])){
  //Loop through it like any other array.
  foreach($_SESSION['arraySKU'] as $sku){
      //Print out the product ID.
      echo $sku . " " . " ". " ". " ". " ". " ". " ". " ". " ". " ". " " .  $_SESSION['arrayQuant'][$sku]  . "<br>";
  }
}

?>



</body>
</html>