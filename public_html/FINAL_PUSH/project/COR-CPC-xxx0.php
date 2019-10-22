<!DOCTYPE html>
<html>
  <head>
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
    
    <!-- This contains user functionality -->
    <div class="container" style="padding-top: 5em">
      <div class="row">
        <!-- div contains item image -->
        <div class="col-md-4">
          <img src="http://pluto.cse.msstate.edu/~group01/project/ItemPics/COR-CPC-xxx0.jpg" style="width:350px; height:auto"/> <!-- PLUTO LINK TO PIC HERE --><!-- PLUTO LINK TO PIC HERE --><!-- PLUTO LINK TO PIC HERE --><!-- PLUTO LINK TO PIC HERE --><!-- PLUTO LINK TO PIC HERE -->
        </div>
        <!-- div contains item name & information -->
        <div class="col-md-4">
          <h4>Corsair Hydro Series, H150i PRO RGB, 360mm. 3 X 120mm ML PWM Fans, Advanced RGB Lighting & Fan Control w/ Software. Liquid CPU Cooler. CW-9060031-WW. Support: Intel 2066, AMD AM4, TR4.</h4>
          <ul>
            <li>360mm Radiator</li>
            <li>Includes 3x ML120 PWM Fans</li>
            <li>Dynamic RGB Lighting with Corsair iCUE</li>
            <li>Zero RPM Mode</li>
          </ul>

          <!-- implement logic to hide based on stock status -->
          <?php
          $sku = "COR-CPC-xxx0"; //ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  ITEM SKU HERE ---  

          require_once('loginInfo.php');
          require_once('cart_class.php');
          require_once('member_admin.php');


          $conn = new mysqli($hn, $un, $pw, $db);
          if ($conn->connect_error)
              die($conn->connect_error);

          $query = "SELECT * FROM items WHERE SKU = '$sku'";
          $result = $conn->query($query);
          $row = $result->fetch_array();

          $stock = $row['stockQuantity'];
            // logic to decide whether item is in stock
            if($row['stockQuantity'] > 20){
              echo "<h4 class=\"text-success\">In Stock.</h4>";
            } 
            else if ($row['stockQuantity'] <= 20 && $row['stockQuantity'] > 0)
            {
              echo "<h4 class=\"text-success\">In Stock.</h4>"; echo "<h4 class=\"text-danger\">Only $stock remaining!</h4>";
            }
            else { //out of stock
              echo "<h4 class=\"text-danger\">Out of Stock.</h4>";
            }
          
            $onSale = true;
            if($row['salePrice'] != NULL && $row['salePrice'] != -0.01) 
              echo "<h5><del>Original Price: $" . $row['itemPrice'] . "</del></h5><h5 class=\"text-danger\">SALE PRICE!: $" . $row['salePrice'] . "</h5>";
            else
              echo "<h5>Item Price: $" . $row['itemPrice'] . "<h5>";

              $conn->close();
              if(isset($_POST['addToCartSubmit']) && isset($_POST['quantitySelect'])){
                $quantAmnt = $_POST['quantitySelect'];
                if (!empty($quantAmnt) && preg_match('/^[0-9]+$/' , $quantAmnt))
                {
                // quantity stored in $_POST['quantitySelect']
                $myObj = new Cart();
                $myObj->addToCart($sku,$quantAmnt); // UPDATE CORRECT ITEM SKU PER PAGE CREATION
              }
              }
    
              if(isset($_POST['addItemToWishlist'])){
    
              }

              if(isset($_POST['removeItemFromStore'])){
                if (isset($_SESSION['isLoggedIn']) && $_SESSION['isAdmin'] == 1)
                {
                //error_reporting(E_ALL);
                //ini_set('display_errors', 1);
                require_once('loginInfo.php');
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error)
                    die($conn->connect_error);

                $updatePrice = "UPDATE items SET salePrice = '-0.01' WHERE SKU = '$sku'";
                $conn->query($updatePrice);

                $updateQuantity = "UPDATE items SET stockQuantity = '0' WHERE SKU = '$sku'";
                $conn->query($updateQuantity);

                $conn->close();
                echo "<script>";
                echo "window.location = 'http://pluto.cse.msstate.edu/~group01/project/COR-CPC-xxx0.php';";
                echo "</script>";
                }
              }

              if(isset($_POST['confirmQuantityChanges']))
              {
                require_once('loginInfo.php');
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error)
                    die($conn->connect_error);

                $quantAmnt = $_POST['adjustItemQuantity'];
                if (!empty($quantAmnt) && preg_match('/^[0-9]+$/' , $quantAmnt)) 
                {
                
                if ($_POST['adjustItemQuantitySign'] == '+')
                {
                    $adminQuery = "SELECT * FROM items WHERE SKU = '$sku'";
                    $result = $conn->query($adminQuery);
                    $row = $result->fetch_array();

                    $currAmt = $row['stockQuantity'] + $quantAmnt;
                    $updateQuantity = "UPDATE items SET stockQuantity = '$currAmt' WHERE SKU = '$sku'";
                    $conn->query($updateQuantity);
                }

                else if ($_POST['adjustItemQuantitySign'] == '-')
                {
                    $adminQuery = "SELECT * FROM items WHERE SKU = '$sku'";
                    $result = $conn->query($adminQuery);
                    $row = $result->fetch_array();

                    $currAmt = $row['stockQuantity'] - $quantAmnt;
                    $updateQuantity = "UPDATE items SET stockQuantity = '$currAmt' WHERE SKU = '$sku'";
                    $conn->query($updateQuantity);
                }  
              }

                $conn->close();
                
                echo "<script>";
                echo "window.location = 'http://pluto.cse.msstate.edu/~group01/project/COR-CPC-xxx0.php';";
                echo "</script>";
              }

              if(isset($_POST['confirmChanges'])){
               // error_reporting(E_ALL);
               //ni_set('display_errors', 1);

                require_once('loginInfo.php');
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error)
                    die($conn->connect_error);

                $newPrice = $_POST['adjustItemPrice'];
                if (!empty($newPrice) && preg_match('/^[0-9]+[.][0-9]*$/' , $newPrice))
                {
                $updatePrice = "UPDATE items SET salePrice = '$newPrice' WHERE SKU = '$sku'";
                $conn->query($updatePrice); 

                }
                $conn->close();
                echo "<script>";
                echo "window.location = 'http://pluto.cse.msstate.edu/~group01/project/COR-CPC-xxx0.php';";
                echo "</script>";
              }


            ?>
    
              <!-- ----------------------------------------------- -->
            </div>
    
            <!-- div contains item functions -->
        
        <!-- NEW QUANTITY SELECT/BUTTON STACK -->
        <div class="form-group col-md-4">
          <form method="post" action="COR-CPC-xxx0.php">
            <div class="form-group row">
              <div class="col">
                <div class="form-group">
                  <label for="quantitySelect">Quantity:</label>
                  <input type="number" class="form-control" id="quantitySelect" name="quantitySelect" style="width: 12.5em" min="0">
                </div>
                <div class="form-group">
                  <button
                    type="submit"
                    class="btn btn-success"
                    id="addToCartSubmit"
                    name="addToCartSubmit"
                    style="width: 16em"
                  >
                    Add to Cart
                  </button>
                </div>
                <div class="form-group">
                  <button
                    type="submit"
                    class="btn btn-info"
                    id="addToWishlistSubmit"
                    name="addToWishlistSubmit"
                    style="width: 16em"
                  >
                    Add to Wishlist
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- NEW QUANTITY SELECT/BUTTON STACK -->

      </div>
    </div>

    <!-- this contains admin functionality -->
    <!-- implement logic to hide this based on admin login status -->

