<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in to Website</title>
        <style>
            input 
            {
                margin-bottom: 0.5em;
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_POST['submit']))
        {
         if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']))
         {
            require_once('account.php');
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['username'];
            $pass =  $_POST['password'];
            $pass2 = $_POST['password2'];

           // echo $_POST['firstname'];
            //echo $_POST['lastname'];
            //echo $_POST['username'];
            //echo $_POST['password'];
           // echo $_POST['password2'];

            $myObj = new Account($email, $pass, $fname, $lname, $pass2);
            $myObj->registerUser();
            if ($didSuccess)
            {
                sleep(3);
                header("Location: happiness.html");
                exit();
            }
            
         }
         else
         {
             $GLOBALS['errString'] = "All form fields must be completed.";
         }
        }
        ?>
        <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
                Great Web Application</span>!</h1>
                
        <p style="color: red">
        </p>
        <form method="post" action="login_dummy.php">
            <label>Email: </label>
            <input type="text" name="username" placeholder = "Email@email.com" value="<?php echo $email; ?>"> <p style="color: red"><?php echo $GLOBALS['errEmail']; echo $GLOBALS['errExists']; ?> </p> 
            <label>Password: </label>
            <input type="password" name="password" value=""> <p style="color: red"><?php  echo $GLOBALS['errPass']; ?></p>
            <label>Confirm Password: </label>
            <input type="password" name="password2" value=""> <p style="color: red"><?php  echo $GLOBALS['errPass']; ?></p>
            <label>First Name: </label>
            <input type="text" name="firstname" placeholder = "First" value="<?php echo $fname; ?>"> <p style="color: red"><?php echo $GLOBALS['errFirstName']; ?></p>
            <label>Last Name: </label>
            <input type="text" name="lastname" placeholder = "Last" value="<?php echo $lname; ?>"> <p style="color: red"><?php  echo $GLOBALS['errLastName']; ?></p>
            <input type="submit" name = "submit" value="Log in">
        </form>
        <p style="color: red"><?php  echo $GLOBALS['errString']; ?></p>
        
        <p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
        </p>
</html>
<?php

?>
