<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 22/03/2016
 * Time: 09:05
 */
error_reporting(1);
ini_set('display_errors', '1');
include_once 'includes/general_includes_once.php';

if(isset($_POST['claim'])){

    $salary_Process->setUserId($secure->cleanText($_POST['user_id']));
    $salary_Process->setDateOfWork($secure->cleanText($_POST['date_of_work']));
    $salary_Process->setStarTime($secure->cleanText($_POST['start_time']));
    $salary_Process->setEndTime($secure->cleanText($_POST['end_time']));
    $salary_Process->setRatePerHour($secure->cleanText($_POST['rate_per_hour']));

    $save_claim = $salary_Process->claim(
        $salary_Process->getUserId(),
        $salary_Process->getDateOfWork(),
        $salary_Process->getStarTime(),
        $salary_Process->getEndTime(),
        $salary_Process->getRatePerHour());

    if($save_claim){
//            $message .= 'Hello ' . $user->getFirstName() . '  ' . $user->getLastName() . ',<br/><br/>';
//            $message .= 'Your account has been created fo salary processing.<br/>';
//            $mail->setTo($user->getEmail(), $user->getFirstName())
//                ->setSubject('Salary processing account')
//                ->setFrom('', 'Salary Processing')
//                ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
//                ->setMessage($message)
//                ->setWrap(78);
//            $send = $mail->send();
//            if ($send) {
//                $msg = MSG_REGISTER_SUCCESSFULLY;
//                header("refresh:5; url=http://{$_SERVER['HTTP_HOST']}/register.php");
//            } else {
//                $msg = MSG_SEND_EMAIL_ERROR;
//            }
        $msg = MSG_CLAIM_SUCCESSFULLY;
    }
    else {
        $msg = MSG_CLAIM_ERROR;
    }

}

?>



<?php include_once 'includes/meta.php'; ?>
<body>

<div id="wrapper">

    <?php include_once 'includes/nav-dashboard.php'; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Salary Processing
                    - <?php echo $user->getFirstName() . ' ' . $user->getLastName() ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                <?php $function->message($msg);?>
                <form action="" method="post" role="form">
                    <legend>Demand your salary</legend>
                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="form-group">
                        <label for="">Date of work</label>
                        <input type="date" class="form-control" name="date_of_work" id="date_of_work" required="required">
                    </div>

                    <div class="form-group">
                        <label for="">Start time</label>
                        <input type="time" class="form-control" name="start_time" id="start_time" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">End time</label>
                        <input type="time" class="form-control" name="end_time" id="end_time" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Rate per hour</label>
                        <input type="number" class="form-control" name="rate_per_hour" id="rate_per_hour" required="required">
                    </div>

                    <button type="submit" name="claim" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /#wrapper -->
<?php include_once 'includes/js.php'; ?>
<?php include_once 'includes/footer.php'; ?>
