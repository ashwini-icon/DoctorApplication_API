<?php
    include_once 'dbaction.php';
    include_once 'BaseController.php';
    class DoctorMetadataController extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this->connection = mysqli_connect("localhost","id10488024_doctor_app","123456","id10488024_doctor_app");
            $this->databaseAction = new dbAction();
        }

        public function getMetadata() {
            $tableName = "doctor_meta_data";
            $select = "select * from ".$tableName;
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