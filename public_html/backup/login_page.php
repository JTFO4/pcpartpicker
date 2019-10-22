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
          // Is someone already logged in? If so, forward them to the correct
          // page. (HINT: Implement this last, you cannot test this until
          //              someone can log in.)

          if ($_SESSION['type'] == 'user')
          {
            header('Location: user_page.php');
            exit();
          }

          else if ($_SESSION['type'] == 'admin')
          {
            header('Location: admin_page.php');
            exit();
          }
          
          ;
          if(isset($_POST['submit']))
          {
            require_once('account.php');
            require_once('member_admin.php');
            //$myObj = new Account($_POST['email'], $_POST['pass']);
           // $myObj->loginUser();
            echo $_POST['email'];
           // if ($GLOBALS['didSuccess'] == 1)
            //{
                $myObj2 = new Member($_POST['email']);
                echo "hello from after Member";
                $_SESSION['firstName'] = $myObj2->firstName;
                echo "hello from after Member";
                if ($myObj->isAdmin == 1)
                {
                    $_SESSION['type'] == 'admin';
                    header('Location: admin_page.php');
                    exit();
                }

                else
                {
                    $_SESSION['type'] == 'user';
                    header('Location: user_page.php');
                    exit();
                }
            //}
          }

          //$query = "SELECT * FROM lab5_users WHERE ";
          // Were a username and password provided? If so check them against
          // the database.
          
          
          //      If username / password were valid, set session variables
          //      and forward them to the correct page
          
          
          //      If the username / password were not valid, show error message
          //      and populate form with the original inputs
          
          
        ?>
        <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
                Great Web Application</span>!</h1>
                
        <p style="color: red">
        <?php echo $loginError; ?>
        </p>
        
        <form method="post" action="login_page.php">
            <label>Email: </label>
            <input type="text" name="email" value="<?php echo $username; ?>"> <br>
            <label>Password: </label>
            <input type="password" name="pass" value="<?php echo $password; ?>"> <br>
            <input type="submit" name = "submit" value="Log in">
        </form>
        
        <p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
        </p>
</html>
<?php
// place useful functions here
// examples: salt and hash a string
//           check to see if a username/password combination is valid
//           forward user or admin to the correct page


?>
