<?php
// Define las credenciales de tu tienda Shopify
function grapQlShopify(string $query, string $url, string $variable = ""){
    $shopifyDomain = 'dante-julius.myshopify.com';
    $accessToken = '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';
    if(isset($variable)){
      $bodyGraphql = '{
        "query": '.$query.',
        "variables": '.$variable.'
      }';
    }else{
      $bodyGraphql = $query;
    }
    // Define las opciones de la solicitud a la API de GraphQL
    $options = array(
      'http' => array(
        'header' => array(
          'Content-Type: application/json',
          'X-Shopify-Access-Token: ' . $accessToken
        ),
        'method' => 'POST',
        'content' => json_encode(array('query' => $bodyGraphql))
      )
    );

    // Envía la solicitud a la API de GraphQL de Shopify
    $context = stream_context_create($options);
    $result = file_get_contents('https://' . $shopifyDomain . $url , false, $context);

    return $result;
}