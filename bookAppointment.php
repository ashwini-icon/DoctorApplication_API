<?php
include('getActivity.php');
$fff = new getActivity;


$data = json_decode(file_get_contents("php://input"));
@$ind = $data->idd;
@$UserKey = $data->usrkey;
@$slot_id = $data->slot_id;
@$date = $data->date;

$result = $fff->companyDetails($ind);
if($result==1)
{
    $result2 = $fff->checkuserTrue($UserKey);
    if($result2==1)
    {
        $result3 = $fff->bookingApp($UserKey,$slot_id, $date);
        if($result3==1)
        {
            ?>
            {"STATUS":"SUCCESS","MESSAGE":"SLOT BOOKING SUCCESS","RESPONCE":"1","SLOTID":"<?php echo $slot_id ?>"}


            <?php
        }
        else
        {
            ?>
            {"STATUS":"FAILED","MESSAGE":"SLOT ALREADY BOOK","RESPONCE":"2"}
            <?php
        }

    }
    else
    {
        ?>
        {"STATUS":"FAILED","MESSAGE":"USER NOT REGISTERD","RESPONCE":"2"}

        <?php
    }
}
else
{
    echo "Invalid User Action !!";
}

?>