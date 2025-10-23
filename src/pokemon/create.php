<?php


if ($_SERVER['REQUEST_METHOD']=== 'GET'){


    ?>
    <!doctype html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport'
              content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>Document</title>
    </head>
    <body>
    <form method='post'>
        <input type='text' name='name' placeholder='name' >
        <input type='checkbox' name='caught' value='1' >
        <input type='text' name='type'  >
        <input type='submit'>



    </form>
    </body>
    </html>
    <?php
}else{
    $con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);
    $_POST['caught'] = $_POST['caught'] ?? 0;
    $sql = "INSERT INTO pokemon (name, caught, type) VALUES (:name, :caught, :type)";

    $stmt = $con->prepare($sql);

//    $_POST['caught'] = $_POST['caught'] ?? 0;

    $stmt->execute($_POST);
    $id = $con->lastInsertId();

    header('Location: '.DOMAIN_NAME."/pokemon/show/$id");




}
?>