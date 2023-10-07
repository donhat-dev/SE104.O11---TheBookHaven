

<?php
$servername = "localhost";
$database = "ban_sach";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'UTF8');
//mysqli_close($conn);
?>