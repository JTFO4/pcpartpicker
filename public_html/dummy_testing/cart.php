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
                            </div>
                        </li>

                        <!-- implement logic to show <li> based on user login status -->

                        <li class="nav-item"><a class="nav-link" href="/~group01/project/login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/~group01/project/account_page.php">Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Log out</a></li>

                        <!-- --------------------------------------------------------- -->

                        <li class="nav-item active"><a class="nav-link" href="/~group01/project/cart.php">Cart</a></li>
                    </ul>
                    <form class="form-inline my-2 my-md-0" method="post" action="search.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchbar" id="searchbar" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div> 
    </nav>
        <div class="container">
            <div class="row" style="padding-top: 5em">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="text-align: center"><h2>Your Shopping Cart</h2></div>
                <div class="col-md-4"></div>
            </div>
        
            <div class="row" style="padding-top: 5em">
                <div class="col-md" style="text-align: center">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Item image</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Item price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                echo "<tr>";
                                echo "<th scope=\"row\"><img src=\"https://via.placeholder.com/100x100\"/></th>";
                                echo "<td>{{ product name }}</td>";
                                echo "<td><p><del>{{ product price }}</del></p><div style=\"padding-top: 1em\"></div><p class=\"text-danger\">SALE! $420.68</p></td>";
                                echo "<td><button type=\"button\" class=\"btn btn-danger\" id=\"test\" style=\"width: 10em\">Remove from Cart</button></td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<th scope=\"row\"><img src=\"https://via.placeholder.com/100x100\"/></th>";
                                echo "<td>{{ product name }}</td>";
                                echo "<td>{{ product price }}</td>";
                                echo "<td><button type=\"button\" class=\"btn btn-danger\" id=\"test\" style=\"width: 10em\">Remove from Cart</button></td>";
                                echo "</tr>";

                                echo "<tr>
                                        <th scope=\"row\"></th>
                                        <td style=\"text-align: right\">Total Price:</td>
                                        <td>{{ total price }}</td>
                                        <td></td>
                                    </tr>";
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group">
                    <label for="coupon">Coupon code:</label>
                    <input type="text" class="form-control" id="couponCode" aria-describedby="couponCode" placeholder="Enter coupon code">
                    <div style="height: 1em"></div>
                    <div class="text-right">
                        <button type="button" class="btn pull-right btn-success" id="test" style="width: 8em">Redeem</button>
                    </div>
                    <label for="total">Grand Total:</label>
                    <h4>{{ price }}</h4>
                    <div class="text-right">
                        <button type="button" class="btn pull-right btn-success" id="test" style="width: 8em">Checkout</button>
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
