<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>PC Parts 'R' Us</title>
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

    <div class="container">
    <div class="grid-container" style="text-align: center; padding-left: 90px">
        <?php 
            require_once 'loginInfo.php';
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error)
                die($conn->connect_error);

                
                $query = "SELECT * FROM items";
                $result = $conn->query($query);
                
                $imageID = 0; // Image number associated with each image for ID

                while($row = $result->fetch_array()){
                    $itemPage = "http://pluto.cse.msstate.edu/~group01/project/". $row['SKU'].".php";
                    echo "<div class = \"polaroid\" style=\"background-color: white\">";
                    echo "<a href='".$itemPage."'>";
                    echo "<img src='".$row['itemPicture']."'width = \"100\" height= \"auto\" id='".$imageID."'title='".$row['itemName']."'> ";
                    echo "<div class=\"polaroidText\"><font size=\"1\" style=\"color: #212d3f\">'".$row['itemName']."'</font></div>";
                    if($row['salePrice'] == NULL || $row['salePrice'] == -0.01){
                        echo "<div class=\"polaroidText\"><font size=\"5\" style=\"color: #212d3f\"; font-weight: bold >$".$row['itemPrice']."</font></div>";
                    }
                    else
                    echo "<div class=\"polaroidText\"><font size=\"5\" style=\"color: #212d3f\"; font-weight: bold >$".$row['salePrice']."</font></div>";

                    echo "</a>";
                    echo "</div>";
                    $imageID += 1;
                }
        ?>
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
