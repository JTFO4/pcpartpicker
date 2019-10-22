<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="flatly.css">
    </head>
    <body>
      <?php session_start(); ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">PC Parts 'R' Us</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_main" aria-controls="navbar_main" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                  
        <div class="collapse navbar-collapse" id="navbar_main">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/~group01/project/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
              <div class="dropdown-menu" aria-labelledby="dropdown07">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cart</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>


      <div class="container" style="padding-top: 1em; text-align: center">
        <img src="pcpartsrus.png" alt="PC Parts 'R' Us" width="675" height="187.5">
      </div>
      <div class="container" style="padding-top: -2em">

      <?php 
        require_once('account.php');
        if(isset($_POST['loginButton'])){
          $email = $_POST['username'];
          $pass =  $_POST['password'];
          $myObj = new Account($email, $pass);
          $myObj->loginUser();

          echo "hihiihhi outside";
          if ($_GLOBALS['didSuccess'] == 1)
          {
            header("Location: LoginSuccess.php");
            exit();
          }
        }


      ?>

      <form method="post" action="login.php">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4  form-group">
            <label for="userEmail">Email</label>
            <input type="email" class="form-control" name="username" id="userEmail" aria-describedby="emailHelp" placeholder="myemail@msu.edu" value="<?php echo $email; ?>"> 
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <?php echo "<p style=\"color: red; padding-top: 2.5em\">" . $errEmail . "</p>" ?>    
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4 form-group">
            <label for="userPassword">Password</label>
            <input type="password" class="form-control" name="password" id="userPassword" aria-describedby="emailHelp" placeholder="Enter password">
            <?php echo "<p style=\"color: red; padding-top: 2.5em\">" . $errPass . "</p>" ?>
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="row" style="padding-top: 1em">
          <div class="col-md-4"></div>
          <div class="col-md-auto">
            <button type="submit" name="loginButton" class="btn btn-primary">Login</button>
          </div>
          <div class="col-md-auto">
            <p style="color: red"><?php $errorMSG?></p>
          </div>
        </div>
    </form>
    
        <div class="row" style="padding-top: 1em">
          <div class="col-md-4"></div>
          <div class="col-md-auto">
            <a href="/~group01/project/register.php">dont have an account?</a>
          </div>
          <div class="col-md-auto"></div>
        </div>
      </div>


    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>