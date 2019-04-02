<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/04/2016
 * Time: 20:58
 */
error_reporting(1);
ini_set('display_errors', '1');
include_once 'includes/general_includes_once.php';

if(isset($_GET['id'])){

    $user_details = $user->getUserDetails($_GET['id']);
    $row = $user_details->fetch_array(MYSQL_ASSOC);

    if(isset($_POST['update'])){

        $user->setUserId($secure->cleanText($_GET['id']));
        $user->setFirstName($secure->cleanText($_POST['first_name']));
        $user->setLastName($secure->cleanText($_POST['last_name']));
        $user->setMiddleName($secure->cleanText($_POST['middle_name']));
        $user->setPhoneNumber($secure->cleanText($_POST['phone_number']));

        $edit_user = $user->updateUser(
            $user->getFirstName(),
            $user->getMiddleName(),
            $user->getLastName(),
            $user->getPhoneNumber(),
            $user->getUserId());

        if($edit_user){

            $msg = MSG_UPDATE_SUCCESSFULLY;
            $location = 'edit-user.php?id=' . $user->getUserId();
            $function->redirect($location);
        }
        else {
            $msg = MSG_UPDATE_ERROR;
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
                <h1 class="page-header">Edit <?php echo $user->getFirstName() . ' ' . $user->getLastName() ?></h1>
            </div>
        </div>
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
                                    <input class="form-control" placeholder="First Name" name="first_name" type="text" value="<?php echo $row['first_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Middle Name" name="middle_name" type="text" value="<?php echo $row['middle_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="last_name" type="text" value="<?php echo $row['last_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone_number" type="tel" value="<?php echo $row['phone_number'] ?>">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block" placeholder="Password" name="update" type="submit" value="Update">
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
