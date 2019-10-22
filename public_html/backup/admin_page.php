<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administrator Page</title>
    </head>
    <body>
        <h1>Administrator Page</h1>
        <?php
            session_start();
            if (isset($_SESSION['type']) && $_SESSION['type'] =='admin')
            {
                $name = $_SESSION['forename'];
                echo "Hello $name";
                echo "<br>"; 
                echo "<br>"; 
                echo "<a href='logout_page.php'>Log Out Page</a>";
            }

            else
            {
                echo "You are not authorized to view this page.";
                echo "<br>";  
                echo "<a href='login_page.php'>Log In Page</a>";
            }
              
        ?>
    </body>
</html>