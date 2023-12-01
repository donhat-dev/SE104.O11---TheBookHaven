<?php 

header('Content-Type: application/json');
// Cấu hình cơ bản

echo json_encode(array(
    'status' => 'success'),
);
exit;

// $api_url = 'https://mtf.onepay.vn/msp/api/v1/vpc/invoices/queries'; // URL của QueryDR API
$accessCode = '6BEB2546'; // Thay thế YOUR_ACCESS_CODE bằng AccessCode thực tế
$merchantId = 'TESTONEPAY'; // Thay thế YOUR_MERCHANT_ID bằng MerchantId thực tế

if (!isset($_POST['ref']) && !$_GET['ref'] ){
    echo json_encode(array('error' => 'Missing reference number'));
    exit;
}
elseif ($_POST['ref']){
    $ref = $_POST['ref'];
}
else{
    $ref = $_GET['ref'];
}
$api_url = $ref;



$params = array(
    'vpc_Version' => '2',
    'vpc_Command' => 'queryDR',
    'vpc_AccessCode' => $accessCode,
    'vpc_Merchant' =>  $merchantId,
    'vpc_MerchTxnRef' => $ref,
    'vpc_User' => 'op01',
    'vpc_Password' => 'op123456',
);

$vpcURL = $api_url . "?";
$appendAmp = 0;
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
$params['vpc_SecureHash'] = $secure_hash;

// Khởi tạo cURL
$ch = curl_init();
// Thiết lập các tùy chọn cURL
// curl_setopt_array($ch, array(
//     CURLOPT_URL => $api_url,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => '',
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => 'POST',
//     CURLOPT_POSTFIELDS => http_build_query($params),
//     CURLOPT_HTTPHEADER => array(
//       'Content-Type: application/x-www-form-urlencoded'
//     ),
//   ));

$api_url = str_replace('/qrs', '', $api_url);
  curl_setopt_array($ch, array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_FOLLOWLOCATION => true,
  ));

// Thực hiện yêu cầu và lưu kết quả trả về
$response = curl_exec($ch);
// echo json_decode($response, true);;
// Đóng kết nối cURL
curl_close($ch);

echo json_decode($response, true)['state'];

// In ra kết quả
// echo json_encode(curl_getinfo($ch));
?>
