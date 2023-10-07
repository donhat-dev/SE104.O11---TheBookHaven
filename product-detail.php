<?php include 'header.php' ?>
<?php

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	// $sql = "SELECT * FROM product WHERE id = $id";
	$sql = "SELECT p.id, p.name, p.price, p.sale_price, p.mota, p.anh_bia, p.anh_phu, p.created,p.cate_id, p.updated,p.view, p.quantity, p.lang, c.name AS 'cate_name', p.tacgia_id, p.nxb_id
	FROM product p
	INNER JOIN category c ON p.cate_id = c.id
	WHERE p.id =  $id";
	$product = execute($sql)->fetch_assoc();

	if ($product["anh_phu"] != "") {
		$anhphu = json_decode($product['anh_phu']);
	} else {
		$anhphu = [];
	}
	$cate_id = $product['cate_id'];
	$cate_info = execute("SELECT * FROM category WHERE id = $cate_id")->fetch_assoc();
	$view_update = $product["view"] + 1;
	$pID = $product["id"];
	$sql1 = "UPDATE product SET view=$view_update WHERE id=$pID";
	execute($sql1);
	$big_img_src = "admin/public/image/big-product/";
	$check_img_exist = file_exists($big_img_src . $product['anh_bia']);
	if ($check_img_exist == 'true') {
		$img_src = "admin/public/image/big-product/";
	} else {
		$img_src = "admin/public/image/product/";
	}
} else {
	echo 'Không tồn tại';
}

