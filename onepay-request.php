<?php 
include 'config/connect.php';
include 'config/funtion.php';

//set header to json
header('Content-Type: application/json');

if (!isset($_POST['app_id']) && !$_GET['app_id'] ){
    echo json_encode(array('error' => 'Missing app ID'));
    exit;
}
elseif ($_POST['app_id']){
    $app_id = $_POST['app_id'];
}
else{
    $app_id = $_GET['app_id'];
}

$secure_secret = '6D0870CDE5F24F34F3915FB0045120DB';
$vpc_access_code = '6BEB2546';
$vpc_merchant = 'TESTONEPAY';

$hostname = gethostname();
$ip_addr = gethostbyname($hostname);
$vpc_merch_txn_ref = time().time();
$vpc_customer_id = 'gb_customer';
$vpc_version = 2;
$vpc_currency = 'VND';
$vpc_command = 'pay';
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

$invoice_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
preg_match_all('/id=(.*?)&/', $invoice_url, $matches);

if (count($matches[1]) > 0){
    $invoice_id = $matches[1][0];
}
else{
    echo json_encode(array('error' => 'Invoice ID not found'));
    exit;
}

$qr_url = 'https://mtf.onepay.vn/paygate/api/v1/invoices/(invoice_id)/qrs';
$qr_url = str_replace('(invoice_id)', $invoice_id, $qr_url);
$invoice = $qr_url;

$app_params = array(
    'app' => array(
        'id' => $app_id
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

$data = json_decode($qr_response, true);
$qr_url = $data['data'];

if (!$qr_url){
    echo json_encode(array('error' => 'QR URL not found'));
    exit;
}

$src = sprintf("https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=%s&choe=UTF-8&chld=L|2",urlencode($qr_url));


$payment_sql = "INSERT INTO payment (ref, qr_base64, payment_status, invoice_id) 
                VALUES ('$vpc_merch_txn_ref', '$src', 0, '$invoice_id')";
$rs = $conn->query($payment_sql);
if (!$rs){
    echo json_encode(array('error' => 'Cannot insert payment'));
    exit;
}

echo json_encode(array(
    'status' => 'success',
    'ref' => $vpc_merch_txn_ref,
    'src' => $src, 'qr_url' => $qr_url,
    'invoice_url' => $invoice,
    'payment_id' => $conn->insert_id,
    )
);
curl_close($curl);

?>