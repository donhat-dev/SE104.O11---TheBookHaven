

<?php

$envFile = dirname(__FILE__, 2). '/.env';

// header("Content-Type: application/json");
$n=10;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
 
// echo getName($n);
?>

<?php 
$hostname = gethostname();
$ip_addr = gethostbyname($hostname);
$vpc_merch_txn_ref = time().time();
$vpc_customer_id = 'gb_customer';
$vpc_version = 2;
$vpc_currency = 'VND';
$vpc_command = 'pay';
$vpc_access_code = '6BEB2546';
$vpc_merchant = 'TESTONEPAY';
$vpc_locale = 'vn';
$vpc_return_url = 'localhost:8080';
$vpc_merch_txn_ref = substr($vpc_merch_txn_ref, 0, 34);
$vpc_order_info = $vpc_merch_txn_ref;
$vpc_amount = $_POST['amount'] * 100;
if (!isset($_POST['amount']) && !$_GET['amount'] ){
    exit;
}
elseif ($_POST['amount']){
    $vpc_amount = $_POST['amount'] * 100;
}
else{
    $vpc_amount = $_GET['amount'] * 100;
}

$vpc_ticket_no = $ip_addr;
$secure_secret = '6D0870CDE5F24F34F3915FB0045120DB';
$params = array(
    'vpc_Customer_Id' => $vpc_customer_id,
    'vpc_Version' => $vpc_version,
    'vpc_Currency' => $vpc_currency,
    'vpc_Command' => $vpc_command,
    'vpc_AccessCode' => $vpc_access_code,
    'vpc_Merchant' => $vpc_merchant,
    'vpc_Locale' => $vpc_locale,
    'vpc_ReturnURL' => $vpc_return_url,
    'vpc_MerchTxnRef' => $vpc_merch_txn_ref,
    'vpc_OrderInfo' => "Payment",
    'vpc_Amount' => (string)$vpc_amount,
    'vpc_TicketNo' => $vpc_ticket_no,
);


function get_unique_number() {
    return uniqid();
}

function get_params_string($params) {
    $appendAmp = 0;

    $param_keys = array_keys($params);
    sort($param_keys);

    $params_string = '';
    $num_param = count($param_keys);
    for ($index = 0; $index < $num_param; $index++) {
        $key = $param_keys[$index];
        $value = $params[$key];
        if ($key != 'vpc_SecureHash' && substr($key, 0, 4) == 'vpc_' && $value) {
            $params_string .= $key . '=' . $value . "&";
        }
    }
    $params_string = rtrim($params_string, "&");

    return $params_string;
}

function get_substring_index($string, $sub_string) {
    $index = strpos($string, $sub_string);
    if ($index === false) {
        return -1;
    }
    return $index;
}

function hash_secure_param($params, $secure_secret) {
    $params_string = get_params_string($params);
    // convert secure secret from hex to byte (hex decode)
    $bytes_hex_secure_secret = hex2bin($secure_secret);
    // convert params to byte
    $bytes_params = $params_string;
    // hash using sha256 hmac
    $hash_sha256hmac = hash_hmac('sha256', $bytes_params, $bytes_hex_secure_secret);
    // $hash_sha256hmac = hash_hmac('sha256', $bytes_params, pack('H*',$secure_secret));
    // to lowercase hexits
    $hash_digest = strtoupper($hash_sha256hmac);
    return $hash_digest;
}

$secure_hash = hash_secure_param($params, $secure_secret);
// $params['vpc_SecureHash'] = $secure_hash;


ob_start();
$appendAmp = 0;

$ch = curl_init();
$endpoint = 'https://mtf.onepay.vn/paygate/vpcpay.op';

$vpcURL = $endpoint . "?";

ksort ($params);

foreach ($params as $key => $value) {
    if (strlen($value) > 0) {
        
        // this ensures the first paramter of the URL is preceded by the '?' char
        if ($appendAmp == 0) {
            $vpcURL .= urlencode($key) . '=' . urlencode($value);
            $appendAmp = 1;
        } else {
            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        //$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		    $md5HashData .= $key . "=" . $value . "&";
		}
    }
}
$md5HashData = rtrim($md5HashData, "&");
$secure_hash = strtoupper(hash_hmac('SHA256', $md5HashData, hex2bin($secure_secret)));
$vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$secure_secret)));

$params['vpc_SecureHash'] = $secure_hash;


// curl_setopt($ch, CURLOPT_URL, $endpoint);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
// curl_setopt($ch, CURLOPT_HEADER, array(
//     'Content-Type: application/x-www-form-urlencoded'
// ));
curl_setopt_array($ch, array(
  CURLOPT_URL => 'https://mtf.onepay.vn/paygate/vpcpay.op',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => http_build_query($params),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));


$rs = curl_exec($ch);


// echo json_encode($params);

// echo curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

$invoice_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
//https://mtf.onepay.vn/paygate/?id=INV-MM3T72288SVD88QC&locale=vi
//using preg_match_all to get invoice_id from "id=(.*?)&"
preg_match_all('/id=(.*?)&/', $invoice_url, $matches);

