<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $dataUsers = json_decode(file_get_contents("php://input"), true);

    if(!empty($dataUsers['name']) && !empty($dataUsers['username']) && !empty($dataUsers['password']) && !empty($dataUsers['type'])) {
        $name = $dataUsers['name'];
        $username = $dataUsers['username'];
        $password = $dataUsers['password'];
        $type = $dataUsers['type'];

        $query_insert_users = "INSERT INTO users(name, username, password, type) VALUE('$name', '$username', '$password', '$type')";
        $result_insert_users = mysqli_query($conexion, $query_insert_users);

        if($result_insert_users) {
            http_response_code(201);

            echo json_encode(array("message" => "Se registro exitosamente el usuarios", "status" => true));
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "No se pudo registrar exitosamente el usuario", "status" => false));
        }
    }

?>