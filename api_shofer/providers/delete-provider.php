<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../config/conexion.php";

    $deleteProvider = json_decode(file_get_contents("php://input"), true);

    $idProvider = $deleteProvider['id'];

    $query_delete_provider = "DELETE FROM users WHERE id = '$idProvider'";
    $result_delete_provider = mysqli_query($conexion, $query_delete_provider);

    if($result_delete_provider) {
        http_response_code(201);

        echo json_encode(array("message" => "Se elimio correctamente", "status" => true));
    } else {
        http_response_code(503);

        echo json_encode(array("messae" => "No se pudo eliminar", "status" => false));
    }
?>