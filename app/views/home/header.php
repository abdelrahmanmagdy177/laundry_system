<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= path; ?>front/css/all.min.css">
    <link rel="stylesheet" href="<?= path; ?>front/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= path; ?>front/css/bootstrap.min.css.map.css">
    <link rel="stylesheet" href="<?= path; ?>front/css/header.css">
    <link rel="stylesheet" href="<?= path; ?>front/css/root.css">
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>

        <form class="d-flex search-form" method="GET" action="<?= path ?>shop/search/">
            <div class="input-group">
                <span class="input-group-text bg-white border-0">
                    <i class="fas fa-search"></i>
                </span>
                <input class="form-control border-0" type="search" name="search" placeholder="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </div>
        </form>

        <button class="navbar-toggler px-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample3">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarExample3">
            <ul class="navbar-nav ms-lg-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= path ?>home/index">الصفحه الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= path ?>create_Invoice/render">انشاء فاتورة</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= path ?>view_invoice/render">مراجعه الفواتير</a></li>

                <!-- Show "Admin Panel" if user is an admin -->
                <?php if (!empty($data['admin'])): ?>
                    <li class="nav-item"><a class="nav-link text-danger" href="<?= path ?>admin/dashboard">Admin Panel</a></li>
                <?php endif; ?>

                <!-- If user is NOT logged in, show "Login/Register" -->
                <?php if (empty($userdata)): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= path ?>account/login">Login</a></li>
                            <li><a class="dropdown-item" href="<?= path ?>account/register">Register</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- If user is logged in, show "Logout" -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= path ?>account/logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Cart Link -->
            <div class="cart d-flex justify-content-end">
                <a class="nav-link text-light" href="<?= path ?>product/cart_items">
                    <i class="fa-solid fa-cart-shopping"></i> Cart
                </a>
            </div>
        </div>
    </div>
</nav>

<script src="<?= path ?>front/js/all.min.js"></script>
<script src="<?= path ?>front/js/bootstrap.bundle.js"></script>
<script src="<?= path ?>front/js/bootstrap.bundle.min.js"></script>

</body>
</html>
