<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $updateProvider = json_decode(file_get_contents("php://input"), true);

    if(isset($updateProvider['id']) && !empty($updateProvider['id'])) {
        $idUser = $updateProvider['id'];
        $nameFlower = $updateProvider['name_flower'];
        $nameProvider = $updateProvider['name'];
        $phone = $updateProvider['phone'];
        $adress = $updateProvider['adress'];
        $status = $updateProvider['status'];

        $query_update_provider = "UPDATE users SET id='$idUser', name_flower='$nameFlower', name='$nameProvider', phone='$phone', adress='$adress', status='$status' WHERE id = '$idUser'";
        $result_update_provider = mysqli_query($conexion, $query_update_provider);

        if($result_update_provider) {
            http_response_code(201);

            echo json_encode(array("message" => "Se actualizo correctamente", "status" => true));
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "No se pudo actualizar correctamente", "status" => false));
        }
    }
?>  