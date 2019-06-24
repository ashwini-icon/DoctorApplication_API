<?php
    include('Controller/MedicalRecordController.php');
    include('getActivity.php');
    $medicalControllerInstance = new MedicalRecordController;
    $activityControllerInstance = new getActivity;
    $data = json_decode(file_get_contents("php://input"));
    
    $nameOfMedicine = $data->name_of_medicine;
    $type = $data->type;
    $quantity = $data->quantity;
    $unit = $data->unit;
    $repeatingDays = $data->repeating_days;
    $repeatingTime = $data->repeating_time;
    $idd = $data->idd;
    $token = $data->token;
    
    $result = $activityControllerInstance->companyDetails($idd);
    if ($result == 1) {
        $validUserData = $medicalControllerInstance->getUserFromToken($token);
        if ($validUserData != null){
            $patient_id = $validUserData['id'];
            $resultOfSavingMedicalData = $medicalControllerInstance->saveMedicalRecord($nameOfMedicine, $type, $quantity, $unit, $repeatingDays, $repeatingTime, $patient_id);
            if ($resultOfSavingMedicalData) {
                echo "{\"STATUS\":\"SUCCESS\",\"MESSAGE\":\"UPDATE SUCCESS\",\"RESPONCE\":1}";
            }
            else{
                echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"ERROR IN INSERTING\",\"RESPONCE\":2}";
            }
        }
        else{
            echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID USER TOKEN\",\"RESPONCE\":2}";
        }
    }
    else{
        echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID API KEY\",\"RESPONCE\":2}";
    }
    
    