<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 19/03/2016
 * Time: 22:15
 */

include_once 'includes/general_includes_once.php';

if(isset($_POST["login"])) {

    $email = $secure->cleanText($_POST["email"]);
    $password = $secure->cleanText($_POST["password"]);
    $location = 'dashboard.php';

    if(!empty($email) && !empty($password)) {
        $user->login($email, $password, $location);
    }
    else {
        $msg = MSG_FILL_ALL_DETAILS;
    }
}

?>

<?php include_once 'includes/meta.php'; ?>
<body style="background-image: url('files/bg.jpeg'); ">

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <div class="page-header">
              <h1>Salary <small>processing</small></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                       value="">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-lg btn-default btn-block" placeholder="Password" name="login" type="submit"
                                       value="Login">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'includes/js.php'; ?>
<?php include_once 'includes/footer.php'; ?>
