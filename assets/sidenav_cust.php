
  <body>

<!--Main Navigation-->
<header>
<!-- Sidebar -->
<nav
     id="sidebarMenu"
     class="collapse d-lg-block sidebar collapse bg-white"
     >
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <!-- Home -->
      <?php if ($_GET['module'] == 'home') {?>
      <a
         href="<?php echo APP_URL ?>?module=home"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Home</span>
      </a>
      <?php } else {?>
        <a
         href="<?php echo APP_URL ?>?module=home"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Home</span>
      </a>
      <?php }?>
      
      <!-- Shopping -->
      <?php if ($_GET['module'] == 'order') {?>
      <a
         href="<?php echo APP_URL ?>?module=order&action=product"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
         <i class="fa-solid fa-basket-shopping fa-fw me-3"></i><span>Shopping</span>
      </a>
      <?php } else {?>
        <a
         href="<?php echo APP_URL ?>?module=order&action=product"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
         <i class="fa-solid fa-basket-shopping fa-fw me-3"></i><span>Shopping</span>
      </a>
      <?php }?>
      
      <?php if ($_GET['module'] == 'cart') {?>
      <a
         href="<?php echo APP_URL ?>?module=cart"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
         <i class="fa-solid fa-cart-shopping fa-fw me-3"></i><span>My Cart</span>
      </a>
      <?php } else {?>
        <a
         href="<?php echo APP_URL ?>?module=cart"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-cart-shopping fa-fw me-3"></i><span>My Cart</span>
      </a>
      <?php }?>
      
      <a
         href="#"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-clock-rotate-left fa-fw me-3"></i><span>Order History</span>
      </a>
      <a
         href="#"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-phone fa-fw me-3"></i><span>Contact Us</span>
      </a>
    </div>
  </div>
</nav>
<!-- Sidebar -->

<!-- Navbar -->
<nav
     id="main-navbar"
     class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
     >
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img
           src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"
           height="25"
           alt=""
           loading="lazy"
           />
    </a>

    <!-- Checking Session -->
    <span><?php echo (isset($_SESSION['user']) ? $_SESSION['user']['name'] : '') ?></span>

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">

      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0" href="#">
          <i class="fa-solid fa-cart-shopping"></i>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="<?php echo APP_URL ?>?module=profile">
          <i class="fa-solid fa-user"></i>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0 demo" href="<?php echo APP_URL . '?module=auth&action=submit&id=' . $_SESSION['user']['id'] ?>">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>
<!--Main Navigation-->