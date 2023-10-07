<?php
include 'config/connect.php';
include 'config/funtion.php';
// session_start();
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$user_id = isset($_GET['cid']) ? $_GET['cid'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : 'add'; //kiểm tra
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1; // kiểm tra sp có trong giỏ hàng chưa
$result = execute("SELECT * FROM product WHERE id = $id")->fetch_assoc();
$price = ($result['sale_price'] > 0) ? $result['sale_price'] : $result['price'];
$total_cart = 0;
//$code là biến trả về giá được giảm khi nhập mã giảm giá
$code = execute("SELECT * FROM product WHERE id = $id")->fetch_assoc();

if ($action == 'add') {
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
            if ($value['quantity'] != 0) {
                echo    "<tr class='product-info'><input name='id_up[]' id='id_up[]' type='hidden' value='$key'>";
                echo    "<td class='product-thumbnail'><a href='#'><img src='admin/public/image/product/" . $value['image'] . "' alt='man' /></a></td>";
                echo    "<td class='product-name'><a  href='#' name='product" . $key . "'>" . $value['name'] . "</a></td>";
                echo    "<td class='product-price'><span class='amount price single-price' >" . $value['price'] . "</span></td>";
                echo    "<td class='product-quantity'><input class='product-quantity' product-id='" . $key . "' type='number' id='qtt_up[]' name='qtt_up[]' value='" . $value['quantity'] . "'></td>";
                echo    "<td class='product-subtotal price'>" . $value['total_price'] . "</td>";
                echo    "<td class='product-remove'><button type='button'  onclick='deleteProduct(" . $key . "," . $value['quantity'] . ")' class='delete_prod'><i class='fa fa-times'></i></button></td>";
                echo    "</tr>";
            }
        } ?>
    <?php }
}

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
    <?php if (isset($_SESSION['cart'])) { ?>
        <?php foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['quantity'] != 0) { ?>
                <tr class='single-cart'>
                    <td class='cart-img'>
                        <a href='#' name='product<?php echo $key; ?>'><img src='admin/public/image/product/<?php echo $value['image'] ?>' alt='book' /></a>
                    </td>
                    <td class='cart-info'>
                        <h5><a href='#' name='product<?php echo $key; ?>'><?php echo $value['name'] ?></a></h5>
                        <p><?php echo $value['quantity'] ?> x <span class='price'><?php echo $value['price'] ?></span></p>
                    </td>
                    <td class='cart-icon'>
                        <a type='button' href='#' onclick="deleteProduct(<?php echo $key; ?>,<?php echo $value['quantity'] ?> )"><i class='fa fa-remove'></i></a>
                    </td>
                </tr>
    <?php
            }
        }
    } ?>
    <?php
}

if ($action == 'refresh-mini-cart') {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['quantity'] != 0) { ?>
                <tr class='single-cart'>
                    <td class='cart-img'>
                        <a href='#' name='product<?php echo $key; ?>'><img src='admin/public/image/product/<?php echo $value['image'] ?>' alt='book' /></a>
                    </td>
                    <td class='cart-info'>
                        <h5><a href='#' name='product<?php echo $key; ?>'><?php echo $value['name'] ?></a></h5>
                        <p><?php echo $value['quantity'] ?> x <span class='price'><?php echo $value['price'] ?></span></p>
                    </td>
                    <td class='cart-icon'>
                        <a type='button' href='#' onclick="deleteProduct(<?php echo $key; ?>,<?php echo $value['quantity'] ?> )"><i class='fa fa-remove'></i></a>
                    </td>
                </tr>
        <?php }
        }
    }
}

if ($action == "update-totalcart") {
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
    echo number_format($_SESSION['total_cart'])  . " Đ";
}


if ($action == "update-cartcounts") {
    $product_id = $_GET['id'];
    $method = $_GET['method'];
    $count = count($_SESSION['cart']);
    if ($method == 'update') {
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
        $count = count($_SESSION['cart']);
        echo $count;
    } else {
        unset($_SESSION['cart'][$product_id]);
        $count = count($_SESSION['cart']);
        echo $count;
    }
}


if ($action == 'add-to-favorites') {
    $method = $_GET['method'];
    if ($method == 'like') {
        $str = "INSERT INTO fav VALUES ('$user_id', '$id')";
        if ($conn->query($str) == true) {
            echo "<script>alert('Đã thêm vào danh sách yêu thích !')</script>";
        } else {
            echo "failed !";
        }
    } else {
        $str = "DELETE FROM fav WHERE user_id = '$user_id' AND product_id = '$id'";
        $conn->query($str);
        echo "<script>alert('Xóa thành công !')</script>";
    }
}

if ($action == 'remove') {
    $p_id = $_GET['id'];
    if (isset($_SESSION['cart'][$p_id])) {
        unset($_SESSION['cart'][$p_id]);
    }
    foreach ($_SESSION['cart'] as $key => $value) {
        $total_cart += $value['total_price'];
    }
}

if ($action == 'clear') {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    $_SESSION['total_cart'] = $total_cart;
}

if ($action == 'update') {
    $qtt_up = isset($_GET['qtt_up']) ? $_GET['qtt_up'] : 1;
    $id_up = isset($_GET['id_up']) ? $_GET['id_up'] : 1;
    for ($i = 0; $i < count($qtt_up); $i++) {
        $qtt[$i] = json_decode($qtt_up[$i]);
        $pid[$i] = json_decode($id_up[$i]);
        if (isset($_SESSION['cart'][$pid[$i]])) {
            $_SESSION['cart'][$pid[$i]]['quantity'] = $qtt[$i];
            $_SESSION['cart'][$pid[$i]]['total_price'] = $_SESSION['cart'][$pid[$i]]['price'] * $_SESSION['cart'][$pid[$i]]['quantity'];
        }
    }
    foreach ($_SESSION['cart'] as $key => $value) {
        $total_cart += $value['total_price'];
    }
    $_SESSION['total_cart'] = $total_cart;
    echo number_format($total_cart) . " VNĐ";
}


