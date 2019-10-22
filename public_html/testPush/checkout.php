<!DOCTYPE html>
<html>
    <head>
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"
        ></script>
        <script type="javascript" src="../lib/bootstrap-4.1.3-dist/js/bootstrap.js"></script>
        <link rel="stylesheet" href="flatly.css" media="screen" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.html">PC Parts 'R' Us</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarColor03"
                aria-controls="navbarColor03"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/~group01/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
                            >Categories</a
                        >
                        <div
                            class="dropdown-menu"
                            x-placement="bottom-start"
                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 41px, 0px);"
                        >
                            <a class="dropdown-item" href="#">Category 1</a> <a class="dropdown-item" href="#">Category 2</a>
                            <a class="dropdown-item" href="#">Category 3</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated category</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/~group01/login.html">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" />
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div style="padding-top: 3em"><h1 style="text-align: center">PC Parts 'R' Us</h1></div>
            <div class="container" id="edit">  
                <div class="row">
                    <div class="col-md-8">
                        <h4 style="padding-top: 1em" id="shipping_info_update">Enter Shipping Info</h4>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Address Line 1</label>
                            <input type="text" class="form-control" placeholder="Address Line 1" id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Address Line 2</label>
                            <input type="text" class="form-control" placeholder="Address Line 2" id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Apartment/Suite No.</label>
                            <input type="text" class="form-control" placeholder="Apartment/Suite No." id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">City</label>
                            <input type="text" class="form-control" placeholder="City" id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">State</label>
                            <input type="text" class="form-control" placeholder="State" id="test" />
                        </div>
                        <div class="form-group" style="padding-bottom: 1em">
                            <label class="col-form-label" for="test">Zip Code</label>
                            <input type="text" class="form-control" placeholder="Zip Code" id="test" />
                        </div>        
                    </div>
                    <div class="col-md-4">
                        <h4 style="padding-top: 1em" id="cc_info_update">Update Credit Card Information</h4>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Name on Card</label>
                            <input type="text" class="form-control" placeholder="Name on Card" id="test" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="test">Credit Card Number</label>
                            <input type="text" class="form-control" placeholder="CC #" id="test" />
                        </div>
                        <div class="form-group" style="padding-top: 0.5em">
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
                    </div>
                </div>
                <!-- Show Conditionally based on login status -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-check" style="padding-bottom:2em">
                            <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" checked="">
                                Use My Account Information
                            </label>
                        </div>
                        <button class="btn btn-success" name="checkout" id="test">Checkout</button>
                    </div>
                </div>
                <!-- Show Conditionally based on login status -->
            </div>

    </body>
</html>
