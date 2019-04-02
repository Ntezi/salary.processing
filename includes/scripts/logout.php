<?php
include_once '../class/class.Session.php';
include_once '../class/class.Functions.php';
$function = new Functions();
$session = new Session();
$location = 'http://' . $_SERVER['HTTP_HOST'] . '/salary.processing/';
$session->end();
$function->redirect($location);
?>
