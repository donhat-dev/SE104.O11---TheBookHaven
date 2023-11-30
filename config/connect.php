

<?php
$envFile = dirname(__FILE__, 3). '/.env';

$env = parse_ini_file($envFile);
if (file_exists($envFile)) {
    $servername = $env['DB_HOST'];
    $database = $env['DB_NAME'];
    $username = $env['DB_USERNAME'];
    $password = $env['DB_PASSWORD'];
} else {
    // die("Connection failed: No .env file found");
}

$servername = 'localhost';
$database = 'se104';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'UTF8');
//mysqli_close($conn);
?>