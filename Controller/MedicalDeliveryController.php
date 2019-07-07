<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class MedicalDeliveryController extends BaseController
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
    
        public function saveMedicalDeliveryRecord($nameOfMedicine, $type, $quantities, $description, $deliveryAddress, $alternateContact, $extraInstruction, $patientId) {
            $tableName = "medical_delivery";
            $value = "(medicine_name,type,quantities, description, delivery_address,alternate_contact, extra_instruction, patient_id) VALUES ('$nameOfMedicine','$type','$quantities','$description','$deliveryAddress', '$alternateContact', '$extraInstruction', $patientId)";
            $result = $this->databaseAction->insert($tableName,$value);
            return $result;
        }
    
        public function getMedicalDeliveryRecord($id) {
            $tableName = "medical_delivery";
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