<?php

$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);

$sql = "SELECT * FROM pokemon";

$stmt = $con->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>

    <?php

    foreach ($data as $item){

        $name = $item['name'];
        $id = $item['id'];
        $path = DOMAIN_NAME;
        echo "<a href='$path/pokemon/show/$id'>";
        echo "<div>$name</div>";
        echo "</a>";

    }
    ?>
</head>
<body>

</body>
</html>

