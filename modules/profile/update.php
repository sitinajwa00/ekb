<?php

if (!isset($_SESSION['login'])) {
    header('Location: ' . APP_URL . '?module=auth&action=login');
}

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';

require ASSET_PATH . 'header.php';
if ($_SESSION['user']['type'] == 0) {
    require ASSET_PATH . 'sidenav_owner.php';
} else if ($_SESSION['user']['type'] == 1) {
    require ASSET_PATH . 'sidenav_admin.php';
} else if ($_SESSION['user']['type'] == 2) {
    require ASSET_PATH . 'sidenav_cust.php';
}

$state = array(
    'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
    'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
);

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo APP_URL ?>?module=profile">Profile</a></li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <?php
        $profile = new EditProfilePage();
        echo $profile->displayEditPage($_SESSION['user']['id']);
        ?>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>