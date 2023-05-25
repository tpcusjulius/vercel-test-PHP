<?php
function atdApiShopify(string $method, string $url, string $body) {
    $headers = array(
        'X-Shopify-Access-Token: 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', // Encabezado de autorización personalizado
        'Content-Type: application/json' // Encabezado personalizado



    );
    $context = stream_context_create([
        "http" => [
            "method"        => $method,
            "header"        => implode("\r\n", $headers),
            "content"       => $body,
            "ignore_errors" => true,
        ],
    ]);
    $response = file_get_contents('https://dante-julius.myshopify.com/admin/api/2023-01/'.$url, false, $context);
    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status = $match[1];
    // if ($status !== "200") {
    //     throw new RuntimeException("unexpected response status: {$status_line}\n" . $response);
    // }

    return array($response,$status);
};