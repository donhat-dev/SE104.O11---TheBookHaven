<?php
include 'config/connect.php';
include 'config/funtion.php';
// session_start();
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : 'add-to-minicart'; //kiểm tra
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1; // kiểm tra sp có trong giỏ hàng chưa
$result = execute("SELECT * FROM product WHERE id = $id")->fetch_assoc();
$price = ($result['sale_price'] > 0) ? $result['sale_price'] : $result['price'];
$total_cart = 0;

if ($action == 'add-to-minicart') {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
        $_SESSION['cart'][$id]['total_price'] = $price * $_SESSION['cart'][$id]['quantity'];
    } else {
        $cart = [
            'id' => $result['id'],
            'name' => $result['name'],
            'image' => $result['anh_bia'],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $price * $quantity,
        ];
        $_SESSION['cart'][$id] = $cart;
    }
    foreach ($_SESSION['cart'] as $key => $value) {
        $total_cart += $value['total_price'];
    }
    $_SESSION['total_cart'] = $total_cart;
?>
    <?php
    if (isset($_SESSION['cart'])) { ?>
        <?php foreach ($_SESSION['cart'] as $key => $value) {
            echo    "<tr><input name='id_up[]' type='hidden' value='<?php echo $key; ?>'>";
            echo    "<td class='product-thumbnail'><a href='#'><img src='admin/public/image/product/" . $value['image'] . "' alt='man' /></a></td>";
            echo    "<td class='product-name'><a href='#'>" . $value['name'] . "</a></td>";
            echo    "<td class='product-price'><span class='amount price'>" . $value['price'] . "</span></td>";
            echo    "<td class='product-quantity'><input type='number' name='qtt_up[]' value='" . $value['quantity'] . "'></td>";
            echo    "<td class='product-subtotal price'>" . $value['total_price'] . "</td>";
            echo    "<td class='product-remove'><button type='button' onclick='deleteProduct(" . $key . "," . $value['quantity'] . ")' class='delete_prod'><i class='fa fa-times'></i></button></td>
        </tr>";
        } ?>
    <?php }
}
