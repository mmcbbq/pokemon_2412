<?php

function dbcon(string $host = null, string $dbname = null, string $dbuser = null, string $dbpass = null): PDO
{
    $host = $host ?? $_ENV['DB_HOST'];
    $dbname = $dbname ?? $_ENV['DB_NAME'];
    $dbuser = $dbuser ?? $_ENV['DB_USER'];
    $dbpass = $dbpass ?? $_ENV['DB_PW'];
    $con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    return $con;
}


function create(array $data):false|string
{
    $con = dbcon();
    $sql = 'INSERT INTO pokemon (name, caught, type) VALUES (:name, :caught, :type)';
    $stm = $con->prepare($sql);
    $stm->execute($data);
    return $con->lastInsertId();
}