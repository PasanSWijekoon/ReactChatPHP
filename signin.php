<?php


$jsonReqestText = $_POST["jsonreqesttext"];
$phpRequestObjest = json_decode($jsonReqestText);


$mobile = $phpRequestObjest->mobile;

$password = $phpRequestObjest->password;


$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

$t = $c->query("SELECT * FROM `user` WHERE `mobile`='".$mobile."'AND `password`='".$password."'");

$Php_object = new stdClass();
if($t->num_rows==0){
    $Php_object->msg = "Error";
}else{
    $Php_object->msg = "login Success"; 
    $row = $t->fetch_assoc();
    $Php_object->user = $row;
}

$response_json = json_encode($Php_object);
echo ($response_json);

?>