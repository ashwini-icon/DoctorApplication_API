<?php
include('getActivity.php');
$fff = new getActivity;

$data = json_decode(file_get_contents("php://input"));

@$ind = $data->idd;
@$UserKey = $data->usrkey;


$result = $fff->companyDetails($ind);
if($result==1)
{

$result2 = $fff->checkuserTrue($UserKey);
if($result2==1)
{

 $result3 = $fff->fetchData($UserKey);

   $email = $result3['email'];
   $pass = $result3['pass'];
   $name = $result3['name'];
   $lname = $result3['lname'];
   $gender = $result3['gender'];
   $mobile = $result3['mobile'];
   $age = $result3['age'];
   $address = $result3['address'];
   $bloodgroup = $result3['bloodgroup'];
   $height = $result3['height'];
   $weight = $result3['weight'];
   $prents = $result3['prents'];
   $kidsDetails = $result3['kidsDetails'];
   $long = $result3['long'];
   $lat = $result3['lat'];

?>
{"STATUS":"FAILED","MESSAGE":"USER NOT REGISTERED","RESPONCE":"2","EMAIL":"<?php echo $email; ?>","PASS":"<?php echo $pass; ?>","NAME":"<?php echo $name; ?>","LASTNAME":"<?php echo $lname; ?>","GENDER":"<?php echo $gender; ?>","MOBILE":"<?php echo $mobile; ?>","AGE":"<?php echo $age; ?>","ADDRESS":"<?php echo $address; ?>","BLOOD":"<?php echo $bloodgroup; ?>","HEIGHT":"<?php echo $height; ?>","WEIGHT":"<?php echo $weight; ?>","PRENTS":"<?php echo $prents; ?>","KIDS":"<?php echo $kidsDetails; ?>","LONG":"<?php echo $long; ?>","LAT":"<?php echo $lat; ?>"}

<?php
}
else
{
?>
{"STATUS":"FAILED","MESSAGE":"USER NOT REGISTERED","RESPONCE":"2"}

<?php
}

}
else
{
	echo "Invalid User Action !!";
}
 

?>