<?php
/**
 * Created by PhpStorm.
 * User: MARIUS
 * Date: 10-Feb-15
 * Time: 00:16
 */

include_once __DIR__ . '/class/configurations.php';
include_once __DIR__ . '/class/class.Database.php';
include_once __DIR__ . '/class/class.User.php';
include_once __DIR__ . '/class/class.Text.php';
include_once __DIR__ . '/class/class.Functions.php';
include_once __DIR__ . '/class/class.SimpleMail.php';
include_once __DIR__ . '/class/class.SalaryProcess.php';
include_once __DIR__ . '/class/class.Session.php';

$db = new Database();
$user = new User($db);
$salary_Process = new SalaryProcess($db);
$secure = new Text();
$function = new Functions();
$mail = new SimpleMail();
$session = new Session();

//$location = 'http://' . $_SERVER['HTTP_HOST'] . '/salary.processing/';
if ($session->isRegistered()) {
    // Check to see if the session has expired.
    // If it has, end the session and redirect to login.
    if ($session->isExpired()) {
        $session->end();
        $function->redirect($location);
    } else {
        // Keep renewing the session as long as they keep taking action.
        $session->renew();
        $user->setFirstName($_SESSION['first_name']);
        $user->setLastName($_SESSION['last_name']);
        $user->setUsername($_SESSION['username']);
        $user->setPhoneNumber($_SESSION['phone_number']);
        $user->setStatus($_SESSION['status']);
        $user->setUserId($_SESSION['id']);
    }
}
//else {
//
//    $function->redirect($location);
//}
