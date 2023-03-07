<?php
$mobile = $_POST["mobile"];
$name = $_POST["name"];
$password = $_POST["password"];
$verifypassword = $_POST["verifypassword"];
$country = $_POST["country"];
$profile_picture = $_FILES["progimg"]["tmp_name"];


move_uploaded_file($profile_picture,"upload/".$mobile.".jpeg");

$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

$table = $c->query("SELECT `id` FROM `country` WHERE `name`='".$country."' ");
$row=$table->fetch_assoc();
$country_id = $row["id"];

$c->query ( "INSERT INTO `user`(`mobile`,`name`,`password`,`profile_url`,`country_id`) VALUES ('".$mobile."','".$name."','".$password."','"."upload/".$mobile.".jpeg"."','".$country_id."')");


echo("uploaded");

?>