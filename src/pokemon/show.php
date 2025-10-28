<?php
//$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);
$con = dbcon();
$sql = "SELECT * FROM pokemon where id = :id";

$stmt = $con->prepare($sql);
$stmt->execute(['id'=>$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

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
<?= $data['name'] ?>
<a href='<?= DOMAIN_NAME."/pokemon/delete/$id"  ?>'>
<button>delete</button>
</a>
<br>
<button>
<a href='<?= DOMAIN_NAME."/pokemon/update/$id"  ?>'>
    update
</a>
</button>
</body>
</html>