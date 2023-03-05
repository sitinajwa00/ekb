<?php 
// path
if (!defined('ROOT_PATH')) { define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'); }
if (!defined('APP_PATH')) { define('APP_PATH', ROOT_PATH . 'PHP_MVC/ekb/'); }
if (!defined('ASSET_PATH')) { define('ASSET_PATH', APP_PATH . 'assets/'); }
if (!defined('MOD_PATH')) { define('MOD_PATH', APP_PATH . 'model/'); }
if (!defined('CTRL_PATH')) { define('CTRL_PATH', APP_PATH . 'controller/'); }
if (!defined('INCL_PATH')) { define('INCL_PATH', APP_PATH . 'includes/'); }
if (!defined('IMG_PATH')) { define('IMG_PATH', ASSET_PATH . 'images/ekb_img/'); }

// urls
if (!defined('ROOT_URL')) { define('ROOT_URL', 'http://localhost/'); }
if (!defined('APP_URL')) { define('APP_URL', ROOT_URL . 'PHP_MVC/ekb/'); }
if (!defined('ASSET_URL')) { define('ASSET_URL', APP_URL . 'assets/'); }
// if (!defined('MOD_URL')) { define('MOD_URL', APP_URL . 'model/'); }
// if (!defined('CTRL_URL')) { define('CTRL_URL', APP_URL . 'controller/'); }
// if (!defined('INCL_URL')) { define('INCL_URL', APP_URL . 'includes/'); }
if (!defined('IMG_URL')) { define('IMG_URL', ASSET_URL . 'images/ekb_img/'); }
?>