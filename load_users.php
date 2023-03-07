<?php

$userJSONText = $_POST["userJsonText"];
$userPHPobject = json_decode($userJSONText);

$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

//$t = $c->query("SELECT * FROM `user` WHERE `id`!='".$userPHPobject->id."'");

$t = $c->query("SELECT * FROM `user` WHERE `id`!='".$userPHPobject->id."' AND `name` LIKE '".$_POST["text"]."%'");

$phpResponseArray = array();
for ($x = 0; $x < $t->num_rows; $x++) {

    $phpArrayItemObject = new stdClass();

  $user = $t->fetch_assoc();

  $phpArrayItemObject->pic = $user["profile_url"];
  $phpArrayItemObject->name = $user["name"];
  $phpArrayItemObject->id = $user["id"];

  $t2 = $c->query("SELECT * FROM `chat` WHERE `user_from_id`='".$userPHPobject->id."' AND `user_to_id`='".$user["id"]."' OR `user_from_id`='".$user["id"]."' AND `user_to_id`='".$userPHPobject->id."' ORDER BY `date_time` DESC");

if ($t2->num_rows==0){
    $phpArrayItemObject->msg="No Chat Records";
    $phpArrayItemObject->time="";
    $phpArrayItemObject->count="0";

}else{

    $unseenChatCount = 0;
   // $unseenchatcount2 = 0;


    $lastChatRow = $t2->fetch_assoc();



    $phpArrayItemObject->msg= $lastChatRow["message"];

    $phpDateTime = strtotime($lastChatRow["date_time"]);
    $timestr = date('h:i a', $phpDateTime);
    $phpArrayItemObject->time= $timestr;

    $t3 = $c->query("SELECT * FROM `chat` WHERE `user_from_id`='".$userPHPobject->id."' AND `user_to_id`='".$user["id"]."' OR `user_from_id`='".$user["id"]."' AND `user_to_id`='".$userPHPobject->id."' ORDER BY `date_time` DESC");

    for($i = 0; $i < $t3->num_rows; $i++) {

        $newChatRow = $t3->fetch_assoc();

        if($newChatRow["status_id"]==1){
            $unseenChatCount++;
        }
        

    }

    $phpArrayItemObject->count= $unseenChatCount; 


}

array_push($phpResponseArray,$phpArrayItemObject);


}

$jsonresponsetext = json_encode($phpResponseArray);
echo($jsonresponsetext);


?>