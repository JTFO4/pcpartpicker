<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Add Item to Store</title>
            <style>
                input {
                    margin-bottom: 0.5em;
                }
            </style>
        <link rel="stylesheet" href="flatly.css" />
        <link rel="stylesheet" href="flatly.css">
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
        <div class="container" style="padding-top: 1em; text-align: center">
        	<h3>Add Item to Store</h3>
        </div>

        <!-- this contains the entire form -->
        <div class="container" style="padding-top: -2em">
            <form method="post" action="additem.php">

                <?php
                    if(isset($_POST['confirmAddNewItem'])){
                        require_once('loginInfo.php');
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error)
                            die($conn->connect_error);

                            echo $conn->error;
                       if (isset($_SESSION['isLoggedIn']) && $_SESSION['isAdmin'] == 1)
                        {
                            $didSku = 0;
                            $didICat = 0;
                            $didIName = 0;
                            $didMSRP = 0;
                            $didURL = 0;
                
                            $tempSKU = $_POST['newItemSKU'];
                            if (!empty($tempSKU) && preg_match('/^[A-Z][A-Z][A-Z][-][A-Z][A-Z][A-Z][-][0-9a-zA-Z][0-9a-zA-Z][0-9a-zA-Z][0-9a-zA-Z]$/' , $tempSKU))
                            {
                                $didSku = 1;
                            }
                
                            $tempICat = $_POST['newItemCategory'];
                            if(!empty($tempICat) && preg_match('/^[A-Z][a-zA-Z]+$/' , $tempICat))
                            {
                                $didICat = 1;
                            }
                
                            $tempIName = $_POST['newItemName'];
                            if(!empty($tempIName) && preg_match('/^[0-9a-zA-Z #$()-.\/_": ]+[0-9a-zA-Z #$()-._":\/ ]*$/' , $tempIName))
                            {
                                $didIName = 1;
                            }
                
                            $tempMSRP = $_POST['newItemPrice'];
                            if(!empty($tempMSRP) && preg_match('/^[0-9]+[.][0-9]*$/' , $tempMSRP))
                            {
                                $didMSRP = 1;
                            }
                
                           $tempURL = $_POST['newItemImageURL'];
                
                           if ($didSku && $didICat && $didIName && $didMSRP)
                           {
                                $insertQuery = "INSERT INTO items (SKU, itemCategory, itemName, itemPrice, itemPicture) VALUES ('$tempSKU', '$tempICat', '$tempIName', '$tempMSRP', '$tempURL')";
                                $conn->query($insertQuery);
                           }
                            $conn->close();
                }
            }
                ?>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                        <label for="newItemSKU">New SKU:</label>
                        <input type="text" class="form-control" name="newItemSKU" id="newItemSKU">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                    <label for="newItemCategory">Category:</label>
                    <select class="form-control" id="newItemCategory" name="newItemCategory">
                        <option value="Monitor">Monitor</option>
                        <option value="RAM">RAM</option>
                        <option value="GPU">GPU</option>
                        <option value="HDD">HDD</option>
                        <option value="CPU">CPU</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Motherboard">Motherboard</option>
                        <option value="Case">Case</option>
                        <option value="PSU">PSU</option>
                        <option value="CPUC">CPUC</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4  form-group">
                        <label for="newItemName">New Item Name:</label>
                        <input type="text" class="form-control" name="newItemName" id="newItemName">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                        <label for="userPassword">New Item Price:</label>
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" aria-label="newItemPrice" id="newItemPrice" name="newItemPrice">
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4  form-group">
                        <label for="newItemImageURL">New Item Image URL:</label>
                        <input type="text" class="form-control" name="newItemImageURL" id="newItemImageURL">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                        <button type="submit" class="btn btn-secondary" name="confirmAddNewItem">Confirm</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>
    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>
