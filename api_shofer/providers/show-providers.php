<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include "../config/conexion.php";

   $search_providers = "SELECT * FROM users WHERE type = 'Cliente' ORDER BY id ASC";
   $result_providers = mysqli_query($conexion, $search_providers);

   $count_providers = mysqli_num_rows($result_providers);

   if($count_providers > 0) {
       $rowProviders = mysqli_fetch_all($result_providers, MYSQLI_ASSOC);

       http_response_code(201);

       echo json_encode(array($rowProviders));
   } else {
       http_response_code(503);

       echo json_encode(array("message" => "No se encontro ningun proveedor", "status" => false));
   }
?>  
