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
        if (isset($_SESSION['email']))
        {
            header("Location: updateAccountTest.php");
            exit();
        }
            if(isset($_POST['submit']))
            {
            require_once('account.php');
            $myObj = new Account($_POST['email'], $_POST['password']);
            $myObj->loginUser();


            if ($didSuccess)
            {
                header("Location: updateAccountTest.php");
                exit();
            }
            }
        
        ?>
        <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
                Great Web Application</span>!</h1>
                
        <p style="color: red">
        <?php echo $GLOBALS['errPass'] ?>
        </p>
        
        <form method="post" action="login_dummy2.php">
            <label>Email: </label>
            <input type="text" name="email" value=""> <br>
            <label>Password: </label>
            <input type="password" name="password" value=""> <br>
            <input type="submit" name = "submit" value="Log in">
        </form>
        
        <p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
        </p>
</html>
<?php

?>
