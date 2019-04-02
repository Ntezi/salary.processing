<?php

      class Database {

            public function __construct() {
                  include_once 'configurations.php';
                  $this->connection = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
                  $this->connection->set_charset("utf8");
            }

            public function __destruct() {
                  $this->connection->close();
            }
      }

?>