<?php

$user2 = $_POST["id1"];
$user1 = $_POST["id2"];


$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

$t =  $c->query("SELECT * FROM `chat` INNER JOIN `status` ON `chat`.`status_id` = `status`.`id` WHERE (`user_from_id`= '" . $user1 . "' AND `user_to_id`='" . $user2 . "') OR (`user_from_id`='" . $user2 . "' AND `user_to_id`='" . $user1 . "') ORDER BY `date_time` ASC");
$chatArray = array();
for ($x = 0; $x < $t->num_rows; $x++) {

    $r = $t->fetch_assoc();
    $chatobj = new stdClass();
    $chatobj->msg = $r["message"];

$phpdate=strtotime($r["date_time"]);
$too=date('h:i a',$phpdate);



    $chatobj->time = $too;

    if ($r["user_from_id"] == $user1) {

        $chatobj->side = "right";
    } else {

        $chatobj->side = "left";
    }

    $chatobj->status = strtolower($r["name"]);


    $chatArray[$x] = $chatobj;
}

$responseJSON = json_encode($chatArray);
echo ($responseJSON);

?>
