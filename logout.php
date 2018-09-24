<?php
require_once 'login_register/core/init.php';

$user = new User();
$user->logout();

Redirect::to('index.php');

?>