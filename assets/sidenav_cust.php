
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
      <a
         href="<?php echo APP_URL ?>?module=shopping"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
         <i class="fa-solid fa-basket-shopping fa-fw me-3"></i><span>Shopping</span>
      </a>
      
      <!-- Cart -->
      <a
         href="<?php echo APP_URL ?>?module=cart"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-cart-shopping fa-fw me-3"></i><span>My Cart</span>
      </a>
      
      <a
         href="<?php echo APP_URL ?>?module=order&action=order_history"
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
     class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"
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
        src="<?php echo IMG_URL ?>ekb-logo-wt.png"
        height="30"
        alt=""
        loading="lazy"
      />
      <span class="ms-3 text-warning" style="font-family:'Lato', sans-serif;"><b>EMPAYAR</b> KEREPEK BAWANG</span>
    </a>

    <!-- Checking Session -->
    <span><?php echo (isset($_SESSION['user']) ? $_SESSION['user']['name'] : '') ?></span>

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">

      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0 position-relative" href="<?php echo APP_URL ?>?module=order&action=cart">
          <i class="fa-solid fa-cart-shopping text-white <?php echo ($_GET['module']=='order' && $_GET['action']=='cart' ? 'text-warning' : '') ?>"></i>
          <span class="position-absolute top-2 start-0 translate-middle badge rounded-pill bg-success my-cart-badge opacity-75">
            0
            <span class="visually-hidden">My Carts</span>
          </span>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="<?php echo APP_URL ?>?module=profile">
          <i class="fa-solid fa-user text-white"></i>
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0 demo" href="<?php echo APP_URL . '?module=auth&action=submit&id=' . $_SESSION['user']['id'] ?>">
          <i class="fa-solid fa-right-from-bracket text-white"></i>
        </a>
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>
<!--Main Navigation-->