<?php
if (!isset($_GET['url'])) {
    http_response_code(400);
    echo "Falta el parámetro url.";
    exit;
}

$url = $_GET['url'];

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    echo "URL inválida.";
    exit;
}

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

header("Content-Type: $content_type");

echo $response;

curl_close($ch);
?>
