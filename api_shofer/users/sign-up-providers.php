<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $dataProvider = json_decode(file_get_contents("php://input"), true);

    if(!empty($dataProvider['name']) && !empty($dataProvider['username']) && !empty($dataProvider['email']) && !empty($dataProvider['password']) && !empty($dataProvider['name_flower']) && !empty($dataProvider['adress']) && !empty($dataProvider['phone'])) {
        $nameProvider = $dataProvider['name'];
        $usernameProvider = $dataProvider['username'];
        $passwordProvider = $dataProvider['password'];
        $passwordRepeat = $dataProvider['password'];
        $emailProvier = $dataProvider['email'];
        $nameFlower = $dataProvider['name_flower'];
        $adress = $dataProvider['adress'];
        $phone = $dataProvider['phone'];

        $search_username_exist = "SELECT * FROM users WHERE username = '$usernameProvider'";
        $result_username_exist = mysqli_query($conexion, $search_username_exist);

        if(mysqli_num_rows($result_username_exist) > 0) {
            http_response_code(503);

            echo json_encode(array("message" => "El nombre de usuarios con el que intenta registrarse ya existe, intente con uno nuevo", "status" => false));
        } else if($passwordProvider === $passwordRepeat) {
            http_response_code(503);

            $passwordProvider = $dataProvider['password'];

            $query_insert_provider = "INSERT INTO users(name, username, password, email, type, name_flower, adress, phone, status) VALUES('$nameProvider', '$usernameProvider', '$passwordProvider', '$emailProvier', 'Cliente', '$nameFlower', '$adress', '$phone', 'Activo')";
            $result_insert_provider = mysqli_query($conexion, $query_insert_provider);

            if($result_insert_provider) {
                http_response_code(201);

                echo json_encode(array("message" => "Se registro existosamente como proveedor", "status" => true));
            } else {
                http_response_code(503);

                echo json_encode(array("message" => "No se pudo registrar exitosamente, revise sus datos por favor", "status" => false));
            }
        }
    }
?>