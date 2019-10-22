<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in to Website</title>
        <style>
            input {
                margin-bottom: 0.5em;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
            require_once('member_admin.php');

            if(isset($_POST['submit']))
            {
               $myObj = new Member($_SESSION['email']);
               $myObj->removeItem($_POST['sku']);
            }
        
        ?>
        <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
                Great Web Application</span>!</h1>
                
        <p style="color: red">
        </p>
        
        <form method="post" action="updateAccountTest.php">
            <h2>PEOPLE STUFF MANE:</h2>
            <label>First Name: </label>
            <input type="text" name="fname" value="<?php echo $_SESSION['firstName']; ?>"> <p style="color: red"><?php echo $GLOBALS['errFirstName']; ?> </p>
            <label>Last Name: </label>
            <input type="text" name="lname" value="<?php echo $_SESSION['lastName'];?>">  <p style="color: red"><?php echo $GLOBALS['errLastName']; ?> </p>
            <label>Email: </label>
            <input type="text" name="email" value="<?php //echo $myObj->getemail();?>"> <p style="color: red"><?php  echo $GLOBALS['errExists'];
                                                                                                                   echo $GLOBALS['errEmail']; ?> </p>
            <label>Address 1: </label>
            <input type="text" name="addr1" value="<?php //echo $myObj->getaddr1();?>"> <p style="color: red"><?php echo $GLOBALS['errAddr1']; ?> </p>
            <label>Address 2: </label>
            <input type="text" name="addr2" value="<?php //echo $myObj->getaddr2();?>"> <p style="color: red"><?php echo $GLOBALS['errAddr2']; ?> </p>
            <label>City: </label>
            <input type="text" name="city" value="<?php //echo $myObj->getcity();?>"> <p style="color: red"><?php echo $GLOBALS['errCity']; ?> </p>
            <label>State: </label>
            <input type="text" name="state" value="<?php //echo $myObj->getstate();?>"> <p style="color: red"><?php echo $GLOBALS['errState']; ?> </p>
            <label>Zip: </label>
            <input type="text" name="zip" value="<?php //echo $myObj->getzip();?>"> <p style="color: red"><?php echo $GLOBALS['errZip']; ?> </p>
            <label>Credit Card: </label>
            <input type="text" name="cc" value=""> <p style="color: red"><?php echo $GLOBALS['errCC']; ?> </p>



            <h2> ADMIN STUFF MANE:</h2>
            <label>Adjust Item Quantity: </label>
            <select name = "quantOp">
            <option value="+">+</option>
            <option value="-">-</option>
            </select>
            <input type="text" name="quantAmnt" value=""> <p style="color: red"><?php echo $GLOBALS['errCC']; ?> </p>
            <label>Sale Price: </label>
            <input type="text" name="price" value=""> <p style="color: red"> </p>
            <h2> ADD NEW ITEM MANE:</h2>
            <label>SKU: </label>
            <input type="text" name="sku" value=""> <p style="color: red"> </p>
            <label>Item Category: </label>
            <input type="text" name="itemcat" value=""> <p style="color: red"></p>
            <label>Item Name: </label>
            <input type="text" name="itemname" value=""> <p style="color: red"></p>
            <label>MSRP: </label>
            <input type="text" name="msrp" value=""> <p style="color: red"></p>

            <input type="submit" name = "submit" value="Log in">
        </form>
        
        <p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
        </p>
</html>
<?php

?>
