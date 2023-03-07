<?php
$c = new mysqli("localhost", "root", "Java@8828", "react_chat");

$table = $c->query("SELECT * FROM `country` ");

$country_array = array();

for($i = 0; $i < $table->num_rows; $i++) {

$row = $table->fetch_assoc();

array_push($country_array,$row["name"]);



}
$json=json_encode($country_array);
echo($json);



?>