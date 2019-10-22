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
                <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="#">Category Option</a>
                  <a class="dropdown-item" href="#">Category Option</a>
                  <a class="dropdown-item" href="#">Category Option</a>
                </div>
              </li>

              <!-- implement logic to show <li> based on user login status -->

              <li class="nav-item"><a class="nav-link" href="/~group01/project/login.php">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="/~group01/project/account_page.php">Account</a></li>

              <!-- --------------------------------------------------------- -->

              <li class="nav-item"><a class="nav-link" href="/~group01/project/cart.php">Cart</a></li>
            </ul>
            <form class="form-inline my-2 my-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" />
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <div class="container" style="padding-top: 1em; text-align: center">
        <img src="pcpartsrus.png" alt="PC Parts 'R' Us" width="675" height="187.5">
      </div>

        <div class="row" style="padding-top: 2em">
          <div class="col-md" style="text-align: center">
              <span><img src="https://via.placeholder.com/300x200"/></span>
              <span><img src="https://via.placeholder.com/300x200"/></span>
              <span><img src="https://via.placeholder.com/300x200"/></span>              
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
