<?php
//include_once __DIR__ . '../class/class.Session.php';
include_once '../class/class.Session.php';

$session = new Session();

$location = 'http://' . $_SERVER['HTTP_HOST'] . '/salary.processing/';
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
} else {

    $function->redirect($location);
}
?>