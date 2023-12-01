<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Authorization, Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Cache-Control: no-cache, no-store, must-revalidate');

$is_debug = false;
if (isset($_GET['debug']) || isset($_POST['debug'])) {
    if (isset($_GET['debug'])) {
        $is_debug = (bool) $_GET['debug'];
    }
    if (isset($_POST['debug'])) {
        $is_debug = (bool) $_POST['debug'];
    }
}
if ($is_debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

require_once dirname(__FILE__, 3).'/config/connect.php';
require_once dirname(__FILE__, 3).'/config/funtion.php';

try{
    $authorization = getallheaders()['Authorization'];
    $authorization = explode(' ', $authorization);
    $authorization = $authorization[1];
    $authorization = base64_decode($authorization);
    $authorization = explode(':', $authorization);
    $username = $authorization[0];
    $password = $authorization[1];
}
catch(Exception $e){
    echo json_encode(array('error' => 'Missing Authorization header'));
    exit;
}

if (!$username || !$password) {
    echo json_encode(array('error' => 'Missing username or password'));
    exit;
}

$result = authenticate($username, $password);
if (!$result) {
    echo json_encode(array('error' => 'Wrong username or password'));
    exit;
}

//tạo các biến để lưu thông tin cho api thực hiện query

$body = file_get_contents('php://input');
$body = json_decode($body, true);

$table = get_param_by_key('table');
$method = $_SERVER['REQUEST_METHOD'];
$method = strtolower($method);
$id = get_param_by_key('id');
$domain = get_param_by_key('domain');
$limit = get_param_by_key('limit');
$offset = get_param_by_key('offset');
$sort = get_param_by_key('sort');
$sort_type = get_param_by_key('sort_type');

foreach ($body as $key => $value) {
    $$key = $value;
}


//kiểm tra xem có thiếu thông tin không
if (!$table || !$method) {
    echo json_encode(array('error' => 'Missing table or method'));
    exit;
}
$sql = '';
//tạo câu lệnh query

if ($method == 'get') {
    if ($id) {
        $sql = "SELECT * FROM $table WHERE id = $id";
    } else {
        $sql = "SELECT * FROM $table";
    }
} elseif ($method == 'post') {

    $data = $body['data'];
    $sql = "INSERT INTO $table (";
    $sql .= implode(',', array_keys($data));
    $sql .= ") VALUES ('";
    $sql .= implode("','", array_values($data));
    $sql .= "')";

} elseif ($method == 'put') {
    $data = $body['data'];
    $sql = "UPDATE $table SET ";
    $sql .= implode(',', array_map(function ($v, $k) {
        return sprintf("%s='%s'", $k, $v);
    }, array_values($data), array_keys($data)));
    $sql .= " WHERE id = $id";
    // if (gettype($id) == 'array') {
    //     $sql .= " WHERE id IN (".implode(',', $id).")";
    // } else {
    //     $sql .= " WHERE id = $id";
    // }
} elseif ($method == 'delete') {
    $sql = "DELETE FROM $table WHERE id = $id";
} else {
    echo json_encode(array('error' => 'Method not allowed'));
    exit;
}

$method_need_limit = ['get'];
$method_need_sort = ['get'];

if (in_array($method, $method_need_sort)) {
    if (!$sort) {
        $sort = 'id';
    }
    if (!$sort_type) {
        $sort_type = 'ASC';
    }
    $sql .= " ORDER BY $sort $sort_type";
}

if (in_array($method, $method_need_limit)) {
    if (!$limit) {
        $limit = 1;
    }
    if (!$offset) {
        $offset = 0;
    }
    $sql .= " LIMIT $limit OFFSET $offset";
}




if ($is_debug) {
    echo json_encode(array(
        'table' => $table,
        'method' => $method,
        'id' => $id,
        'domain' => $domain,
        'limit' => $limit,
        'offset' => $offset,
        'sort' => $sort,
        'sort_type' => $sort_type,
        'body' => gettype($body) == 'string' ? json_decode($body, true) : $body,
        'sql' => $sql,
    ));
    exit;
}
try {
    $result = execute($sql);
    if ($result) {
        if ($method == 'get') {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } elseif ($method == 'post') {
            if ($result !== true){
                echo json_encode(array('error' => 'Insert failed', 'result' => $result));
                exit;
            }
            echo json_encode(array('success' => 'Insert success', 'result' => $result));
        } elseif ($method == 'put') {
            echo json_encode(array('success' => 'Update success'));
        } elseif ($method == 'delete') {
            echo json_encode(array('success' => 'Delete success'));
        }

    } else {
        echo json_encode(array('error' => 'Query failed'));
    }
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
    exit;
}




?>