<?php
$secret = 'se!)$g(';
$headerHash = $_SERVER['HTTP_X_HUB_SIGNATURE'];

$payload = file_get_contents('php://input');
$calculatedHash = 'sha1=' . hash_hmac('sha1', $payload, $secret, false);

if (hash_equals($headerHash, $calculatedHash)) {
    exec('/home/update_script.sh');
}
?>
