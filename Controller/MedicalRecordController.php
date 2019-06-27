<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class MedicalRecordController extends BaseController
    {
        
        public function __construct()
        {
            parent::__construct();
            $this->connection = mysqli_connect("localhost","root","","doctor_app");
            $this->databaseAction = new dbAction();
        }
        
        public function saveMedicalRecord($nameOfMedicine, $type, $quantity, $unit, $repeatingDays, $repeatingTime, $patient_id) {
           $tableName = "medical_record";
           $value = "(name_of_medicine,type,quantity,unit,repeating_days,repeating_time, patient_id) VALUES ('$nameOfMedicine','$type','$quantity','$unit','$repeatingDays', '$repeatingTime', $patient_id)";
           $result = $this->databaseAction->insert($tableName,$value);
           return $result;
        }
        
        public function getMedicalRecord($id) {
            $tableName = "medical_record";
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
                    if ($index == $check){
                        $returnString .= "]";
                    }
                }
                return $returnString;
            }
            else
            {
                return false;
            }
        }
    
        
    }