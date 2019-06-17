<?php
include('getActivity.php');
$fff = new getActivity;
//recevid data from request by POST method only 

$data = json_decode(file_get_contents("php://input"));

$userId = $data->email;
$passWord = $data->pass;
$ind = $data->idd;
$did = $data->did;


//$userId = "rehanansari8521@gmail.com";
//$passWord = "12345678";
//$ind = "whqgdwqe324t32t465237465hdghwge32143";
 
$result = $fff->companyDetails($ind);
if($result==1)
{
  $status = $fff->login($userId,$passWord,$did);
  
  $result2 = $status['status'];
  $em3 = $status['randum'];

  if($result2==1)
  {
?>
{"STATUS":"SUCCESS","MESSAGE":"REGISTERED USER","RESPONCE":"1","USERVISIT":"<?php echo $em3; ?>"}
<?php
  }
  else
  {
?>
{"STATUS":"FAILED","MESSAGE":"NOT REGISTERED USER","RESPONCE":"2","USERVISIT":"NULL"}
<?php
}
}
else
{
	echo "Invalid User Action !!";
}
?>