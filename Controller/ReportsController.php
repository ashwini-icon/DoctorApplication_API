<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class ReportsController extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $servername = "mysql:unix_socket=/cloudsql/doctor-mobile-application:asia-south1:doctor-app;dbname=doctor_app";
            $username = "root";
            $dbname = "doctor_app";
            $password = "123456";
            try
            {
                $this->connection = new PDO($servername, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(PDOException $e) {
                die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
                echo("Can't open the database.". $e);
            }
            $this->databaseAction = new dbAction();
        }
    
        public function saveMedicalReport($reportTitle, $reportDescription, $reportData, $patient_id) {
            $tableName = "patient_reports";
            $value = "(report_title,report_description,report_data,patient_id) VALUES ('$reportTitle','$reportDescription','$reportData', '$patient_id')";
            $result = $this->databaseAction->insert($tableName,$value);
            return $result;
        }
    
        public function getMedicalReports($id) {
            $tableName = "patient_reports";
            $condition = "patient_id = '$id'";
            $select = "select * from ".$tableName." where ".$condition;
            $run = $this->connection->query($select);
            $check = $run->rowCount();
            if($check >= 0)
            {
                $returnString = "[";
                $index = 0;
                while($rr = $run->fetch(MYSQLI_ASSOC)) {
                    if ($index != 0){
                        $returnString .= ", ";
                    }
                    $returnString .= json_encode($rr);
                    $index++;
                }
                $returnString .= "]";
                return $returnString;
            }
            else
            {
                return false;
            }
        }
    }
    
    