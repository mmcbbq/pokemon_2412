<?php
$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);

$sql = "SELECT * FROM pokemon where id = :id";

$stmt = $con->prepare($sql);
$stmt->execute(['id'=>$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data['caught'] === 1){
    $check = 'checked';
}else{
    $check = '';
}

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
    <input type='text' name='name' placeholder='name' value='<?= $data['name'] ?>'>
    <input type='checkbox' name='caught' value='1' <?= $check ?>>
    <input type='text' name='type' value='<?= $data['type'] ?>' >
    <input type='hidden' name='id' value='<?= $data['id'] ?>'>
    <input type='submit'>



</form>
</body>
</html>
<?php
}else{
    $con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);
    $_POST['caught'] = $_POST['caught'] ?? 0;
    $sql = "UPDATE pokemon set name = :name, caught=:caught, type=:type where id = :id";

    $stmt = $con->prepare($sql);
    $stmt->execute($_POST);


    header('Location: '.DOMAIN_NAME."/pokemon/show/$id");




}
    ?>
