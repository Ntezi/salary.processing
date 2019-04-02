<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 11/04/2016
 * Time: 18:51
 */

error_reporting(1);
ini_set('display_errors', '1');
include_once 'includes/general_includes_once.php';


$user_status = $user->getStatus();
$get_report = $salary_Process->getReport(APPROVED);
//echo $user_status;

if (isset($_GET['reject'])) {

    $reject = $salary_Process->status(REJECTED, $_GET['reject']);

    if ($reject) {
        $msg = MSG_REJECTED_SUCCESSFULLY;
    } else {
        $msg = MSG_REJECTED_ERROR;
    }
}

?>
<?php include_once 'includes/meta.php'; ?>
<body>

<div id="wrapper">
    <?php include_once 'includes/nav-dashboard.php'; ?>
    <div id="page-wrapper">
        <div class="page-header">
            <h1>List of approved</h1>
        </div>
        <div class="row">
            <?php $function->message($msg); ?>
            <div class="col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Names</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Rate per hour</th>
                            <th>Total Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row_report = $get_report->fetch_array(MYSQL_ASSOC)) {
                            $salary_Process->setId($row_report['id']);
                            $salary_Process->setDateOfWork($row_report['date_of_work']);
                            $salary_Process->setStarTime($row_report['date_of_work']);
                            $salary_Process->setEndTime($row_report['date_of_work']);
                            $salary_Process->setRatePerHour($row_report['rate_per_hour']);
                            $salary_Process->setTotalRate($row_report['total_rate']);
                            $salary_Process->setStatus($row_report['salary_status']);
                            $user->setFirstName($row_report['first_name']);
                            $user->setLastName($row_report['last_name']);
                            ?>
                            <tr>
                                <td><?php echo $user->displayNames() ?></td>
                                <td><?php echo $salary_Process->getDateOfWork() ?></td>
                                <td><?php echo $salary_Process->getStarTime() ?></td>
                                <td><?php echo $salary_Process->getEndTime() ?></td>
                                <td><?php echo $salary_Process->getRatePerHour() ?></td>
                                <td><?php echo $salary_Process->getTotalRate() ?></td>
                                <td><a href="edit-salary-process.php?id=<?php echo $salary_Process->getId() ?>"
                                       class="btn btn-xs btn-default">Edit</a></td>
                                <td><a href="report.php?reject=<?php echo $salary_Process->getId() ?>"
                                       class="btn btn-xs btn-danger">Reject</a></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /#wrapper -->
<?php include_once 'includes/js.php'; ?>
<?php include_once 'includes/footer.php'; ?>

