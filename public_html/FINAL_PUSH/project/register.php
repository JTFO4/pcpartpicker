<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="flatly.css">
    </head>
    <body>
    <?php session_start(); ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/~group01/project/">PC Parts 'R' Us</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbar_main"
                aria-controls="navbar_main"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar_main">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/~group01/project/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="categorySelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse by Category</a>
                        <div class="dropdown-menu" aria-labelledby="categorySelect">
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=0">Cases</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=1">Power Supplies</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=2">Motherboards</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=3">CPUs</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=4">RAM</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=5">CPU Coolers</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=6">GPUs</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=7">Accessories</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=8">Storage</a>
                            <a class="dropdown-item" href="/~group01/project/category.php?categorySelect=9">Monitors</a>
                        </div>
                    </li>
                    <form class="form-inline my-2 my-md-0" method="post" action="search.php">
                        <input class="form-control form-control-small mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchbar" id="searchbar" style="width:25em; height: 2.25em"/>
                        <button class="btn btn-secondary btn-sm my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <!-- implement logic to show <li> based on user login status -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php 
                        session_start();
                        if(isset( $_SESSION['isLoggedIn'] ) && ($_SESSION['isLoggedIn'] == 1)){
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/account_page.php\">Account</a></li>
                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/cart.php\">Cart</a></li>
                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/LogoutSuccess.php\">Log out</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/login.php\">Login</a></li>
                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/cart.php\">Cart</a></li>";
                        }
                    ?>
                </ul>
                    <!-- --------------------------------------------------------- -->

                <!-- <form class="form-inline my-2 my-md-0" method="post" action="search.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchbar" id="searchbar" />
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </div> 
    </nav>
    <div class="container" style="padding-top: 3em; padding-bottom: 3em; text-align: center; position: relative">
    <div class = "font-weight-bold"><font style="font-size: 80px">PC Parts 'R' Us</font></div>
    </div>
    <div class="container" style="padding-top: -2em">

    <form method="post" action="register.php">

        <?php
        require_once('account.php');

        if(isset($_POST['loginButton']))
        {
          if ((!empty($_POST['firstname'])) && (!empty($_POST['lastname'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])) && (!empty($_POST['password2'])))
          {
            require_once('account.php');  
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['username'];
            $pass =  $_POST['password'];
            $pass2 = $_POST['password2'];

            $myObj = new Account($email, $pass, $fname, $lname, $pass2);
            $myObj->registerUser();

            $_SESSION['userEmail'] = $email;
            $_SESSION['userPass'] = $pass;

            if ($didSuccess)
            {
        ?>
            <script type="text/javascript">window.location = 'http://pluto.cse.msstate.edu/~group01/project/RegisterSuccess.php'</script>
        <?php
            }
            
          }
          else
          {
            $GLOBALS['errString'] = "All form fields must be completed.";
          }
        }
        ?>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 form-group">
          <label for="userPassword">First Name</label>
          <input type="text" class="form-control" name="firstname" id="userFirstName" aria-describedby="emailHelp" placeholder="First name" value="<?php echo $fname; ?>">
        </div>
        <div class="col-md-4">
        <?php echo "<p style=\"color: red\">" . $errFirstName . "</p>" ?> 
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 form-group">
          <label for="userPassword">Last Name</label>
          <input type="text" class="form-control" name="lastname" id="userLastName" aria-describedby="emailHelp" placeholder="Last name" value="<?php echo $lname; ?>">
        </div>
        <div class="col-md-4">
        <?php echo "<p style=\"color: red\">" . $errLastName . "</p>" ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4  form-group">
          <label for="userEmail">Email</label>
          <input type="email" class="form-control" name="username" id="userEmail" aria-describedby="emailHelp" placeholder="xxxxxx@xxx.xxx" value="<?php echo $email; ?>">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>    
        </div>
        <div class="col-md-4">
        <?php echo "<p style=\"color: red\">" . $errEmail . "</p>" ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 form-group">
          <label for="userPassword">Password</label>
          <input type="password" class="form-control" name="password" id="userPassword" aria-describedby="emailHelp" placeholder="Enter password">
        </div>
        <div class="col-md-4">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 form-group">
          <label for="userPassword">Confirm Password</label>
          <input type="password" class="form-control" name = "password2" id="userPassword2" aria-describedby="emailHelp" placeholder="Enter password">
        </div>
        <div class="col-md-4">
        <?php echo "<p style=\"color: red; padding-top: 2.5em\">" . $errPass . "</p>" ?>
        </div>
      </div>

      <div class="row" style="padding-top: 1em">
        <div class="col-md-4"></div>
        <div class="col-md-auto">
        <button type="submit" name="loginButton" class="btn btn-secondary">Create Account</button>
        </div>
        <div class="col-md-auto">
        <?php echo "<p style=\"color: red\">" . $errString . "</p>"; ?>
        </div>
      </div>
  </form>

        <div class="row" style="padding-top: 1em">
          <div class="col-md-4"></div>
          <div class="col-md-auto">
            <a href="/~group01/project/login.php">Already have an account?</a>
          </div>
          <div class="col-md-auto"></div>
        </div>
      </div>
    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>
