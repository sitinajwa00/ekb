
  <body id="body-admin">

<!--Main Navigation-->
<header>
<!-- Sidebar -->
<nav
     id="sidebarMenu"
     class="collapse d-lg-block sidebar collapse bg-white"
     >
  <div class="position-sticky d-flex flex-column justify-content-between h-100">
    <div class="list-group list-group-flush mx-3 mt-4">
      <!-- Dashboard -->
      <?php if ($_GET['module'] == 'home') {?> 
      <a
         href="<?php echo APP_URL ?>?module=home&action=dashboard"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Main dashboard</span>
      </a>
      <?php } else {?>
        <a
         href="<?php echo APP_URL ?>?module=home&action=dashboard"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Main dashboard</span>
      </a>
      <?php }?>
      
      <!-- Product -->
      <?php if ($_GET['module'] == 'product') {?>
      <a
         href="<?php echo APP_URL ?>?module=product"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
         <i class="fa-solid fa-box-open fa-fw me-3"></i><span>Products</span>
      </a>
      <?php } else {?>
        <a
         href="<?php echo APP_URL ?>?module=product"
         class="list-group-item list-group-item-action py-4 ripple "
         aria-current="true"
         >
         <i class="fa-solid fa-box-open fa-fw me-3"></i><span>Products</span>
      </a>
      <?php }?>
      
      <!-- Stock -->
      <?php if ($_GET['module'] == 'stock')  {?>
      <a
         href="<?php echo APP_URL ?>?module=stock"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
         <i class="fa-solid fa-boxes-stacked fa-fw me-3"></i><span>Stock</span>
      </a>
      <?php } else {?>
      <a
         href="<?php echo APP_URL ?>?module=stock"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-boxes-stacked fa-fw me-3"></i><span>Stock</span>
      </a>
      <?php }?>  
      
      <!-- Sales Report -->
      <?php if ($_GET['module'] == 'report')  {?>
      <a
         href="<?php echo APP_URL ?>?module=report"
         class="list-group-item list-group-item-action py-4 ripple active"
         aria-current="true"
         >
         <i class="fa-solid fa-list fa-fw me-3"></i><span>Sales Report</span>
      </a>
      <?php } else {?>
      <a
         href="<?php echo APP_URL ?>?module=report"
         class="list-group-item list-group-item-action py-4 ripple"
         aria-current="true"
         >
         <i class="fa-solid fa-list fa-fw me-3"></i><span>Sales Report</span>
      </a>
      <?php }?> 
      </div>

      <!-- About Us -->
      <div class="list-group list-group-flush mx-3 mb-3">
        <?php if ($_GET['module'] == 'about_us') { ?>
        <a
          href="<?php echo APP_URL ?>?module=about_us"
          class="list-group-item list-group-item-action py-4 ripple active"
          aria-current="true"
          >
          <i class="fa-solid fa-shop fa-fw me-3"></i><span>About Us</span>
        </a>
        <?php } else {?> 
        <a
          href="<?php echo APP_URL ?>?module=about_us"
          class="list-group-item list-group-item-action py-4 ripple"
          aria-current="true"
          >
          <i class="fa-solid fa-shop fa-fw me-3"></i><span>About Us</span>
        </a>
        <?php } ?>
      </div>
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

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">
      <!-- Icon -->
      <?php if ($_GET['module']=='profile') {?>
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="<?php echo APP_URL ?>?module=profile">
          <i class="fa-solid fa-user text-warning"></i>
        </a>
      </li>
      <?php } else {?>
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="<?php echo APP_URL ?>?module=profile">
          <i class="fa-solid fa-user text-white"></i>
        </a>
      </li>
      <?php }?>
      
      <!-- Icon -->
      <li class="nav-item">
        <a class="nav-link me-3 me-lg-0" href="<?php echo APP_URL . '?module=auth&action=submit&id=' . $_SESSION['user']['id'] ?>">
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