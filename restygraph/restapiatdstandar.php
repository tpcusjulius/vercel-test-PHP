<?php
function atdApiStandard(string $method, string $url, string $body) {
    $headers = array(
        'Content-Type: application/json', // Encabezado personalizado
        'Authorization: Basic cHB0d2FwaW1hc3RlcjpwcFR3VGVzdCE=', // Encabezado de autorización personalizado
        'Accept-Lenguage: en-US',
        'clientId: PNP_TW',
        'Accept: application/json'
    );
    $context = stream_context_create([
        "http" => [
            "method"        => $method,
            "header"        => implode("\r\n", $headers),
            "content"       => $body,
            "ignore_errors" => true,
        ],
    ]);
    $response = file_get_contents('https://testws.atdconnect.com/rs/3_6/'.$url, false, $context);
    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status = $match[1];
    // if ($status !== "200") {
    //     throw new RuntimeException("unexpected response status: {$status_line}\n" . $response);
    // }

    return array($response,$status);
};