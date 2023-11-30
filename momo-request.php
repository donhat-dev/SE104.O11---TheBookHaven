<?php

include 'config/connect.php';
include 'config/funtion.php';


$amount = $_POST['amount'];
$order_id = uniqid();

$base_url = "https://uit-se104-g9.io.vn";
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = "MOMO";
$accessKey = "F8BBA842ECF85";
$secretKey = "K951B6PE1waDMi640xX08PD3vg6EkVlz";
$orderInfo = "MoMo payment for SE104-G9 " . $order_id;
$redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$ipnUrl = $base_url . "/momo-payment-status.php";
$orderId = $order_id;
$requestId = uniqid(); // Hoặc sử dụng một thư viện tạo UUID nếu bạn muốn
$requestType = "captureWallet";
$extraData = "";

$rawSignature = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

$signature = hash_hmac('sha256', $rawSignature, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "SE104-G9",
    'storeId' => "MomoTestStore",
    'requestId' => (string)$requestId,
    'amount' => (string)$amount,
    'orderId' => (string)$orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => "vi",
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($data))
));

$src = "qr";
$result = curl_exec($ch);

if ($result === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $responseData = json_decode($result, true);
    if ($responseData['resultCode'] === 0) {
        $qr_url = $responseData['qrCodeUrl'];
        $src = sprintf("https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=%s&choe=UTF-8&chld=L|2",urlencode($qr_url));
        echo json_encode(array(
            'status' => 'success',
            'data' => $src,
            'json_response' => $responseData,
        ));
        // insert into `payment` (id, ref, qr_base64, payment_status)
        $sql = execute("INSERT INTO payment (ref, qr_base64, payment_status) VALUES ('$order_id', '$src', '0');")
    }
    else {
        // Xử lý lỗi
        echo json_encode(array(
            'status' => 'error',
            'data' => array(
                'message' => $responseData['message'],
            ),
        ));
    }
}
curl_close($ch);



?>