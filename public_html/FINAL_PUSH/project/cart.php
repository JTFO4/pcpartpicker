<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Your Shopping Cart</title>
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
                            <li class=\"nav-item active\"><a class=\"nav-link\" href=\"/~group01/project/cart.php\">Cart</a></li>
                            <li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/LogoutSuccess.php\">Log out</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/~group01/project/login.php\">Login</a></li>
                            <li class=\"nav-item active\"><a class=\"nav-link\" href=\"/~group01/project/cart.php\">Cart</a></li>";
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
    <div class="container" style="padding-top: 4em; padding-bottom: 1em; text-align: center; position: relative">
        <div class = "font-weight-bold"><font style="font-size: 40px">My Shopping Cart</font></div>
    

            <!-- <form method="post" action="cart.php"><input class="btn btn-success" type="submit" name="addsku" value="add to cart test"></form> -->

            <div class="row" style="padding-top: 5em">
                <div class="col-md" style="text-align: center">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Item image</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Item price</th>
                                <th scope="col">Item quantity</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Test data
                                session_start();
                                require_once('cart_class.php');
                                $_SESSION['cartTotal'] = 0.00;
                                
                                if(isset($_POST['removeFromCart'])){
                                    $myObj = new Cart();
                                    $myObj->removeFromCart($_POST['removesku']);
                                }
                                if(isset($_POST['addsku'])){
                                    $myObj = new Cart();
                                    $myObj->addToCart($_POST['addsku'], 1);
                                }
                                // loop through results to build table
                                if(isset($_SESSION['arraySKU'])){
                                    // Loop through it like any other array.
                                    foreach($_SESSION['arraySKU'] as $sku){
                                        // Create query for each sku in cart
                                        require_once 'loginInfo.php';
                                        $conn = new mysqli($hn, $un, $pw, $db);
                                        if ($conn->connect_error)
                                            die($conn->connect_error);
                                        $query = "SELECT * FROM items WHERE SKU='" . $sku . "'";
                                        $result = $conn->query($query);
                                        $row = $result->fetch_array();
                                            echo "<tr>";
                                            echo "<th scope=\"row\"><img src=\"" . $row['itemPicture'] ."\" style=\"width: 200px; height: auto\"></img></th>";
                                            echo "<td style=\"max-width:300px\">" . $row['itemName'] . "</td>";
                                        if($row['salePrice'] == NULL)
                                        {
                                            echo "<td>$" . $row['itemPrice'] . "</td>";
                                            $_SESSION['cartTotal'] += ($row['itemPrice'] * $_SESSION['arrayQuant'][$sku]);
                                        } else {
                                            echo "<td><p><del>$" . $row['itemPrice'] . "</del></p><div style=\"padding-top: 1em\"></div><p class=\"text-danger\">SALE! $" . $row['salePrice'] . "</p></td>";
                                            $_SESSION['cartTotal'] += ($row['salePrice'] * $_SESSION['arrayQuant'][$sku]);
                                        }
                                            echo "<td>" . $_SESSION['arrayQuant'][$sku] . "</td>";
                                            echo "<td>";
                                            echo        "<form method=\"post\" action=\"cart.php\">";
                                            echo            "<input class=\"btn btn-danger\" type=\"submit\" name=\"removeFromCart\" value=\"Remove from Cart\" style=\"width: auto\">";
                                            echo            "<input type=\"hidden\" name=\"removesku\" value=\"" . $sku . "\"/>";
                                            echo        "</form>";
                                            echo "</td>";
                                            echo "</tr>";
                            
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="total" class="form-group-inline">Grand Total:</label>
                            <h4>$<?php echo number_format((float)$_SESSION['cartTotal'], 2, '.', ''); ?></h4>
                        </div>
                        <div class="col-md-6 form-group">
                        <div class="row" style="padding-top:1em"></div>
                        <button type="button" class="btn btn-secondary" id="test" style="width: 8em">Checkout</button>
                        </div>
                    </div>
                    <!-- <label for="coupon">Coupon Code:</label>
                    <input type="text" class="form-control" id="couponCode" aria-describedby="couponCode" placeholder="Enter coupon code">
                    <div style="height: 1em"></div>
                    <div class="text-right">
                        <button type="button" class="btn pull-right btn-success" id="test" style="width: 8em">Redeem</button>
                    </div> -->
                    
                    <div class="form-group-inline">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"
    ></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>
