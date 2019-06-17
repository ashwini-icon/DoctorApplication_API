<?php
include('getActivity.php');
$fff = new getActivity;
$data = json_decode(file_get_contents("php://input"));

@$name = $data->name;
@$lname = $data->name2;
@$ag = $data->ag;
@$gender = $data->gender;
@$mobile = $data->mob;
@$address = $data->address;
@$bldgrp = $data->bldgrp;
@$height = $data->hght;
@$wght = $data->wght;
@$prnt = $data->prnt;
@$kdsDetls = $data->kdsDetls;
@$ind = $data->idd;
@$UserKey = $data->usrkey;




$result = $fff->companyDetails($ind);
if($result==1)
{
//check user true or not
$result2 = $fff->checkuserTrue($UserKey);
if($result2==1)
{
//this user true now insert/Update there data into databash
$result3 = $fff->updateUserData($name,$lname,$ag,$gender,$mobile,$address,$bldgrp,$height,$wght,$prnt,$kdsDetls,$UserKey);

if($result3)
{
?>
{"STATUS":"SUCCESS","MESSAGE":"UPDATE SUCCESS","RESPONCE":"1"}

<?php
}
}
else
{
?>
{"STATUS":"FAILED","MESSAGE":"INVALID USER","RESPONCE":"2"}
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