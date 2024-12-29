
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=path;?>front/css/all.min.css">
  <link rel="stylesheet" href="<?=path;?>front/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=path;?>front/css/bootstrap.min.css.map.css">
  <link rel="stylesheet" href="<?=path;?>front/css/header.css">
      <link rel="stylesheet" href="<?=path;?>front/css/root.css">

</head>
  <body>
<nav class="navbar navbar-expand-lg ">
  <!-- Container wrapper -->
  <div class="container">
  <a class="navbar-brand" href="#">
          logo
        </a>
      <form class="d-flex search-form" method="GET" action=<?=path?>shop/search/>
          <div class="input-group">
        <span class="input-group-text bg-white border-0 d-sm-block d-lg-flex d-md-none">
            <i class="fas fa-search"></i>
        </span>
              <input class="form-control d-sm-block d-lg-flex search-btn border-0" type="search" name="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light d-sm-block d-lg-block" type="submit">Search</button>
          </div>
      </form>
      <!-- Toggle button -->
    <button class="navbar-toggler px-0" type="button" data-mdb-toggle="collapse"
      data-mdb-target="#navbarExample3" aria-controls="navbarExample3" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Collapsible wrapper -->

    <div class="collapse navbar-collapse navbar-parent" id="navbarExample3">

      <!-- Left links -->
      <ul class="navbar-nav ms-lg-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="<?= path?>home/index">home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= path?>home/contact_us">contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= path?>home/about_us"> about us</a>
        </li>

<?php if(!isset($userdata)){
         echo "
    <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
            account
        </a>
        <ul class='dropdown-menu'>
            <li><a class='dropdown-item' href='" . path . "account/login'>Login</a></li>
            <li><a class='dropdown-item' href='" . path . "account/register'>Register</a></li>
            <li><hr class='dropdown-divider'></li>
            <li><a class='dropdown-item' href='#'>Something else here</a></li>
        </ul>
    </li>";
};
            ?>
            <!-- Navbar dropdown -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">
            Mega menu
          </a>

          <!-- Dropdown menu -->
          <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="
                          border-top-left-radius: 0;
                          border-top-right-radius: 0;
                        ">
            <div class="container">
              <div class="row my-4">
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="list-group list-group-flush">
                    <p class="mb-0 list-group-item text-uppercase font-weight-bold">
                      Lorem ipsum
                    </p>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Dolor sit</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Amet consectetur</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Adipisicing elit</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="list-group list-group-flush">
                    <p class="mb-0 list-group-item text-uppercase font-weight-bold">
                      Explicabo voluptas
                    </p>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Perspiciatis quo</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Laudantium maiores</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Provident dolor</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
                  <div class="list-group list-group-flush">
                    <p class="mb-0 list-group-item text-uppercase font-weight-bold">
                      Iste quaerato
                    </p>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Est iure</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Praesentium</a>
                    <a href="" class="list-group-item list-group-item-action"><i
                        class="fas fa-caret-right pe-2"></i>Laboriosam</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="list-group list-group-flush">
                    <p class="mb-0 list-group-item text-uppercase font-weight-bold">
                      Cras justo odio
                    </p>
                    <a href="" class="list-group-item list-group-item-action">Saepe</a>
                    <a href="" class="list-group-item list-group-item-action">Vel alias</a>
                    <a href="" class="list-group-item list-group-item-action">Sunt doloribus</a>
                    <a href="" class="list-group-item list-group-item-action"> dolores</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
        <div class="cart d-flex justify-content-end ">
            <li class="nav-item list-unstyled text-light ">
                <a class="nav-link" href=<?=path?>product/cart_items>  <i class="fa-solid fa-cart-shopping cart "></i> Cart</a>
        </div>

        </li>

        <?php if(isset($userdata)) {
            echo "<a class='ms-2 nav-link text-light' href='" . path . "account/logout'>Logout</a>";
        } ?>
        <!-- Left links -->
    </div>

    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
  </body>
</html>

<Script src="<?= path?>front/js/all.min.js"> </script>
<Script src="<?= path?>front/js/bootstrap.bundle.js"> </script>
<Script src="<?= path?>front/js/bootstrap.bundle.min.js"> </script>

