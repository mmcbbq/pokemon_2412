<?php
$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);

$sql = "DELETE FROM pokemon where id = :id";

$stmt = $con->prepare($sql);
$stmt->execute(['id'=>$id]);
header('Location: '.DOMAIN_NAME.'/pokemon/index');
exit();