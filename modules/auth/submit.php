<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require ASSET_PATH . 'header.php';

if (isset($_POST['login'])) {
    // echo 'login';
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // echo 'hello';

    $user = new LoginPage();
    $response = $user->enterEmailPass($email, $pwd);
    echo $response;
    
} else if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $phonenum = $_POST['phonenum'];
    $address = $_POST['address'];
    $poscode = $_POST['poscode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $type = '2';

    $user = new RegistrationPage();
    $response = $user->enterDetails($name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type);
    echo $response;

    // $user = new UserController();
    // $user->createUser($name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type);

    // echo '<script>
    //     alert("Successfully Register");
    //     window.location.href = "'.APP_URL.'?module=auth&action=login";
    // </script>';
} else if (isset($_GET['id'])) {
    if (isset($_SESSION['login'])) {
        unset($_SESSION['user']);
        unset($_SESSION['login']);
        unset($_SESSION['payment']);
    }
    session_destroy();

    echo '<script>
        alert("Successfully Logout");
        window.location.href = " ' .APP_URL. '?module=auth&action=login";
    </script>';
} else {
    echo 'Default';
}

?>