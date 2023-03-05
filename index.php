<?php 

#check module
// if (!isset($_GET['module']) || is_array($_GET['module'])) {
//     header('HTTP/1.0 404 Not Found');
//     exit;
// }

#check action
if (!isset($_GET['action'])) {
    $_GET['action'] = 'index';
}

require $_SERVER['DOCUMENT_ROOT'].'/PHP_MVC/ekb/define.php';

if (isset($_GET['module'])) {
    $filepath = APP_PATH . 'modules/' . $_GET['module'] . '/' . $_GET['action'] . '.php';

    if (!file_exists($filepath)) {
        echo 'file not exist';
        exit;
    }

    session_start();

    if (!isset($_SESSION['user']) && $_GET['module'] != 'auth') {
        echo '<script>
            alert("Redirect to login page");
            window.location.href = " ' . APP_URL . '?module=auth&action=login ";
        </script>';
        // header('Location: ' . APP_URL . '?module=auth&action=login');
    }
    
    require $filepath;

} else {
    echo 'index_file';

}

?>