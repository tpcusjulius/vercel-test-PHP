<?php
// Define las credenciales de tu tienda Shopify
function grapQlShopify(string $query, string $url){
    $shopifyDomain = 'dante-julius.myshopify.com';
    $accessToken = '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';

    // Define las opciones de la solicitud a la API de GraphQL
    $options = array(
      'http' => array(
        'header' => array(
          'Content-Type: application/json',
          'X-Shopify-Access-Token: ' . $accessToken
        ),
        'method' => 'POST',
        'content' => json_encode(array('query' => $query))
      )
    );

    // Envía la solicitud a la API de GraphQL de Shopify
    $context = stream_context_create($options);
    $result = file_get_contents('https://' . $shopifyDomain . $url , false, $context);

    return $result;
}