<?php 
  if (isset($_SESSION['isLoggedIn']) && $_SESSION['isAdmin'] == 1)
  {
echo<<<EOA
    <div class="container" style="padding-top: 5em">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="jumbotron col-md-6">
          <h1 class="display-6" style="text-align: center">
            Admin Control Panel
          </h1>
          <hr class="my-4" />
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <!--
                <div class="list-group" style="padding-top: 1em; text-align: center">
                    <a href="#" class="list-group-item list-group-item-action text-info">Remove item from Store</a>
                    <a href="#" class="list-group-item list-group-item-action text-info">Adjust item Quantity</a>
                    <a href="#" class="list-group-item list-group-item-action text-info">Adjust item Price</a>
                </div>
              -->
              <!-- remove item from store -->
              <form method="post" action="COR-CPC-xxx0.php">
                <div class="form-group">
                  <button type="submit" class="btn btn-danger" name="removeItemFromStore" id="removeItemFromStore" style="width: 100%">Remove Item From Store</button> 
                </div>
              </form>

              <!-- adjust item quantity -->
              <form method="post" action="COR-CPC-xxx0.php">
                <div class="form-group">
                  <label for="adjustItemQuantity">Adjust Item Quantity:</label>
                  <div class="form-row">
                    <div class="col-md-4">
                      <!-- +/- selector -->
                      <select class="form-control" name="adjustItemQuantitySign" id="adjustItemQuantitySign">
                        <option value="+">+</option>
                        <option value="-">-</option>
                      </select> 
                    </div>
                    <div class="col-md-8">
                      <!-- digit input -->
                      <input type="text" class="form-control" id="adjustItemQuantity" name="adjustItemQuantity">
                    </div>
                  </div>
                  <div class="form-group" style="padding-top:1em"s>
                    <button type="submit" class="btn btn-success" name="confirmQuantityChanges" id="confirmQuantityChanges" style="width: 100%">Confirm Quantity Change</button>
                  </div>
                </div>
              </form>

              <!-- adjust item price -->
              <form method="post" action="COR-CPC-xxx0.php">
                <div class="form-group">
                  <label for="adjustItemPrice">Adjust Item Price:</label>
                  <input type="text" class="form-control" name="adjustItemPrice" id="adjustItemPrice">
                </div>
                
                <!-- confirm changes -->
                <div class="form-group">
                  <button type="submit" class="btn btn-success" name="confirmChanges" id="confirmChanges" style="width: 100%">Confirm Price Change</button>
                </div>
              </form>

              
                <!-- <div class="form-group" style="padding-top: 1em">
                  <button type="submit" class="btn btn-danger" style="width: 14em" name="removeItemFromStore">Remove item from Store</button>
                </div>
                <div class="form-group">
                  <label for="exampleSelect1" style="padding-top: 1em">Adjust item Quantity</label>
                  <div class="row" style="float:left; padding-left:1em">
                    <select class="form-control" id="newItemQuantitySign" name="newItemQuantitySign" style="width: 4em">
                      <option>-</option>
                      <option>+</option>
                    </select>
                  <input type="text" class="form-control" id="newItemQuantity" name="newItemQuantity" style="width: 10em"></div>
                </div>
                <div class="form-group">
                  <label class="control-label" style="padding-top: 1em">Adjust item Price</label>
                  <div class="form-group">
                    <div class="input-group" style="width: 14em">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" class="form-control" aria-label="itemPrice" id="newItemPrice" name="newItemPrice">
                    </div>
                  </div>
                </div>
                <div class="form-group" style="padding-top: 1em">
                      <button type="submit" class="btn btn-success" id="confirmItemChanges" name="confirmItemChanges">Confirm</button>
                </div> -->
              </form>
              <br />
              <!--
                <button type="button" class="btn btn-secondary" title="" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-original-title="Popover Title">Right</button>
              -->
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
EOA;
  }
  ?>
    <!-- ---------------------------------------------------------- -->
  </body>
  <script src="../lib/jquery-3.3.1.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"
  ></script>
  <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>