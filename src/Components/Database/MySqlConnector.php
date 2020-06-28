<?php

namespace Components\Database;

    use Settings\Settings;

    /**
     * Classe resposável por Conectar ao banco MySql.
     * 
     * @author André Gapar <and_lrg@hotmail.com>
     */
    class MySqlConnector{

        protected $conn;
        private $conString = "mysql:127.0.0.1=%s;port=3307;dbname=gymdb";
        
        function __construct(){
            $this->connect();
        }

        protected function connect(){
            $set = Settings::getSettings();

            $conString = sprintf(
                $this->conString,
                $set['host'],
                $set['port'],
                $set['database']
            );

            $this->conn = mysqli_connect('mysql','root','','gymdb','3306');
            if (mysqli_connect_errno($this->$conn)) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
//            $this->conn = new \PDO(
//                $conString,
//                $set['user'],
//                $set['password']
//            );

            if ($this->conn->connect_errno > 0) {
                die("Connection failed [" . $this->conn->connect_error . "]");
            }
        }

        public function lastId(){
            return $this->conn->insert_id;
        }

        public function close(){
            $this->conn = null;
        }
    
    }
?>