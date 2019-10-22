<?php //setupusers.php (with changes)
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);

  $query = "CREATE TABLE lab5_users (
    forename VARCHAR(32) NOT NULL,
    surname  VARCHAR(32) NOT NULL,
    type     VARCHAR(10) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL
  )";
  $result = $connection->query($query); 
  if (!$result) die($connection->error);

  $salt1    = "qm&h*";
  $salt2    = "pg!@";

  $forename = 'Bill';
  $surname  = 'Smith';
  $type     = 'user';
  $username = 'bsmith';
  $password = 'mysecret';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);

  $forename = 'Pauline';
  $surname  = 'Jones';
  $type     = 'user';
  $username = 'pjones';
  $password = 'acrobat';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);
  
  $forename = 'Super';
  $surname  = 'User';
  $type     = 'admin';
  $username = 'admin';
  $password = 'admin';
  $token    = hash('ripemd128', "$salt1$password$salt2");

  add_user($connection, $forename, $surname, $type, $username, $token);

  echo 'Table lab5_users created and populated';
  $connection->close();
  
  function add_user($connection, $fn, $sn, $ty, $un, $pw)
  {
    $query  = "INSERT INTO lab5_users (forename, surname, type, username, password) "
            . "VALUES('$fn', '$sn', '$ty', '$un', '$pw')";
    $result = $connection->query($query);
    if (!$result) die($connection->error);
  }
?>
