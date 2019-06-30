<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class ReportsController extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this->connection = mysqli_connect("localhost","root","","doctor_app");
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
            $run = mysqli_query($this->connection,$select);
            $check = mysqli_num_rows($run);
            if($check >= 0)
            {
                $returnString = "[";
                $index = 0;
                while($rr = mysqli_fetch_array($run,MYSQLI_ASSOC)) {
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
    
    