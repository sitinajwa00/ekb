
  <body id="body-default">

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
         href="<?php echo APP_URL ?>?module=home&action=view"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Home</span>
      </a>
      <?php } else {?>
      <a
         href="<?php echo APP_URL ?>?module=home&action=view"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Home</span>
      </a>
      <?php }?>

      <!-- About Us -->
      <?php if ($_GET['module'] == 'about_us') {?> 
      <a
         href="<?php echo APP_URL ?>?module=about_us"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>About Us</span>
      </a>
      <?php } else {?>
      <a
         href="<?php echo APP_URL ?>?module=about_us"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
        <i class="fas fa-shop fa-fw me-3"></i
          ><span>About Us</span>
      </a>
      <?php }?>
    </div>
  </div>
</nav>
<!-- Sidebar -->

<!-- Navbar -->
<nav
     id="main-navbar"
     class="navbar navbar-expand-lg navbar-light bg-black fixed-top"
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
    <!-- <span><?php echo (isset($_SESSION['user']) ? $_SESSION['user']['name'] : '') ?></span> -->

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">

      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link text-warning me-3 me-lg-0" href="<?php echo APP_URL ?>?module=auth&action=register">
          <!-- <i class="fa-solid fa-cart-shopping"></i> -->
          Register
        </a>
      </li>
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link text-warning" href="<?php echo APP_URL ?>?module=auth&action=login">
          <!-- <i class="fa-solid fa-user"></i> -->
          Sign In
        </a>
      </li>
      <!-- Icon -->
      <?php
      if (isset($_SESSION['login'])) {
        $url = APP_URL . '?module=auth&action+submit&id=' . $_SESSION['user']['id'];
      } else {
        $url = APP_URL . '?module=auth&action=login';
      }
      ?>
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0" href="<?php echo $url ?>">
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