<?php
    include('getActivity.php');
    $fff = new getActivity;
    $data = json_decode(file_get_contents("php://input"));
    
    @$firstName = $data->first_name;
    @$lastName = $data->last_name;
    @$age = $data->age;
    @$gender = $data->gender;
    @$mobileNumber = $data->mobile_number;
    @$emailAddress = $data->email_address;
    @$address = $data->address;
    @$bloodGroup = $data->blood_group;
    @$height = $data->height;
    @$weight = $data->weight;
    @$medicalHistorySelf = $data->medical_history_self;
    @$lastVisitDate = $data->last_visit_date;
    @$medicalHistorySpouse = $data->medical_history_spouse;
    @$medicalHistoryParents = $data->medical_history_parents;
    @$medicalHistoryKids = $data->medical_history_kids;
    @$ind = $data->idd;
    @$UserKey = $data->usrkey;
    @$longitude = $data->longitude;
    @$latitude = $data->latitude;
    @$heart_rate = $data->heart_rate;
    @$blood_pressure = $data->blood_pressure;
    @$pulse_rate = $data->pulse_rate;
    @$calories = $data->calories;
    
    
    
    //echo "into api call";
    $result = $fff->companyDetails($ind);
    if($result==1)
    {
        //echo "result == 1 found";
        //check user true or not
        $result2 = $fff->checkuserTrue($UserKey);
        if($result2==1)
        {
            //this user true now insert/Update there data into database
            $result3 = $fff->updateUserData($firstName,$lastName,$age,$gender,$mobileNumber,$address,$bloodGroup,$height,$weight,$medicalHistorySelf,$lastVisitDate,$medicalHistorySpouse,$medicalHistoryParents,$medicalHistoryKids,$UserKey,$longitude,$latitude, $heart_rate, $blood_pressure, $pulse_rate, $calories);
            if($result3)
            {
                //echo "result == 3 found";
                echo "{\"STATUS\":\"SUCCESS\",\"MESSAGE\":\"UPDATE SUCCESS\",\"RESPONCE\":1}";
                
            }
            else {
                //echo "result == 3 not found";
                echo $result3;
            }
        }
        else
        {
            echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID USER TOKEN\",\"RESPONCE\":2}";
        }
    }
    else
    {
        echo "{\"STATUS\":\"FAILED\",\"MESSAGE\":\"INVALID API KEY\",\"RESPONCE\":2}";
    }