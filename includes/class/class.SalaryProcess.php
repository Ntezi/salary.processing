<?php

/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 19/03/2016
 * Time: 22:56
 */
class SalaryProcess
{
    private $conn;

    public $id;
    public $user_id;
    public $date_of_work;
    public $start_time;
    public $end_time;
    public $rate_per_hour;
    public $total_rate;
    public $created_at;
    public $status;

    public $session;
    public $function;


    public function __construct(Database $database) {
        $this->conn = $database;
    }

    public function claim($user_id, $date_of_work, $start_time, $end_time, $rate_per_hour){

        $created_at = date("Y-m-d H:i:s");
        $status = PENDING;

        $number_hours =date("H:i", strtotime($end_time) - strtotime($start_time)) ;

        $total_rate = $rate_per_hour * $number_hours;

        $statement = $this->conn->connection->prepare("INSERT INTO `salary_prossing`(`user_id`, `date_of_work`, `start_time`, `end_time`, `rate_per_hour`, `total_rate`, `status`, `created_at`) VALUES (?,?,?,?,?,?,?,?)");
        $statement->bind_param('isssssis', $user_id, $date_of_work, $start_time, $end_time, $rate_per_hour, $total_rate, $status, $created_at);

        if($statement->execute()) {
            return true;
        }
        else {
            return false;
        }
    }


    public function editSalaryProcessing($date_of_work, $start_time, $end_time, $rate_per_hour, $id) {

        $number_hours =date("H:i", strtotime($end_time) - strtotime($start_time)) ;

        $total_rate = $rate_per_hour * $number_hours;

        $statement = $this->conn->connection->prepare("UPDATE `salary_prossing` SET `date_of_work`=?,`start_time`=?,`end_time`=?,`rate_per_hour`=?, `total_rate`=? WHERE `id`=?");
        $statement->bind_param('sssssi', $date_of_work, $start_time, $end_time, $rate_per_hour, $total_rate, $id);
        if($statement->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
    public function getReport($status){
        $statement = $this->conn->connection->query("SELECT `salary_prossing`.`id`, `user`.`first_name`, `user`.`middle_name`, `user`.`last_name`, `user`.`phone_number`, `user`.`status` as user_status, `salary_prossing`.`user_id`, `salary_prossing`.`date_of_work`, `salary_prossing`.`start_time`, `salary_prossing`.`end_time`, `salary_prossing`.`rate_per_hour`, `salary_prossing`.`total_rate`, `salary_prossing`.`status` as salary_status, `salary_prossing`.`created_at` FROM `salary_prossing`, `user` WHERE `salary_prossing`.`user_id` = `user`.`id` AND `salary_prossing`.`status` = $status ORDER BY `salary_prossing`.`created_at` ASC ");
        return $statement;

    }

    public function getAllReports(){
        $statement = $this->conn->connection->query("SELECT `salary_prossing`.`id`, `user`.`first_name`, `user`.`middle_name`, `user`.`last_name`, `user`.`phone_number`, `user`.`status` as user_status, `salary_prossing`.`user_id`, `salary_prossing`.`date_of_work`, `salary_prossing`.`start_time`, `salary_prossing`.`end_time`, `salary_prossing`.`rate_per_hour`, `salary_prossing`.`total_rate`, `salary_prossing`.`status` as salary_status, `salary_prossing`.`created_at` FROM `salary_prossing`, `user` WHERE `salary_prossing`.`user_id` = `user`.`id` ORDER BY `salary_prossing`.`created_at` ASC ");
        return $statement;

    }

    public function getReportInfo($id){
        $statement = $this->conn->connection->query(" SELECT * FROM `salary_prossing` WHERE `id`= $id");
        return $statement;

    }

    public function status($status, $id) {

        $statement = $this->conn->connection->prepare("UPDATE `salary_prossing` SET `status`=? WHERE `id`=?");
        $statement->bind_param('ii', $status, $id);
        if($statement->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getDateOfWork() {
        return $this->date_of_work;
    }

    public function getStarTime() {
        return $this->start_time;
    }

    public function getEndTime() {
        return $this->end_time;
    }

    public function getRatePerHour() {
        return $this->rate_per_hour;
    }

    public function getTotalRate() {
        return $this->total_rate;
    }

    public function getStatus() {
        return $this->status;
    }



    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setDateOfWork($date_of_work) {
        $this->date_of_work = $date_of_work;
    }

    public function setStarTime($start_time) {
        $this->start_time = $start_time;
    }

    public function setEndTime($end_time) {
        $this->end_time = $end_time;
    }

    public function setRatePerHour($rate_per_hour) {
        $this->rate_per_hour = $rate_per_hour;
    }

    public function setTotalRate($total_rate) {
        $this->total_rate = $total_rate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }



}