?>
<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumbs-menu">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#" class="active">Product-details</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!-- breadcrumbs-area-end -->
<!-- product-main-area-start -->
<div class="product-main-area mb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 hidden-md hidden-sm hidden-xs">
				<div class="left-title mb-20">
					<h4>Danh mục</h4>
				</div>
				<div class="left-menu mb-30" style="text-transform:uppercase;">
					<ul>
						<!-- ham list phu luc-->
						<?php foreach ($category as $key => $value) { ?>
							<?php
							$cate_idd = $value['id'];
							$sub = execute("SELECT * FROM category WHERE parent_id = $cate_idd");
							$count = count(execute("SELECT p.id FROM product p, category c
										WHERE p.cate_id = c.id and p.cate_id IN (SELECT id FROM category WHERE parent_id = $cate_idd OR id = $cate_idd)")->fetch_all(MYSQLI_ASSOC));
							?>
							<li style="margin-left:20px"><a href="category.php?cate_id=<?php echo $value['id']; ?>"><?php echo mb_convert_case($value['name'], MB_CASE_UPPER) . PHP_EOL; ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="left-title mb-20">
					<h4>Mua nhiều</h4>
				</div>
				<div class="random-area mb-30" style="margin-right:20px">
					<div class="product-active-2 owl-carousel">
						<?php
						$limit = 3;
						for ($i = 0; $i < $limit; $i++) {

							$start =  $i * $limit;
							$trending_pro = execute("SELECT * FROM product ORDER BY view DESC LIMIT $start,$limit")->fetch_all(MYSQLI_ASSOC);
						?>
							<div class="product-total-2">
								<?php foreach ($trending_pro as $value) { ?>
									<div class="single-most-product bd mb-18">
										<div class="most-product-img">
											<a href="product-detail.php?id=<?php echo $value['id'] ?>"><img src="admin/public/image/product/<?php echo $value['anh_bia'] ?>" alt="book" /></a>
										</div>
										<div class="most-product-content">
											<h4><a href="product-detail.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
											<div class="product-price">
												<ul>
													<?php if ($value['sale_price'] > 0) { ?>
														<li class="price"><?php echo $value['sale_price']; ?></li>
														<li class="price old-price"><?php echo $value['price']; ?></li>
													<?php } else { ?>
														<li class="price"><?php echo $value['price']; ?></li>
													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="banner-area mb-30" style="margin-right: 20px;">
					<div class="banner-img-2">
						<a href="#"><img src="admin/public/image/banner/<?php echo $banner[0]['img_link'] ?>" alt="banner" /></a>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				<!-- product-main-area-start -->
				<div class="product-main-area" id="detail_pro">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
							<div class="flexslider">
								<ul class="slides">
									<li data-thumb="<?php echo 'admin/public/image/product/';
													echo $product['anh_bia']; ?>">
										<img class="product-detail-img" id="product-img" src="<?php echo $img_src;
																								echo $product['anh_bia']; ?>" />
									</li>
									<?php foreach ($anhphu as $key => $value) : ?>
										<li class="flex-img" data-thumb="<?php echo 'admin/public/image/product/';
																			echo $value; ?>">
											<img class="product-detail-img" id="product-img" src="<?php echo 'admin/public/image/product/';
																									echo $value; ?>" />
										</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<div class="product-info-main">
								<div class="page-title">
									<h1><?php echo $product["name"]; ?></h1>
								</div>
								<div class="product-info-stock-sku">
									<p>Danh mục: <?php echo $product["cate_name"] ?></p>
									<p>Số lượng: <?php echo $product["quantity"] ?></p>
									<p>Lượt xem: <span class="view"><?php echo $product["view"] ?></span></p>
								</div>
								<div class="product-info-price">
									<div class="price-final">
										<?php if ($product['sale_price'] > 0) { ?>
											<span class="price"><?php echo $product["sale_price"]; ?></span>
											<span class="old-price price"><?php echo $product["price"]; ?></span>
										<?php } else { ?>
											<span class="price"><?php echo $product["price"]; ?></span>
										<?php } ?>
									</div>
								</div>
								<!-- <div class="product-reviews-summary">
									<div class="rating-summary">
										<a href="#"><i class="fa fa-star"></i></a>
										<a href="#"><i class="fa fa-star"></i></a>
										<a href="#"><i class="fa fa-star"></i></a>
										<a href="#"><i class="fa fa-star"></i></a>
										<a href="#"><i class="fa fa-star"></i></a>
									</div>
									<div class="reviews-actions">
										<a href="#">3 Reviews</a>
										<a href="#" class="view">Add Your Review</a>
									</div>
								</div> -->
								<div class="product-add-form">
									<form action="xuli-cart.php">
										<div class="quality-button">
											<input class="qty" type="hidden" value="<?php echo $product["id"]; ?>" name="id">
											<input class="qty" type="hidden" value="add" name="action">
											<input class="qty" type="number" value="1" name="quantity">
										</div>
										<a style="cursor: pointer;color:#fff;" onclick="btn.click()">Add to cart</a>
										<button type="submit" name="" id="btn" style="display:none"></button>

									</form>
								</div>
								<div class="product-social-links">
									<div class="product-addto-links">
										<form action="#" method="GET" class="fav">
											<div class="product-button">
												<?php if (isset($_SESSION['customer'])) {
													$result = $conn->query("SELECT * FROM fav WHERE user_id = '" . $user_id . "' AND product_id = '" . $pID . "'");
													$numrows = $result->num_rows;
													if ($numrows == 0) { ?>
														<button type='button' class="add-to-cart" id="add-to-fav" onclick="addToFav(<?php echo $pID; ?>,<?php echo $user_id; ?>, 'like')" name="<?php echo "p" . $pID; ?>"><i class="fa fa-heart"></i></button>
													<?php } else { ?>
														<button type='button' class="add-to-cart dislike" id="add-to-fav" onclick="addToFav(<?php echo $pID; ?>,<?php echo $user_id; ?>, 'unlike')" name="<?php echo "p" . $pID; ?>"><i class="fa fa-heart"></i></button>
												<?php
													}
												} ?>
										</form>
									</div>
									<div class="product-addto-links-text">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-social-links">
					<div class="product-addto-links-text">
						<p><?php echo $product["mota"]; ?></p>
					</div>
				</div>
				<!-- product-main-area-end -->
				<!-- new-book-area-start -->
				<div class="new-book-area mt-60">
					<div class="section-title text-center mb-30">
						<h3>Sản phẩm mới</h3>
					</div>
					<div class="tab-active-2 owl-carousel">
						<?php
						$new_pro = execute("SELECT * FROM product WHERE status = 2");

						foreach ($new_pro as $key => $value) {
							$sale = 100 - $value['sale_price'] / $value['price'] * 100;
						?>
							<div class="tab-total">
								<!-- single-product-start -->
								<div class="product-wrapper">
									<div class="product-img">
										<a href="product-detail.php?id=<?php echo $value['id']; ?>">
											<img src="admin/public/image/product/<?php echo $value['anh_bia']; ?>" alt="book" class="primary" />
										</a>

										<div class="product-flag">
											<ul>
												<li><span class="sale">new</span></li>
												<?php if ($value['sale_price'] > 0) { ?>
													<li><span class="discount-percentage">-<?php echo $sale; ?>%</span></li>
												<?php } ?>
											</ul>
										</div>
									</div>
									<div class="product-details text-center">

										<h4><a href="#"><?php echo $value['name']; ?></a></h4>
										<div class="product-price">
											<ul>
												<?php if ($value['sale_price'] > 0) { ?>
													<li class="price"><?php echo $value['sale_price']; ?></li>
													<li class="price old-price"><?php echo $value['price']; ?></li>
												<?php } else { ?>
													<li class="price"><?php echo $value['price']; ?></li>
												<?php } ?>
											</ul>
										</div>
									</div>
									<div class="product-link">
										<div class="product-button">
											<a href="xuli-cart.php?action=add&id=<?php echo $value['id']; ?>" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to
												cart</a>
										</div>

									</div>
								</div>
								<!-- single-product-end -->

							</div>
						<?php } ?>
					</div>
				</div>
				<!-- new-book-area-start -->
			</div>

		</div>
	</div>
</div>
<div id="myModal3" class="modal">
	<div class="img-content">
		<span class="close">&times;</span>
		<img class="product-detail-img" id="product-detail-img" src="<?php echo $img_src;
																		echo $product['anh_bia']; ?>" />
	</div>
</div>
<style>
	#add-to-cart,
	#clone-btn {
		display: none !important;
	}

	#myBtn {
		display: none;
	}

	.center-modal {
		display: flex;
		justify-content: center;
		align-items: center;

	}

	#product-img {
		cursor: pointer;
		transition: 0.3s;
	}

	#product-img:hover {
		opacity: 0.5;
	}

	.img-content {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 800px;
	}

	.img-content {
		animation-name: zoom;
		animation-duration: 0.6s;
	}

	@keyframes zoom {
		from {
			transform: scale(0)
		}

		to {
			transform: scale(1)
		}
	}

	.close {
		position: absolute;
		top: 15px;
		right: 35px;
		color: #f1f1f1;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
	}

	@media only screen and (max-width: 700px) {
		.modal-content {
			width: 100%;
		}
	}
</style>
<script>
	var modal = document.getElementById("myModal3");

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById("product-img");
	var modalImg = document.getElementById("product-detail-img");
	var span = document.getElementsByClassName("close")[0];
	img.onclick = function() {
		modal.style.display = "block";
		modalImg.src = this.src;
		modal.addClass("center-modal");
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}
</script>
<!-- product-main-area-end -->


<?php include 'footer.php' ?>