<?php

include('getActivity.php');
$fff = new getActivity;
//recevid data from request by POST method only 

$data = json_decode(file_get_contents("php://input"));

@$userId = $data->email;
@$ind = $data->idd;


$result = $fff->companyDetails($ind);
if($result==1)
{
  //check user email id and pic password if responce true;
  $result2 = $fff->forget($userId);
  $status = $result2['status'];
  $pass = $result2['password'];
  
  if($status==1)
  {

?>
{"STATUS":"SUCCESS","MESSAGE":"REGISTERED","RESPONCE":"1","PSSRD":"<?PHP echo $pass; ?>"}
<?php
  }
  else
  {
?>
{"STATUS":"FAILED","MESSAGE":"NOT REGISTERED","RESPONCE":"2","PSSRD":"NULL"}
<?php
  }

}
else
{
echo "Invalid User Action !!";
}

?>