if ($action == 'change-fav-btn') {
    $id = $_GET['p_id'];
    $user_id = $_GET['c_id'];
    $method = $_GET['method'];
    if ($method == 'like') {
        $method = "unlike";
        ?>
        <button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>);btnn.click()" name="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
        <button type='button' class="add-to-cart clone-btn" id="clone-btn" style="z-index: 10;" data-toggle="modal" data-target="#myModal2" onclick="cloneProduct(<?php echo $value['id']; ?>)" value="<?php echo $value['id']; ?>"><i class='fa fa-clone'></i></button>
    <?php
        echo    "<button type='button' class='add-to-cart dislike' id='add-to-fav'" . "onclick=" . "addToFav(" . $id . "," . $user_id . ",'" . $method . "')" . " name='p" . $id . "'><i class='fa fa-heart'></i></button>";
    } else if ($method == "unlike") { ?>
        <button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>);btnn.click()" name="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
        <button type='button' class="add-to-cart clone-btn" id="clone-btn" style="z-index: 10;" data-toggle="modal" data-target="#myModal2" onclick="cloneProduct(<?php echo $value['id']; ?>)" value="<?php echo $value['id']; ?>"><i class='fa fa-clone'></i></button>
    <?php
        $method = "like";
        echo    "<button type='button' class='add-to-cart' id='add-to-fav'" . "onclick=" . "addToFav(" . $id . "," . $user_id . ",'" . $method . "')" . " name='p" . $id . "'><i class='fa fa-heart'></i></button>";
    }
}

if ($action == 'update-after-update') {
    if (isset($_SESSION['cart'])) { ?>
        <?php foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['quantity'] > 0) {
                echo    "<tr class='product-info'><input name='id_up[]' id='id_up[]' type='hidden' value='$key'>";
                echo    "<td class='product-thumbnail'><a href='#'><img src='admin/public/image/product/" . $value['image'] . "' alt='man' /></a></td>";
                echo    "<td class='product-name'><a  href='#' name='product" . $key . "'>" . $value['name'] . "</a></td>";
                echo    "<td class='product-price'><span class='amount price single-price' name='product-sub-" . $key . "'>" . $value['price'] . "</span></td>";
                echo    "<td class='product-quantity'><input class='product-quantity' product-id='" . $key . "' type='number' id='qtt_up[]' name='qtt_up[]' value='" . $value['quantity'] . "'></td>";
                echo    "<td class='product-subtotal price'>" . $value['total_price'] . "</td>";
                echo    "<td class='product-remove'><button type='button'  onclick='deleteProduct(" . $key . "," . $value['quantity'] . ")' class='delete_prod'><i class='fa fa-times'></i></button></td>";
                echo    "</tr>";
            }
        } ?>
    <?php }
}
if ($action == 'show-product') { ?>

    <div class="product-info-main">
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <div class="flexslider">
                <img class="product-detail-img" style="max-width: 80%;" src="<?php echo 'admin/public/image/product/';
                                                                                echo $result['anh_bia']; ?>" />
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
            <div class="product-info-price">
                <div class="page-title">
                    <h2 style="  font-family: 'montserrat', sans-serif; font-size: 32px; "><?php echo $result["name"]; ?></h2>
                </div>
                <div class=" product-info-stock-sku">
                    <p>Số lượng: <?php echo $result["quantity"] ?></p>
                    <p>Lượt xem: <span class="view"><?php echo $result["view"] ?></span></p>
                </div>
                <div class="price-final">
                    <?php if ($result['sale_price'] > 0) { ?>
                        <span class="price"><?php echo number_format($result["sale_price"]) . " VNĐ"; ?></span>
                        <span class="old-price price"><?php echo number_format($result["price"]) . " VNĐ"; ?></span>
                    <?php } else { ?>
                        <span class="price"><?php echo $result["price"]; ?></span>
                    <?php } ?>
                </div>
                <div class="product-add-form">
                    <form action="xuli-cart.php">
                        <div class="quality-button">
                            <input class="qty" type="hidden" value="<?php echo $result["id"]; ?>" name="id">
                            <input class="qty" type="hidden" value="add" name="action">
                            <input class="qty" type="number" value="1" name="quantity">
                        </div>
                        <a style="cursor: pointer; color: #fff" onclick="btn.click();">Thêm vào giỏ hàng</a>
                        <a href="product-detail.php?id=<?php echo $result['id'] ?>" style="margin-left:10px"> Xem chi tiết sản phẩm</a>
                        <button type="submit" name="" id="btn" style="display:none"></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if ($action == 'update-fav') {
    $user_id = $_GET['cid'];
    if (isset($_SESSION['customer'])) {
        $row_fav = execute("SELECT * FROM fav WHERE user_id ='$user_id'")->fetch_assoc();
        $str = "SELECT * FROM fav WHERE user_id ='$user_id'";
        $rs = $conn->query($str);
        while ($row = $rs->fetch_assoc()) {
            $id = $row['product_id'];
            $product_dt = execute("SELECT * FROM product WHERE id = '$id'")->fetch_assoc(); ?>
            <div class="single-cart">
                <tr>
                    <td class="cart-img">
                        <a href="#"><img src="admin/public/image/product/<?php echo $product_dt['anh_bia'] ?>" alt="book" /></a>
                    </td>
                    <td class="cart-info">
                        <h5><a href="#"><?php echo $product_dt['name'] ?></a></h5>
                    </td>
                </tr>
            </div>
        <?php
        }
        ?>
    <?php } ?>
<?php }
