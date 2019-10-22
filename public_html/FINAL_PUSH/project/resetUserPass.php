<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
            <title>Reset User Password</title>
            <style>
                input {
                    margin-bottom: 0.5em;
                }
            </style>
        <link rel="stylesheet" href="flatly.css" />
    </head>
    <body>
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
                        </div>
                    </li>
                    <form class="form-inline my-2 my-md-0" method="post" action="search.php">
                        <input class="form-control form-control-small mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchbar" id="searchbar" style="width:25em; height: 2em"/>
                        <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Search</button>
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


    <?php
        require_once('member_admin.php');
        $me = new Member($_SESSION['email']);

        // below is recycled logic from changeUserPass, not sure if it'll be useful but
        // just in case
    
        // $_POST['resetUserEmail']
        // $_POST['confirmButton']

        // if(isset($_POST['confirmButton'])){
        //     $oldPass = $_POST['oldPass'];
        //     $newPass = $_POST['newPass'];
        //     $confirmPass = $_POST['confirmPass'];
        //     $me->updatePassword($oldPass, $newPass, $confirmPass);
            

        //     if($GLOBALS['didPassReset'] == 1){
        //         echo "<script type='text/javascript'>alert('Password Reset Successful!')</script>";
        //         //header("Location: account_page.php");
        //     }
        // }

    ?>
      <div class="container" style="padding-top: 1em; text-align: center">
	  		<h3>Reset User Password</h3>
      </div>
      <div class="container" style="padding-top: -2em">

        <form method="post" action="resetUserPass.php">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4  form-group">
              <label for="userEmail">User Email:</label>
              <input type="email" class="form-control" name="resetUserEmail" id="resetUserEmail" aria-describedby="" placeholder=""> 
            </div>
            <div class="col-md-4"></div>
          </div>

          <div class="row" style="padding-top: 1em">
            <div class="col-md-4"></div>
            <div class="col-md-auto">
              <button type="submit" name="confirmButton" id ="confirm" class="btn btn-primary">Confirm</button>
            </div>
            <div class="col-md-auto">
            </div>
          </div>
        </form>
    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>
