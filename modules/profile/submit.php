<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';

if (isset($_POST['submit'])) {
    $id = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $pwd = ($_POST['pwd'] == "" ? $_SESSION['user']['pwd'] : $_POST['pwd']);
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $address = $_POST['address'];
    $poscode = $_POST['poscode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $type = $_SESSION['user']['type'];

    $user = new UserController();
    $user->editUser($id, $name, $pwd, $email, $phonenum, $address, $poscode, $city, $state, $type);

    echo '<script>
        alert("Successfully Update Profile");
        window.location.href = "'.APP_URL.'?module=profile";
    </script>';
}

?>