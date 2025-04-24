<?php

$secret_key = "6c6c613a-b59e-4cc2-8f5a-7246116afed4";

if (!isset($_GET['response'])) {
    echo json_encode(false);
    exit;
}

$response = $_GET['response'];

$verify_url = "https://api.hcaptcha.com/siteverify";
$data = [
    'secret' => $secret_key,
    'response' => $response
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    ]
];

$context  = stream_context_create($options);
$result = file_get_contents($verify_url, false, $context);
$responseData = json_decode($result, true);

if ($responseData["success"]) {
    // Lien de téléchargement direct
    $download_link = "https://drive.google.com/uc?export=download&confirm=yes&id=14jr39_tQw8XxyxucdgepYlBVuUBdhw82";
    
    // Redirige immédiatement vers le lien
    header("Location: " . $download_link);
    exit;
} else {
    echo json_encode(false);
}
?>