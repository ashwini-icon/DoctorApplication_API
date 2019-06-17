<?php
include('getActivity.php');
$fff = new getActivity;

@$data = json_decode(file_get_contents("php://input"));
@$email = $data->email;
@$pass = $data->pass;
@$ind = $data->ind;
//@$ind = "whqgdwqe324t32t465237465hdghwge32143";
@$rand = md5("$ind");

 $result = $fff->companyDetails($ind);
 if($result==1)
 {
 
  $result = $fff->checkUserStatus($email);
  if($result==1)
 {
   $result = $fff->register($email,$pass,$rand);

   if($result==1)
 {
?>
{"STATUS":"SUCCESS","MESSAGE":"REGISTER SUCCESS","RESPONCE":"1"}

<?php
 }
 }
 else
 {
?>

{"STATUS":"FAILED","MESSAGE":"USER ALREADY EXIXT HERE","RESPONCE":"2"}

<?php
 }

 }
 else
 {
?>
Invalid User Action !!
<?php 
 }

?>