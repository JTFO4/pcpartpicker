<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<?php

if(isset($_POST['JAX']))
{
    echo "did we make it inside submit?";
    require_once('account.php');
    $myObj = new Account($_POST['email'], $_POST['pass']);
    $myObj->loginUser();
}
?>
   
 <form method="post" action="blarg.php">
  Email:<br>
  <input type="text" name="email"> <p style="color: red"><?php echo $GLOBALS['errEmail']; ?> </p>
  <br>
  A$$word:<br>
  <input type="text" name="pass"> <p style="color: red"><?php echo $GLOBALS['errPass']; ?> </p>
  <br><br>
  <input type="submit" name = "JAX" value="OGGOGO">
</form> 

</body>
</html>