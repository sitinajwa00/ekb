<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require ASSET_PATH . 'header.php';

if (isset($_POST['login'])) {
    // echo 'login';
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $user = new UserController();
    $response = $user->userAuth($email, $pwd);

    if (count($response) != 0) {
        $_SESSION["login"] = "YES";
        $_SESSION['user']['id'] = $response[0]['userID'];
        $_SESSION['user']['name'] = $response[0]['userName'];
        $_SESSION['user']['pwd'] = $response[0]['userPassword'];
        $_SESSION['user']['email'] = $response[0]['userEmail'];
        $_SESSION['user']['type'] = $response[0]['userType'];

        if ($_SESSION['user']['type'] == 0) {
            echo '<script>
                alert("Welcome, '.$_SESSION['user']['name'].'");
                window.location.href = "'.APP_URL.'?module=home&action=dashboard";
            </script>';
        } else if ($_SESSION['user']['type'] == 1) {
            echo '<script>
                alert("Welcome, Admin");
                window.location.href = "'.APP_URL.'?module=home&action=dashboard";
            </script>';
        } else if ($_SESSION['user']['type'] == 2) {
            echo '<script>
                alert("Welcome, '.$_SESSION['user']['name'].'");
                window.location.href = "'.APP_URL.'?module=home&action=index";
            </script>';
        }

        ?>

        <script>
            alert("Successfully Login");
            window.location.href = '<?php echo APP_URL ?>?module=demo&action=file_demo';
        </script>

        <?php
    } else {
        echo 'Incorrect email or password. Please try again.';
        echo '<br>';
        echo '<a href="'.APP_URL.'?module=auth&action=login"><i class="fa-solid fa-arrow-left"></i> Back</a>';
    }
    
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

    $user = new UserController();
    $user->createUser($name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type);

    echo '<script>
        alert("Successfully Register");
        window.location.href = "'.APP_URL.'?module=auth&action=login";
    </script>';
} else if (isset($_GET['id'])) {
    if (isset($_SESSION['login'])) {
        unset($_SESSION['user']);
        unset($_SESSION['login']);
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