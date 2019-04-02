<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 22/03/2016
 * Time: 08:24
 */
error_reporting(1);
ini_set('display_errors', '1');
include_once 'includes/general_includes_once.php';
session_start();

if(isset($_POST['register'])){

    $user->setUsername($secure->cleanText($_POST['email']));
    $user->setFirstName($secure->cleanText($_POST['first_name']));
    $user->setLastName($secure->cleanText($_POST['last_name']));
    $user->setPhoneNumber($secure->cleanText($_POST['phone_number']));

    $random_password = $function->createRandomPassword();
    $user->setPassword($secure->cleanText($random_password));

    $check_new_username = $user->checkUserName($user->getUsername());

    if($check_new_username) {
        $msg = MSG_CHECK_USERNAME;

    }
    else{

        $register = $user->createUser($user->getUsername(), $user->getPassword(), $user->getFirstName(), '', $user->getLastName(), $user->getPhoneNumber());
        if($register){
            $message .= 'Hello ' . $user->getFirstName() . '  ' . $user->getLastName() . ',<br/><br/>';
            $message .= 'Your account has been created fo salary processing.<br/>';

            $send = $function->sendEmail($message, $user->getUsername(), 'Salary processing account');

//            if ($send) {
//                $msg = MSG_REGISTER_SUCCESSFULLY;
////                header("refresh:5; url=http://{$_SERVER['HTTP_HOST']}/register.php");
//                $pswd = '<div class="alert alert-info">
//        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//        	<strong>New Password: </strong>' . $random_password . '</div>';
//            } else {
//                $msg = MSG_SEND_EMAIL_ERROR;
//            }

            $msg = MSG_REGISTER_SUCCESSFULLY;
            $pswd = '<div class="alert alert-info">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<strong>New Password: </strong>' . $random_password . '</div>';


//            $location = 'register.php';
//            $function->redirect($location);
        }
        else {
            $msg = MSG_REGISTER_ERROR;
        }
    }
}
?>

<?php include_once 'includes/meta.php'; ?>
<body>

<div id="wrapper">

    <?php include_once 'includes/nav-dashboard.php'; ?>
    <div id="page-wrapper">
        <?php $function->message($msg);?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Register New User</h1>
            </div>
        </div>
        <?php echo $pswd;?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="first_name" type="text" autofocus>
                                </div>
                                <!--<div class="form-group">
                                    <input class="form-control" placeholder="Middle Name" name="middle_name" type="text" autofocus>
                                </div>-->
                                <div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="last_name" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone_number" type="tel"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block" placeholder="Password" name="register" type="submit"
                                           value="Register">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->
<?php include_once 'includes/js.php'; ?>


