<?php
include 'config/connect.php';
$id = $_GET['id'];

echo '<form action="xuli-cart.php" id="update">
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
									<th class="product-quantity">Số lượng</th>
									<th class="product-subtotal">Tổng giá</th>
									<th class="product-remove">Xóa</th>
								</tr>
							</thead>';
?>
<tbody>
    <?php
    if (isset($_SESSION['cart'])) { ?>
        <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
            <tr>
                <input name="id_up[]" type="hidden" value="<?php echo $key; ?>">
                <td class="product-thumbnail"><a href="#"><img src="admin/public/image/product/<?php echo $value['image']; ?>" alt="man" /></a></td>
                <td class="product-name"><a href="#"><?php echo $value['name']; ?></a></td>
                <td class="product-price"><span class="amount price"><?php echo $value['price']; ?></span></td>
                <td class="product-quantity"><input type="number" name="qtt_up[]" value="<?php echo $value['quantity']; ?>"></td>
                <td class="product-subtotal price"><?php echo $value['total_price']; ?></td>
                <td class="product-remove"><a href="xuli-cart.php?action=remove&id=<?php echo $key; ?>"><i class="fa fa-times"></i></a></td>
            </tr>
        <?php } ?>
    <?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">

        </form>';