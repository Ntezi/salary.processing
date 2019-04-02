<?php

      /**
       * Created by PhpStorm.
       * User: MARIUS
       * Date: 05-Feb-15
       * Time: 02:54
       */
      class User {

            //database connection and table name
            private $conn;

            public $id;
            public $username;
            public $password;
            public $first_name;
            public $middle_name;
            public $last_name;
            public $phone_number;
            public $status;

            public $session;
            public $function;


            public function __construct(Database $database) {
                  $this->conn = $database;
            }

            public function createUser($username, $password, $first_name, $middle_name, $last_name, $phone_number) {
                  $created_at = date("Y-m-d H:i:s");
                  $password = md5($password);
                  $status = USER;

                  $statement = $this->conn->connection->prepare("INSERT INTO `user`(`username`, `password`, `first_name`, `middle_name`, `last_name`, `phone_number`, `created_at`, `status`) VALUES (?,?,?,?,?,?,?,?)");
                  $statement->bind_param('sssssssi', $username, $password, $first_name, $middle_name, $last_name, $phone_number, $created_at, $status);

                  if($statement->execute()) {
                        return true;
                  }
                  else {
                        return false;
                  }
            }


            public function updateUser($first_name, $middle_name, $last_name, $phone_number, $id) {

                  $statement = $this->conn->connection->prepare("UPDATE `user` SET `first_name`=?,`middle_name`=?,`last_name`=?,`phone_number`=? WHERE `id` = $id");
                  $statement->bind_param('ssssi', $first_name, $middle_name, $last_name, $phone_number, $id);
                  if($statement->execute()) {
                        return true;
                  }
                  else {
                        return false;
                  }
            }


            public function checkUserName($username) {
                  $query = "SELECT `username` FROM `user` WHERE `username` =" . $username;
                  $result = $this->conn->connection->query($query);
                  return $result->num_rows;
            }

            public function login($username, $password, $location) {
                  include_once 'class.Functions.php';
                  $this->function = new Functions();

                  $password = md5($password);
                  $query = "SELECT * FROM `user` WHERE `username` = '$username' AND  `password` ='$password'";
                  $result = $this->conn->connection->query($query);
                  $num_of_rows = $result->num_rows;

                  $row = $result->fetch_array(MYSQLI_BOTH);

                  $this->setUserId($row["id"]);
                  $this->setUsername($row["username"]);
                  $this->setFirstName($row["first_name"]);
                  $this->setLastName($row["last_name"]);
                  $this->setPhoneNumber($row["phone_number"]);
                  $this->setStatus($row["status"]);

                  if($num_of_rows == 1) {
                        include_once 'class.Session.php';
                        $session = new Session();
                        $session->register(30);

                        $session->set('id', $this->getUserId());
                        $session->set('username', $this->getUsername());
                        $session->set('first_name', $this->getFirstName());
                        $session->set('last_name', $this->getLastName());
                        $session->set('phone_number', $this->getPhoneNumber());
                        $session->set('status', $this->getStatus());

//                        session_start();
//
//                        $_SESSION['id'] = $this->getUserId();
//                        $_SESSION['username'] = $this->getUsername();
//                        $_SESSION['first_name'] = $this->getFirstName();
//                        $_SESSION['last_name'] = $this->getLastName();
//                        $_SESSION['phone_number'] = $this->getPhoneNumber();
//                        $_SESSION['status'] = $this->getStatus();

                        $this->function->redirect($location);
                  }
            }


            public function getUsers(){
                  $statement = $this->conn->connection->query("SELECT * FROM `user`");
                  return $statement;
            }

            public function getUserDetails($id){
                  $statement = $this->conn->connection->query("SELECT * FROM `user` WHERE `id`=$id");
                  return $statement;
            }

            public function displayNames() {
                  echo $this->getFirstName() . '  ' . $this->getLastName();
            }

            public function getUserId() {
                  return $this->id;
            }

            public function getUsername() {
                  return $this->username;
            }

            public function getPassword() {
                  return $this->password;
            }

            public function getFirstName() {
                  return $this->first_name;
            }

            public function getMiddleName() {
                  return $this->middle_name;
            }

            public function getLastName() {
                  return $this->last_name;
            }

            public function getEmail() {
                  return $this->username;
            }

            public function getPhoneNumber() {
                  return $this->phone_number;
            }


            public function getStatus() {
                  return $this->status;
            }


            // sets id user
            public function setUserId($id) {
                  $this->id = $id;
            }

            // sets first name
            public function setUsername($username) {
                  $this->username = $username;
            }

            // sets last name
            public function setPassword($password) {
                  $this->password = $password;
            }

            public function setFirstName($first_name) {
                  $this->first_name = $first_name;
            }

            public function setMiddleName($middle_name) {
                  $this->middle_name = $middle_name;
            }

            // sets last name
            public function setLastName($last_name) {
                  $this->last_name = $last_name;
            }

            // sets phone number
            public function setPhoneNumber($phone_number) {
                  $this->phone_number = $phone_number;
            }


            // sets status
            public function setStatus($status) {
                  $this->status = $status;
            }

            public function __toString() {
                  return $this->first_name . ' ' . $this->last_name;
            }
      }