if (count($matches[1]) > 0){
    $invoice_id = $matches[1][0];
}
else{
    $invoice_id = "";
}

$qr_url = 'https://mtf.onepay.vn/paygate/api/v1/invoices/(invoice_id)/qrs';
$qr_url = str_replace('(invoice_id)', $invoice_id, $qr_url);

$app_params = array(
    'app' => array(
        'id' => 'vnpay'
    ),
    'device' => array(
        'user_agent' => 'Mozilla/5.0',
        'platform' => 'Linux x86_64'
    )
);

curl_close($ch);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $qr_url,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($app_params),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$qr_response = curl_exec($curl);
//{"data":"https://qcgateway.zalopay.vn/openinapp?order=eyJ6cHRyYW5zdG9rZW4iOiJBQzlHVE8wTDJ2d2VVd2RUdmFhdE9EQnciLCJhcHBpZCI6MTE1Mn0="}

// $data = json_decode($qr_response, true);
// $qr_url = $data['data'];

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
$data = json_decode($qr_response, true);
$qr_url = $data['data'];


$src = sprintf("https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=%s&choe=UTF-8&chld=L|2",urlencode($qr_url));

echo "<img src='".$src."'> \n";



// echo $qr_url;
// echo json_encode(array('qr_url' => json_encode($qr_response)['data']));

curl_close($curl);



// $response = ob_get_contents();
// $redirect_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

// echo "\n\n\n\n\nurl:".$redirect_url."\n\n\n\n\n";

// ob_end_clean();

// $message = "";

// // serach if $response contains html error code
// if (strchr($response, "<html>") || strchr($response, "<html>")) {
//     $message = $response;
// } else {
//     // check for errors from curl
//     if (curl_error($ch))
//         $message = "%s: s" . curl_errno($ch) . "<br/>" . curl_error($ch);
// }

// // Extract the available receipt fields from the VPC Response
// // If not present then let the value be equal to 'No Value Returned'
// $map = array();

// // process response if no errors
// if (strlen($message) == 0) {
//     $pairArray = split("&", $response);
//     foreach ($pairArray as $pair) {
//         $param = split("=", $pair);
//         $map[urldecode($param[0])] = urldecode($param[1]);
//     }
//     $message = null2unknown($map, "vpc_Message");
// }
?>



 <?php
// header("Content-Type: application/json");

// $order_id = $_GET['id'];
// $amount = $_GET['amount'];
$order_id = uniqid();
$amount = rand(5000,10000);
echo $amount;

$base_url = "https://uit-se104-g9.io.vn";
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = "MOMO";
$accessKey = "F8BBA842ECF85";
$secretKey = "K951B6PE1waDMi640xX08PD3vg6EkVlz";
$orderInfo = "MoMo payment for order " . $order_id;
$redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$ipnUrl = $base_url . "/payment/momo/status";
$orderId = $order_id;
$requestId = uniqid(); // Hoặc sử dụng một thư viện tạo UUID nếu bạn muốn
$requestType = "captureWallet";
$extraData = "";

$rawSignature = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

$signature = hash_hmac('sha256', $rawSignature, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    'storeId' => "MomoTestStore",
    'requestId' => (string)$requestId,
    'amount' => $amount,
    'orderId' => $orderId,
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
$result = false;

if ($_GET['momo'] == 1){
$result = curl_exec($ch);

}

if ($result === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $responseData = json_decode($result, true);

    if ($responseData['resultCode'] === 0) {
        // Xử lý thành công
        $qr_url = $responseData['qrCodeUrl'];
        // echo $responseData['message']."\n";
        // echo $responseData['qrCodeUrl']."\n";
        // echo $responseData['payUrl']."\n";
        // Tạo mã QR và lưu nó như là một attachment

        // ...

        $src = sprintf("https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=%s&choe=UTF-8&chld=L|2",urlencode($qr_url));
    } else {
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

<title>Page Title</title>
</head>
<body>

<h1>This is a Heading <?php 
echo "Hello"
?></h1>

<img src="<?php
echo $src;
?>"/>

<p>
<?php

global $_ENV;

// echo getenv();


if (getenv()){
    // echo "1";
    // echo implode(", ", getenv());
}
else{
    echo "0";
}

 ?>
<?php
// echo 'My username is ' .$_ENV["USERNAME"] . '!';
// echo __DIR__."/..";

// echo $_SERVER['DOCUMENT_ROOT'];
// echo dirname(__FILE__, 2);
$envFile = dirname(__FILE__, 2). '/.env';
if (file_exists($envFile)) {
$env = parse_ini_file($envFile);
    $dbHost = $env['DB_HOST'];
    $dbUser = $env['DB_USER'];
    $dbPassword = $env['DB_PASSWORD'];
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://178.128.62.16:8069/api/v2/session',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'accept: application/json',
    'Authorization: Basic YWRtaW46YWRtaW4='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;





?>
</p>


