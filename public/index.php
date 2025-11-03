<?php
include '../config/loader.php';


$request = explode('/', $_SERVER['REQUEST_URI']);

$entity = $request[1] ?? null;
$method = $request[2] ?? null;
$id = $request[3] ?? null;


if ($entity === 'api') {
    $entity = $request[2];
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $request[3] ?? null;
    switch ($method) {
        case 'GET':
            if ($id) {
                $conn = dbcon();
                $sql = "SELECT * FROM pokemon where id = :id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                break;
            } else {
                $conn = dbcon();
                $sql = "SELECT * FROM pokemon;";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                break;
            }


        case 'POST':

            $conn = dbcon();
            $sql = "INSERT INTO pokemon (name, caught, type) VALUES (:name, :caught, :type)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($_POST);
            http_response_code(201);
            break;
        case "PUT":
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            $conn = dbcon();
            $sql = "UPDATE pokemon set name= :name, caught = :caught, type= :type where id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            http_response_code(201);
            break;
        case 'DELETE':
            $conn = dbcon();
            $sql = "DELETE FROM pokemon where id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('Content-Type: application/json');
            http_response_code(204);
            break;

    }
} else {
    switch ($method) {
        case '':
            echo 'Welcome';
            break;
        case 'create':
            require_once '../src/pokemon/create.php';
            break;
        case 'index';
            require_once '../src/pokemon/read.php';
            break;
        case 'show';
            require_once '../src/pokemon/show.php';
            break;
        case 'update';
            require_once '../src/pokemon/update.php';
            break;
        case 'delete';
            require_once '../src/pokemon/delete.php';
            break;
        default:
            echo 404;
    }
}
