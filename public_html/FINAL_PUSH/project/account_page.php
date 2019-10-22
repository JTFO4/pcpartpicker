    <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Your Account</title>
            <style>
                input {
                    margin-bottom: 0.5em;
                }
            </style>
        <link rel="stylesheet" href="flatly.css" />
    </head>
    <body>
    <?php   session_start();
            require_once('account.php');
            require_once('member_admin.php');

            if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1 ){
                if(isset($_POST['updateButton'])){
                    $MemberObj = new Member($_SESSION['email']);
                    $MemberObj->updateShippingInformation($_POST['firstname'], $_POST['lastname'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['zip']);
                }
            }
            else
                header("Location: login.php");

            


        ?>
        
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
                            echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"/~group01/project/account_page.php\">Account</a></li>
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

    <div class="container" style="padding-top: 4em; padding-bottom: 1em; text-align: center; position: relative">
    <div class = "font-weight-bold"><font style="font-size: 40px">My Account</font></div>
    </div>

        <div class="container" style="padding-top: 5em">
            <div class="jumbotron">
                <h1 class="display-4">Hello, <?php echo $_SESSION['firstName']; ?>!</h1>
                <hr class="my-4" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="#shipping_info_update" class="list-group-item list-group-item-action">Add/Update Shipping Information</a>
                            <a href="#cc_info_update" class="list-group-item list-group-item-action">Add/Update Credit Card Information</a>
                            <a href="/~group01/project/wishlist.php" class="list-group-item list-group-item-action">Wishlist</a>
                            <a href="/~group01/project/order_history.php" class="list-group-item list-group-item-action">Order History</a>
                            <a href="/~group01/project/changeUserPass.php" class="list-group-item list-group-item-action">Reset My Password</a>
                        </div>
                    </div>
                    <div class="col-md-4"></div>

                    <!-- ADMIN SECTION WILL. I. AM. -->
                    <!-- implement logic to hide this based on admin login status -->
                    <?php
                    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                        echo "<div class=\"col-md-4\">";
                        echo "<h4 class=\"display-6\">Admin Control Panel</h4>";
                        echo "<div class=\"list-group\" style=\"padding-top: 1em\">";
                        echo "<a href=\"/~group01/project/resetUserPass.php\" class=\"list-group-item list-group-item-action text-info\">Reset User Password</a>";
                        //<!-- email field + submit button -->
                        echo "<a href=\"http://pluto.cse.msstate.edu/~group01/project/additem.php\" class=\"list-group-item list-group-item-action text-info\">Add Item to Store</a>";
                        //<!-- create form -->
                        echo "<a href=\"#\" class=\"list-group-item list-group-item-action text-info\">Generate Sales Report</a>";
                        //<!-- create form -->
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>

                    <!-- ---------------------------------------------------------- -->
                </div>
            </div>
        </div>

        <!-- Current Account Information -->
        <div class="container" style="padding-top: 5em">
            <div class="row">
                <div class="col-md-4">
                    <h4>Shipping Information</h4>
                    <div>
                        <p>Address Line 1: <?php echo $_SESSION['addr1']; ?></p>
                        <p>Address Line 2: <?php echo $_SESSION['addr2']; ?> </p>
                        <!--<p>Apt. #</p> -->
                        <p>City: <?php echo $_SESSION['city']; ?></p>
                        <p>State: <?php echo $_SESSION['state']; ?></p>
                        <p>Zip Code: <?php echo $_SESSION['zip']; ?></p>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h4>Credit Card Information</h4>
                    <div>
                        <p>Name on Card</p>
                        <p>CC #</p>
                        <p>Expiration Date</p>
                        <p>CVV (hidden)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Update Account Information Forms -->
        <form method="post" action="account_page.php">
        <div class="container" id="edit">
            <div class="row">
                <div class="col-md-4">
                    <h4 style="padding-top: 1em" id="shipping_info_update">Update Shipping Information</h4>
                    <div class="form-group">
                        <label class="col-form-label" for="test">First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="<?php echo $_SESSION['firstName'];?>" id="FirstName" /> 
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errFirstName'] . "</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="<?php echo $_SESSION['lastName'];?>" id="LastName" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errLastName'] . "</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Address Line 1</label>
                        <input type="text" name="address1" class="form-control" placeholder="<?php echo $_SESSION['addr1'];?>" id="Addr1" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errAddr1'] . "</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Address Line 2</label>
                        <input type="text" name = "address2" class="form-control" placeholder="<?php echo $_SESSION['addr2'];?>" id="Add2" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errAddr2'] . "</p>"; ?>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-form-label" for="test">Apartment/Suite No.</label>
                        <input type="text" class="form-control" placeholder="Apartment/Suite No." id="test" /> 
                    </div> -->
                    <div class="form-group">
                        <label class="col-form-label" for="test">City</label>
                        <input type="text" name ="city" class="form-control" placeholder="<?php echo $_SESSION['city'];?>" id="City" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errCity'] . "</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">State</label>
                        <input type="text" name="state" class="form-control" placeholder="<?php echo $_SESSION['state'];?>" id="State" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errState'] . "</p>"; ?>
                    </div>
                    <div class="form-group" style="padding-bottom: 1em">
                        <label class="col-form-label" for="test">Zip Code</label>
                        <input type="text" name ="zip" class="form-control" placeholder="<?php echo $_SESSION['zip'];?>" id="Zip" />
                        <?php echo "<p style=\"color: red\">" . $GLOBALS['errLastZip'] . "</p>"; ?>
                    </div>
                    <button type="submit" name="updateButton" class="btn btn-secondary">Update</button>        
                </div>
            </form>



                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h4 style="padding-top: 1em" id="cc_info_update">Update Credit Card Information</h4>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Credit Card Number</label>
                        <input type="text" class="form-control" placeholder="CC #" id="test" />
                    </div>
                    <div class="form-group">
                        <label for="test">Expiration Date</label>
                        <div></div>
                        <select class="form-control" id="test" style="width: 5em; float: left">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <h4 style="float: left">&nbsp;&nbsp;/&nbsp;&nbsp;</h4>
                        <select class="form-control" id="test" style="width: 5em">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding-bottom: 1em">
                        <label class="col-form-label" for="test">CVV</label> <input type="text" class="form-control" placeholder="CVV" id="test" style="width: 5em" />
                    </div>
                    <button class="btn btn-secondary">Update</button>
                </div>
            </div>
        </div>
        <div class="container" style="padding-top: 10em"></div>
    </body>
    <script src="../lib/jquery-3.3.1.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"
    ></script>
    <script src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
</html>
