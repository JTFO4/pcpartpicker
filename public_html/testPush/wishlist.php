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
                            <a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>

                        <!-- implement logic to show <li> based on user login status -->

                        <li class="nav-item"><a class="nav-link" href="/~group01/project/login.html">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/~group01/project/account.html">Account</a></li>

                        <!-- --------------------------------------------------------- -->

                        <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
                    </ul>
                    <form class="form-inline my-2 my-md-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div> 
        </nav>
        <div class="container">
            <div class="row" style="padding-top: 5em">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="text-align: center"><h1>PC Parts 'R' Us</h1></div>
                <div class="col-md-4"></div>
            </div>
<?php
            require_once('inventory.php');
            $myObj = new Inventory(0);
            $result = $myObj->getDBResult();

echo '<table>';
echo '<tr>';
echo '<th colspan = 6>Inventory</th>';
echo '</tr>';
echo '<tr>';
echo '<td>SKU</td>';
echo '<td>Item Category</td>';
echo '<td>Item Name</td>';
echo '<td>Sale Price</td>';
echo '<td>Price</td>';
echo '<td>Quantity</td>';
echo '</tr>';
    if ($result->num_rows == 0)
    {
        echo "BETTER LUCK NEXT TIME BIATCH";
    }
    while ($row = $result->fetch_array())
    {

        echo '<tr>';
        echo '<td>'; echo $row['SKU']; echo'</td>';
        echo '<td>'; echo $row['itemCategory'];  echo'</td>';
        echo '<td>'; echo $row['itemName'];  echo'</td>';
        echo '<td>'; echo $row['salePrice']; echo'</td>';
        echo '<td>'; echo $row['itemPrice'];  echo'</td>';
        echo '<td>'; echo $row['stockQuantity'];  echo'</td>';
        echo '</tr>';
    }
    echo '</table>';

?>



            <div class="row" style="padding-top: 5em">
                <div class="col-md" style="text-align: center">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">Item image</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Item price</th>
                                <th scope="col">Buttons</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><img src="https://via.placeholder.com/100x100"></img></th>
                                <td>CORSAIR Hydro Series, H100i RGB PLATINUM, 240mm, 2 X ML PRO 120mm RGB PWM Fans</td>
                                <td><p><del>$420.69</del></p><div style="padding-top: 1em"></div><p class="text-danger">SALE! $420.68</p></td>
                                <td><button type="button" class="btn btn-success" id="test" style="width: 10em">Add to Cart</button></td>
                            </tr>
                            <tr>
                                <th scope="row"><img src="https://via.placeholder.com/100x100"></img></th>
                                <td>CORSAIR Hydro Series, H100i RGB PLATINUM, 240mm, 2 X ML PRO 120mm RGB PWM Fans</td>
                                <td>$420.69</td>
                                <td><button type="button" class="btn btn-success" id="test" style="width: 10em">Add to Cart</button></td>
                            </tr>
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
