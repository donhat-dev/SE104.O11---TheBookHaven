<?php
include 'config/connect.php';
$id = $_GET['id'];
$quantity  = 1;
$str = "SELECT * FROM product WHERE ID ='$id'";
$rs = $conn->query($str);
$row = $rs->fetch_assoc();
$price = ($row['sale_price'] > 0) ? $row['sale_price'] : $row['price'];
$total_cart = 0;
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity'] += $quantity;
    $_SESSION['cart'][$id]['total_price'] = $price * $_SESSION['cart'][$id]['quantity'];
} else {
    $cart = [
        'id' => $row['id'],
        'name' => $row['name'],
        'image' => $row['anh_bia'],
        'price' => $price,
        'quantity' => $quantity,
        'total_price' => $price * $quantity,
    ];
    $_SESSION['cart'][$id] = $cart;
}
echo '<pre>';
print_r($_SESSION['cart']);
echo '</pre>';
foreach ($_SESSION['cart'] as $key => $value) {
    $total_cart += $value['total_price'];
}
$_SESSION['total_cart'] = $total_cart;
echo "thêm rồi đấy!";

echo "<tr><td>" . $row['id'] . "</td></tr>";
