<?php
require '../functions/update-or-create-product.php';
// Comprobamos si la solicitud proviene del URL permitido y si es una solicitud POST
if ($_SERVER['HTTP_ORIGIN'] == 'http://127.0.0.1' && $_SERVER['REQUEST_METHOD'] == 'POST') {
  // Establecemos las cabeceras necesarias para permitir el acceso a la API
  header('Access-Control-Allow-Origin: http://127.0.0.1');
  header('Content-Type: application/json');

  $id = isset($_POST['id']) ? $_POST['id'] : null;
  if ($id !== null) {
    // Simulamos la obtención de información del producto a través de una base de datos o un servicio externo
    $product = productByIdShopify($id);
    // Devolvemos la información del producto en formato JSON
    echo ($product);
  } else {
    // Si no se envió un ID de producto, devolvemos un error
    http_response_code(400);
    echo json_encode(array('error' => 'Se debe proporcionar un ID de producto'));
  }
} else {
  // Si la solicitud proviene de un origen no permitido o no es una solicitud POST, devolvemos un error
  http_response_code(403);
  echo json_encode(array('error' => 'Acceso denegado'));
}
