<?php
include 'config/connect.php';
include 'config/funtion.php';
$from = $_GET['from'];
$amount = $_GET['amount'];
$sql = $_GET['sql'];

$product = pagination($sql, $from, $amount);

foreach ($product as $key => $value) {
    $sale = ceil(100 - $value['sale_price'] / $value['price'] * 100); ?>
    <div class="col-md-3 col-sm-6 col-xs-6 pro-loop">
        <div class="product-block product-resize fixheight">
            <!-- single-product-start -->
            <div class="product-wrapper mb-40 box" id="product">

                <div class="product-img image-resize center">
                    <a href="product-detail.php?id=<?php echo $value['id']; ?>">
                        <img src="admin/public/image/product/<?php echo $value['anh_bia'] ?>" alt="book" class="primary" />
                    </a>

                    <div class="product-flag">
                        <ul>
                            <?php if ($value['status'] == 2) { ?>
                                <li><span class="sale">new</span></li>
                            <?php } ?>
                            <?php if ($value['sale_price'] > 0) { ?>
                                <li><span class="discount-percentage">-<?php echo $sale; ?>%</span></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="product-link">
                        <form action="#" method="GET">
                            <button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>)" name="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
                            <form action="#" method="GET" class="fav">
                                <div class="product-button">
                                    <?php if (isset($_SESSION['customer'])) {
                                        $result = $conn->query("SELECT * FROM fav WHERE user_id = '" . $user_id . "' AND product_id = '" . $value['id'] . "'");
                                        $numrows = $result->num_rows;
                                        if ($numrows == 0) { ?>
                                            <button type='button' class="add-to-cart" id="add-to-fav" onclick="addToFav(<?php echo $value['id']; ?>,<?php echo $user_id; ?>, 'like')" name="<?php echo "p" . $value['id']; ?>"><i class="fa fa-heart"></i></button>
                                        <?php } else { ?>
                                            <button type='button' class="add-to-cart dislike" id="add-to-fav" onclick="addToFav(<?php echo $value['id']; ?>,<?php echo $user_id; ?>, 'unlike')" name="<?php echo "p" . $value['id']; ?>"><i class="fa fa-heart"></i></button>
                                    <?php
                                        }
                                    } ?>
                            </form>
                    </div>
                    </form>

                </div>
            </div>
            <div class="product-details text-center">

                <h4><a href="product-detail.php?id=<?php echo $value['id']; ?>"><?php echo $value['name'] ?></a></h4>
                <div class="product-price">
                    <ul>
                        <li class="price"><?php if ($value['sale_price'] > 0) {
                                                echo $value["sale_price"];
                                            } ?></li>
                        <li class="price <?php if ($value['sale_price'] > 0) {
                                                echo 'old-price nb';
                                            } ?>"><?php echo $value["price"] ?></li>
                    </ul>
                </div>
            </div>


        </div>
    </div>


<?php } ?>