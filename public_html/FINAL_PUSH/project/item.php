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
                    <li class="nav-item active">
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
    
    <!-- This contains user functionality -->
    <div class="container" style="padding-top: 5em">
      <div class="row">
        <!-- div contains item image -->
        <div class="col-md-4">
          <img src="https://via.placeholder.com/300x200" />
        </div>
        <!-- div contains item name & information -->
        <div class="col-md-4">
          <h4>Item Name Placeholder</h4>
          <ul>
            <li>item spec 1 placeholder</li>
            <li>item spec 2 placeholder</li>
            <li>item spec 3 placeholder</li>
            <li>item spec 4 placeholder</li>
          </ul>

          <!-- implement logic to hide based on stock status -->
          <?php
            $inStock = true;
            // logic to decide whether item is in stock
            if($inStock){
              echo "<h4 class=\"text-success\">In Stock.</h4>";
            } else { //out of stock
              echo "<h4 class=\"text-danger\">Out of Stock.</h4>";
            }
          ?>

          <!-- ----------------------------------------------- -->
        </div>

        <!-- div contains item functions -->
        <div class="form-group col-md-4" style="text-align: left">
        <?php
              $onSale = false;
              if($onSale)
                // echo "<h5><del>" . $row['itemPrice'] . "</del></h5><h5 class=\"text-danger\">SALE! " . $row['salePrice'] . "</h5>";
                echo "<h5>Item Price: <del>$" . 420.69 . "</del></h5><h5 class=\"text-danger\">SALE! $" . 420.68 . "</h5>";
              else
                // echo "<h5>" . $row['itemPrice'] . "<h5>";
                echo "<h5>Item Price: $" . 420.69 . "<h5>";
          ?>

          <!-- new quantity selection and buttons -->
          <div class="form-group row">
            <div class="col">
              <div class="form-group">
                <label for="quantitySelect">Quantity:</label>
                <input type="number" class="form-control" id="quantitySelect" min="0" style="width: 12.5em">
              </div>
              <div class="form-group">
                <button
                  type="button"
                  class="btn btn-success"
                  id="addToCartSubmit"
                  style="width: 16em"
                >
                  Add to Cart
                </button>
              </div>
              <div class="form-group">
                <button
                  type="button"
                  class="btn btn-info"
                  id="addToWishlistSubmit"
                  style="width: 16em"
                >
                  Add to Wishlist
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- this contains admin functionality -->
    <!-- implement logic to hide this based on admin login status -->
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
              <div class="form-group" style="padding-top: 1em">
                  <button type="button" class="btn btn-danger" style="width: 20em">Remove item from Store</button>
              </div>
              <div class="form-group">
                <label for="newItemQuantity" style="padding-top: 1em">Adjust item Quantity</label>
                <div class="row form-inline">
                  <select class="form-control" id="newItemQuantitySign" style="width: 4em">
                    <option>-</option>
                    <option>+</option>
                  </select>
                <input type="text" class="form-control form-control-inline" id="newItemQuantity" style="width: 14em"></div>
              </div>
              <div class="form-group">
                <label class="control-label" style="padding-top: 1em">Adjust item Price</label>
                <div class="form-group">
                  <div class="input-group" style="width: 100%">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" aria-label="itemPrice" id="newItemPrice">
                  </div>
                </div>
              </div>
              <div class="form-group" style="padding-top: 1em">
                    <button type="button" class="btn btn-success">Confirm</button>
              </div>
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