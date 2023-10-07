<?php include 'header.php'; ?>
<?php include 'config/connect.php' ?>
<!--<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="public/img/slide1.jpg/800x400?auto=yes&bg=777&fg=555&text=First slide" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="public/img/slide2.jpg/800x400?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="public/img/slide3.jpg/800x400?auto=yes&bg=555&fg=333&text=Third slide" alt="Third slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
-->
<?php
$slide = execute("SELECT img_link FROM `image` WHERE type = 0 and status = 0");
?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="admin/public/image/slider/1622811715_slide1.jpg" alt="First slide">
		</div>
		<?php
		foreach ($slide as $key => $value) { ?>
			<?php
			$img_link = $value['img_link'];
			?>
			<div class="carousel-item">
				<img class="d-block w-100" src="admin/public/image/slider/<?php echo $img_link ?>">
			</div>
		<?php } ?>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="home-main-area mt-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 dl-1200" id="trending">
				<!-- most-product-area-start -->
				<div class="most-product-area mb-30">
					<div class="section-title-2 mb-30">
						<h3>Sản phẩm thịnh hành </h3>
					</div>
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
				<!-- most-product-area-end -->
			</div>
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				<!-- new-book-area-start -->

				<div class="new-book-area">
					<div class="section-title-2 mb-30">
						<h3>Sản phẩm mới</h3>
					</div>
					<div class="tab-active-3 owl-carousel" id="product">
						<?php
						$limit = 2;
						for ($i = 0; $i < 5; $i++) {

							$start =  $i * $limit;
							$new_pro = execute("SELECT * FROM product WHERE status = 2 ORDER BY id DESC LIMIT $start,$limit");
						?>
							<div class="tab-total">
								<!-- single-product-start -->
								<?php foreach ($new_pro as $key => $value) {
									$sale = ceil(100 - $value['sale_price'] / $value['price'] * 100);
								?>
									<div class="col-lg-12 col-md-8 col-sm-8 col-xs-6">
										<div class="product-wrapper">
											<div class="product-img center">
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
												<h4><a href="product-detail.php?id=<?php echo $value['id'] ?>"><?php echo $value['name']; ?></a></h4>
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
												<form action="#" method="GET">
													<div class="product-button">
														<button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>)" product-id="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<!-- single-product-end -->
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<!-- hot sale-->
			</div>
		</div>
	</div>
</div>

<div class="mobile-index">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="hot-sell-area-2 pb-50 aos-init aos-animate">
					<div class="section-title-2 title-big bt pt-50 mb-30">
						<h3>hot sale</h3>
					</div>
					<div class="hot-sell-active owl-carousel">
						<?php
						$sale_pro = execute("SELECT * FROM product WHERE sale_price > 0 ORDER BY id DESC");

						foreach ($sale_pro as $key => $value) {
							$sale = 100 - $value['sale_price'] / $value['price'] * 100;
						?>
							<!-- single-product-start -->
							<div class="product-wrapper" id="list">
								<div class="product-img center">
									<a href="product-detail.php?id=<?php echo $value['id']; ?>">
										<img src="admin/public/image/product/<?php echo $value['anh_bia']; ?>" alt="book" class="primary" />
									</a>

									<div id="noidung">

									</div>
									<div class="product-flag">
										<ul>
											<?php if ($value['status'] == 2) { ?>
												<li><span class="sale">new</span></li>
											<?php } ?>
											<li><span class="discount-percentage">-<?php echo $sale; ?>%</span></li>
										</ul>
									</div>
								</div>
								<div class="product-details text-center">
									<h4><a href="#"><?php echo $value['name']; ?></a></h4>
									<div class="product-price">
										<ul>
											<li class="price"><?php echo $value['sale_price']; ?></li>
											<li class="old-price price"><?php echo $value['price']; ?></li>
										</ul>
									</div>
								</div>
								<div class="product-link">
									<form action="#" method="GET">
										<div class="product-button">
											<button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>)" product-id="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
										</div>
									</form>
								</div>
							</div>
							<!-- single-product-end -->
						<?php } ?>
					</div>
				</div>
				<div class="hot-sell-area-2 pb-50 aos-init aos-animate">
					<div class="section-title-2 title-big bt pt-50 mb-30">
						<h3>sách văn học</h3>
					</div>
					<div class="hot-sell-active owl-carousel">
						<?php
						$sale_pro1 = execute("SELECT * FROM product WHERE cate_id = 1");

						foreach ($sale_pro1 as $key => $value) {
							$sale = 100 - $value['sale_price'] / $value['price'] * 100;
						?>
							<!-- single-product-start -->
							<div class="product-wrapper" id="list">
								<div class="product-img center">
									<a href="product-detail.php?id=<?php echo $value['id']; ?>">
										<img src="admin/public/image/product/<?php echo $value['anh_bia']; ?>" alt="book" class="primary" />
									</a>

									<div id="noidung">

									</div>
									<div class="product-flag">
										<ul>
											<?php if ($value['status'] == 2) { ?>
												<li><span class="sale">new</span></li>
											<?php } ?>
											<li><span class="discount-percentage">-<?php echo $sale; ?>%</span></li>
										</ul>
									</div>
								</div>
								<div class="product-details text-center">
									<h4><a href="#"><?php echo $value['name']; ?></a></h4>
									<div class="product-price">
										<ul>
											<li class="price"><?php echo $value['sale_price']; ?></li>
											<li class="old-price price"><?php echo $value['price']; ?></li>
										</ul>
									</div>
								</div>
								<div class="product-link">
									<form action="#" method="GET">
										<div class="product-button">
											<button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>)" product-id="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
										</div>
									</form>
								</div>
							</div>
							<!-- single-product-end -->
						<?php } ?>
					</div>
				</div>
				<div class="hot-sell-area-2 pb-50 aos-init aos-animate">
					<div class="section-title-2 title-big bt pt-50 mb-30">
						<h3>sách kinh tế</h3>
					</div>
					<div class="hot-sell-active owl-carousel">

						<?php
						$sale_pro2 = execute("SELECT * FROM product WHERE cate_id = 2");

						foreach ($sale_pro2 as $key => $value) {
							$pre =  2;
							$sale = round(100 - $value['sale_price'] / $value['price'] * 100, $pre);
						?>
							<!-- single-product-start -->
							<div class="product-wrapper" id="list">
								<div class="product-img center">
									<a href="product-detail.php?id=<?php echo $value['id']; ?>">
										<img src="admin/public/image/product/<?php echo $value['anh_bia']; ?>" alt="book" class="primary" />
									</a>

									<div id="noidung">

									</div>
									<div class="product-flag">
										<ul>
											<?php if ($value['status'] == 2) { ?>
												<li><span class="sale">new</span></li>
											<?php } ?>
											<li><span class="discount-percentage">-<?php echo round($sale, 2); ?>%</span></li>
										</ul>
									</div>
								</div>
								<div class="product-details text-center">
									<h4><a href="#"><?php echo $value['name']; ?></a></h4>
									<div class="product-price">
										<ul>
											<li class="price"><?php echo $value['sale_price']; ?></li>
											<li class="old-price price"><?php echo $value['price']; ?></li>
										</ul>
									</div>
								</div>
								<div class="product-link">
									<form action="#" method="GET">
										<div class="product-button">
											<button type='button' class="add-to-cart" id="add-to-cart" style="z-index: 10;" onclick="addFunction(<?php echo $value['id']; ?>)" product-id="<?php echo $value['id']; ?>"><i class='fa fa-shopping-bag'></i></button>
										</div>
									</form>
								</div>
							</div>
							<!-- single-product-end -->
						<?php } ?>
					</div>
				</div>
				<div class="banner-area-5 mtb-70">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="banner-img-2 for-height">
									<a href="#"><img src="admin/public/image/banner/<?php echo $banner[1]['img_link'] ?>" alt="banner" /></a>
									<div class="banner-text">
										<h3><?php echo $banner[1]['title'] ?></h3>
										<h2><?php echo $banner[1]['content'] ?></h2>
										<?php unset($banner[1]); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="social-group-area ptb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="section-title-3">
					<h3>Tin tức mới nhất</h3>
				</div>
				<div class="twitter-content">
					<div class="twitter-icon">
						<a href="news.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i></i></a>
					</div>
					<div class="twitter-text">
						<p>
							Bấm vào đây để cập nhật tin tức mới nhất về chương trình khuyến mã và các mẹo đọc sách hay bạn nhé!
						</p>
						<a href="news.php">Xem ngay</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="section-title-3">
					<h3>Stay Connected</h3>
				</div>
				<div class="link-follow">
					<ul>
						<li><a href="https://www.facebook.com/ngan.ngan.h.2001/"><i class="fa fa-google"></i></a></li>
						<li><a href="https://www.facebook.com/ngan.ngan.h.2001/"><i class="fa fa-facebook"></i></a></li>
						<li class="hidden-sm"><a href="https://www.facebook.com/ngan.ngan.h.2001/"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- social-group-area-end -->
<!-- footer-area-start -->
<?php include 'footer.php'; ?>