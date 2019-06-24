<?php
    include('Controller/MedicalDeliveryController.php');
    include('getActivity.php');
    $medicalDeliveryControllerInstance = new MedicalDeliveryController;
    $activityControllerInstance = new getActivity;
    $data = json_decode(file_get_contents("php://input"));
    
    $nameOfMedicine = $data->name_of_medicine;
    $type = $data->type;
    $quantities = $data->quantities;
    $description = $data->description;
    $deliveryAddress = $data->delivery_address;
    $alternateContact = $data->alternate_contact;
    $extraInstruction = $data->extra_instruction;
    $idd = $data->idd;
    $token = $data->token;
    
    
    $result = $activityControllerInstance->companyDetails($idd);
    if ($result == 1) {
        $validUserData = $medicalControllerInstance->getUserFromToken($token);
        if ($validUserData != null){
            $patientId = $validUserData['id'];
            $resultOfSavingMedicalData = $medicalControllerInstance->saveMedicalDeliveryRecord($nameOfMedicine, $type, $quantities, $description, $deliveryAddress, $alternateContact, $extraInstruction, $patientId);
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