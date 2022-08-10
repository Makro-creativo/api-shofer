<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $dataUsers = json_decode(file_get_contents("php://input"), true);

    if(!empty($dataUsers['name']) && !empty($dataUsers['username']) && !empty($dataUsers['email']) && !empty($dataUsers['password'])) {
        $nameChofer = $dataUsers['name'];
        $usernameChofer = $dataUsers['username'];
        $emailChofer = $dataUsers['email'];
        $passwordChofer = $dataUsers['password'];

        $query_insert_chofer = "INSERT INTO users(name, username, password, type, email) VALUES('$nameChofer', '$usernameChofer', '$passwordChofer', 'Chofer', '$emailChofer')";
        $result_insert_chofer = mysqli_query($conexion, $query_insert_chofer);

        if($result_insert_chofer) {
            http_response_code(201);

            echo json_encode(array("message" => "Se registro exitosamente", "status" => true));
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Error al registrarse, verifique sus datos", "status" => false));
        }
    }
?>