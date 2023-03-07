<?php

$responseJSON =$_POST["requestJSON"];
$requestobject = json_decode($responseJSON);


$From_id = $requestobject->from_user_id;
$to_id = $requestobject->from_to_id;
$Message = $requestobject->massage;

    $timestr = date("Y-m-d H:i:s");



$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

$c->query ( "INSERT INTO `chat`(`user_from_id`,`user_to_id`,`message`,`date_time`,`status_id`) VALUES ('".$From_id."','".$to_id."','".$Message."','".$timestr."','1')");


?>