<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
            <title>Browse by Category</title>
            <style>
                input {
                    margin-bottom: 0.5em;
                }
            </style>
        <link rel="stylesheet" href="flatly.css" />
        <?php
            require_once('inventory.php');
            $myvar = intval($_GET['categorySelect']);
            $myObj = new Inventory($myvar);
            $result = $myObj->getDBResult();
        ?>
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
                    <li class="nav-item active dropdown">
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
        <div class="container">
            <?php
                session_start();
                require_once('cart_class.php');

                if(isset($_POST['addToCart'])){
                    $myObj = new Cart();
                    $myObj->addToCart($_POST['addsku'], 1);
                    header("Location: http://pluto.cse.msstate.edu/~group01/project/cart.php");
                }
            ?>
    <div class="container" style="padding-top: 4em; padding-bottom: 1em; text-align: center; position: relative">
        <div class = "font-weight-bold"><font style="font-size: 40px">Items</font></div>
    </div>
        <div class="container">
            <div class="row" style="padding-top: 5em">
                <div class="col-md" style="text-align: center">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Item image</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Item price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row = $result->fetch_array())
                            {
                                $myUrl = "http://pluto.cse.msstate.edu/~group01/project/" . $row['SKU'] . ".php";
                                echo "<tr>";
                                // echo    "<th scope=\"row\"><img src=\"https://via.placeholder.com/100x100\"></img></th>";
                                echo    "<th scope=\"row\"><img src=\"" . $row['itemPicture'] ."\" style=\"width: 200px; height: auto\"></img></th>";
                                echo    "<td style=\"max-width: 500px\"><a class=\"text-primary\"href=\"" . $myUrl . "\">" . $row['itemName'] .  "</a></td>";
                                if($row['salePrice'] == NULL)
                                {
                                    echo    "<td>$" . $row['itemPrice'] .  "</td>";
                                } else {
                                    echo    "<td><p><del>$" . $row['itemPrice'] . "</del></p><div style=\"padding-top: 1em\"></div><p class=\"text-danger\">SALE! $" . $row['salePrice'] . "</p></td>";
                                }
                                echo "<td>";
                                // Button Setup for adding to cart
                                echo        "<form method=\"post\" action=\"cart.php\">";
                                echo            "<input class=\"btn btn-secondary\" type=\"submit\" name=\"addToCart\" value=\"Add to Cart\" style=\"width: 10em\">";
                                echo            "<input type=\"hidden\" name=\"addsku\" value=\"" . $row['SKU'] . "\"/>";
                                echo        "</form>";
                                //
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
