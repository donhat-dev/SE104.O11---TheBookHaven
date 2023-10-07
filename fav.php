<?php
include 'header.php';

?>

<body>
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#" class="active">Favorites</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="entry-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-header-title">
                        <h2>Yêu Thích</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-main-area mb-70" id="cart">
        <div class="container">
            <form action="xuli-cart.php" id="update">
                <input name="action" class="btn btn-primary" type="hidden" value="update">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Hình ảnh</th>
                                        <th class="product-name">Tên sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-price">Chức Năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_SESSION['customer'])) {
                                        $row_fav = execute("SELECT * FROM fav WHERE user_id ='$user_id'")->fetch_assoc();
                                        $str = "SELECT * FROM fav WHERE user_id ='$user_id'";
                                        $rs = $conn->query($str);
                                        while ($row = $rs->fetch_assoc()) {
                                            $id = $row['product_id'];
                                            $product_dt = execute("SELECT * FROM product WHERE id = '$id'")->fetch_assoc(); ?>
                                            <tr class='single-cart'>
                                                <td class="product-thumbnail"><a href="#"><img src="admin/public/image/product/<?php echo $product_dt['anh_bia']; ?>" alt="man" /></a></td>
                                                <td class="product-name"><a href="#"><?php echo $product_dt['name']; ?></a></td>
                                                <td class="product-price"><span class="amount price"><?php echo $product_dt['price']; ?></span></td>
                                                <td class="function"> <button type='button' class="add-to-cart dislike" id="add-to-fav" onclick="addToFav(<?php echo $id; ?>,<?php echo $user_id; ?>, 'unlike')" name="<?php echo "p" . $value['id']; ?>"><i class="fa fa-heart"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    <?php } ?>
                                </tbody>
                                <tfooter>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>

<script>
    $("#add-to-fav").click(function() {
        $(this).parent().parent().remove();
    });
</script>

<?php include 'footer.php' ?>