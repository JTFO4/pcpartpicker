    <!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="flatly.css" />
    </head>
    <body>
    <?php   session_start();
            require_once('account.php');
            require_once('member_admin.php');

            if (isset($_SESSION['currentUser'])){
                if(isset($_POST['updateButton'])){
                    $_SESSION['currentUser']->updateShippingInformation($_POST['firstname'], $_POST['lastname'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['zip']);
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
                            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item active"><a class="nav-link" href="/~group01/project/account_page.php">Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="/~group01/project/cart.php">Cart</a></li>
                    </ul>
                    <form class="form-inline my-2 my-md-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div style="padding-top: 5em"><h1 style="text-align: center">Account Page Placeholder</h1></div>

        <div class="container" style="padding-top: 5em">
            <div class="jumbotron">
                <h1 class="display-4">Hello, <?php echo $_SESSION['currentUser']; ?>!</h1>
                <hr class="my-4" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="#shipping_info_update" class="list-group-item list-group-item-action">Add/Update Shipping Information</a>
                            <a href="#cc_info_update" class="list-group-item list-group-item-action">Add/Update Credit Card Information</a>
                            <a href="/~group01/project/wishlist.php" class="list-group-item list-group-item-action">Wishlist</a>
                            <a href="/~group01/project/order_history.php" class="list-group-item list-group-item-action">Order History</a>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <!-- implement logic to hide this based on admin login status -->

                    <div class="col-md-4">
                        <h4 class="display-6">Admin Control Panel</h4>
                        <div class="list-group" style="padding-top: 1em">
                            <a href="#" class="list-group-item list-group-item-action text-info">Reset User Password</a>
                            <a href="#" class="list-group-item list-group-item-action text-info">Add Item to Store</a>
                            <a href="#" class="list-group-item list-group-item-action text-info">Generate Sales Report</a>
                        </div>
                    </div>

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
                        <h6 style="padding-bottom: 1em">Current Shipping Info</h6>
                        <p>Address Line 1: <?php echo $Member->addr1; ?></p>
                        <p>Address Line 2: <?php echo $Member->addr2; ?> </p>
                        <!--<p>Apt. #</p> -->
                        <p>City: <?php echo $Member->city; ?></p>
                        <p>State: <?php echo $Member->state; ?></p>
                        <p>Zip Code: <?php echo $Member->zip; ?></p>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h4>Credit Card Information</h4>
                    <div>
                        <h6 style="padding-bottom: 1em">Current Credit Card Info</h6>
                        <p>Name on Card</p>
                        <p>CC #</p>
                        <p>Expiration</p>
                        <p>CVV (hidden)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Update Account Information Forms -->
        <form method="post" action="account_page.php"
        <div class="container" id="edit">
            <div class="row">
                <div class="col-md-4">
                    <h4 style="padding-top: 1em" id="shipping_info_update">Update Shipping Info</h4>
                    <div class="form-group">
                        <label class="col-form-label" for="test">First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="Name" id="FirstName" />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Name" id="LastName" />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Address Line 1</label>
                        <input type="text" name="address1" class="form-control" placeholder="Address Line 1" id="Addr1" />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">Address Line 2</label>
                        <input type="text" name = "address2" class="form-control" placeholder="Address Line 2" id="Add2" />
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-form-label" for="test">Apartment/Suite No.</label>
                        <input type="text" class="form-control" placeholder="Apartment/Suite No." id="test" /> 
                    </div> -->
                    <div class="form-group">
                        <label class="col-form-label" for="test">City</label>
                        <input type="text" name ="city" class="form-control" placeholder="City" id="City" />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="test">State</label>
                        <input type="text" name="state" class="form-control" placeholder="State" id="State" />
                    </div>
                    <div class="form-group" style="padding-bottom: 1em">
                        <label class="col-form-label" for="test">Zip Code</label>
                        <input type="text" name ="zip" class="form-control" placeholder="Zip Code" id="Zip" />
                    </div>
                    <button type="submit" name="updateButton" class="btn btn-success">Update</button>        
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
                    <button class="btn btn-success">Update</button>
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
