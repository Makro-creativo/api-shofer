<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $dataUsers = json_decode(file_get_contents("php://input"), true);

    if(!empty($dataUsers['username']) && !empty($dataUsers['password'])) {
        $username = $dataUsers['username'];
        $password = $dataUsers['password'];

        $search_user_registered = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result_user_registered = mysqli_query($conexion, $search_user_registered);

        if(mysqli_num_rows($result_user_registered) > 0){
            http_response_code(201);

            echo json_encode(array("message" => "Iniciaste sesión correctamente", "status" => true));
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "No se encontro ningun usuario registrado", "status" => false));
        }
    }
?>