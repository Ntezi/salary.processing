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

    $get_report = $salary_Process->getReportInfo($_GET['id']);
    $row = $get_report->fetch_array(MYSQL_ASSOC);

    if(isset($_POST['edit'])){

        $salary_Process->setId($secure->cleanText($_GET['id']));
        $salary_Process->setDateOfWork($secure->cleanText($_POST['date_of_work']));
        $salary_Process->setStarTime($secure->cleanText($_POST['start_time']));
        $salary_Process->setEndTime($secure->cleanText($_POST['end_time']));
        $salary_Process->setRatePerHour($secure->cleanText($_POST['rate_per_hour']));

        $edit_salary_processing = $salary_Process->editSalaryProcessing(
            $salary_Process->getDateOfWork(),
            $salary_Process->getStarTime(),
            $salary_Process->getEndTime(),
            $salary_Process->getRatePerHour(),
            $salary_Process->getId());

        if($edit_salary_processing){

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
            $location = 'report.php';
            $function->redirect($location);
        }
        else {
            $msg = MSG_CLAIM_ERROR;
        }

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
                    <div class="form-group">
                        <label for="">Date of work</label>
                        <input type="date" class="form-control" name="date_of_work" id="date_of_work" required="required" value="<?php echo $row['date_of_work'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Start time</label>
                        <input type="time" class="form-control" name="start_time" id="start_time" required="required" value="<?php echo $row['start_time'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">End time</label>
                        <input type="time" class="form-control" name="end_time" id="end_time" required="required"  value="<?php echo $row['end_time'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">End time</label>
                        <input type="number" class="form-control" name="rate_per_hour" id="rate_per_hour" required="required"  value="<?php echo $row['rate_per_hour'] ?>">
                    </div>

                    <button type="submit" name="edit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /#wrapper -->
<?php include_once 'includes/js.php'; ?>
<?php include_once 'includes/footer.php'; ?>
