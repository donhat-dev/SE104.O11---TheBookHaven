<footer>
	<!-- footer-top-start -->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="footer-top-menu bb-2">
						<nav>
							<ul>
								<li><a href="index.php">Trang Chủ</a></li>
								<li><a href="category.php">Danh Mục</a></li>
								<li><a href="news.php">Bài Viết</a></li>
								<li><a href="about.php">Giới Thiệu</a></li>
								<li><a href="contact.php">Liên Hệ</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-top-start -->
	<!-- footer-mid-start -->
	<div class="footer-mid ptb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="single-footer br-2 xs-mb">
								<div class="footer-title mb-20">
									<h3>SỨ MỆNH</h3>
								</div>
								<div class="footer-mid-menu">
									<p style="color:black; text-align: left;font-size: 14px;">Chúng tôi thành lập với sứ mệnh mang kho tàng kiến thức xã hội đến cho mọi người thông qua những cuốn sách với nhiều thể loại khác nhau.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="single-footer br-2 xs-mb">
								<div class="footer-title mb-20">
									<h3>BẢN ĐỒ</h3>
								</div>
								<div class="footer-mid-menu">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.232428815172!2d106.8016140498803!3d10.869918392220157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527587e9ad5bf%3A0xafa66f9c8be3c91!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiDEkEhRRyBUUC5IQ00!5e0!3m2!1svi!2s!4v1607397704513!5m2!1svi!2s" width="210" height="230" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" width="600" height="450" frameborder="0" style="border:0;width: 200px; height: 200px; align-content: center;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="single-footer br-2 xs-mb">
								<div class="footer-title mb-20">
									<h3>TRUY CẬP NHANH</h3>
								</div>
								<div class="footer-mid-menu">
									<ul>
										<li><a href="category.php?cate_id=1">Sách Văn Học</a></li>
										<li><a href="category.php?cate_id=7">Sách Kinh Tế</a></li>
										<li><a href="category.php?cate_id=13">Truyện</a></li>
										<li><a href="category.php?cate_id=19">Tiểu Thuyết</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="single-footer mrg-sm">
						<div class="footer-title mb-20">
							<h3>THÔNG TIN TRỤ SỞ</h3>
						</div>
						<div class="footer-contact">
							<p class="adress">
								<span style="color:black;"><a href="admin/login.php" target="_blank">BookStore Seminar</a></span>
							<p style="color:black;"><i class="fa fa-map-marker" aria-hidden="true" style="color:black;"></i>Trường Đại Học Công Nghệ Thông Tin - Khu Phố 6 - Phường Linh Trung - Quận Thủ Đức</p>
							</p>
							<p style="color:black;"><i style="color:black;" class="fa fa-phone-square" aria-hidden="true"></i> Số Điện Thoại: 0858941658</p>
							<p style="color:black;"><i style="color:black;" class="fa fa-envelope" aria-hidden="true"></i> Email: 19520804@gm.uit.edu.vn</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-mid-end -->
	<!-- footer-bottom-start -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row bt-2">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="copy-right-area">
						<p style="color:black;">Copyright ©BookStore. All Right Reserved.</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="payment-img text-right">
						<!-- <a href="#"><img src="public/img/1.png" alt="payment" /></a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-bottom-end -->
</footer>
<!-- footer-area-end -->
<div id="view">

</div>
<!-- modal signin start -->

<!-- modal signin end -->
<!-- Nút Gooey Menu -->
<div class="gooney-menu" style="display: none;">
	<nav class="menu-bb">
		<label class="menu-open-button" for="menu-open">
			<span class="lines line-1"></span>
			<span class="lines line-2"> </span>
		</label>

		<a href="#top" class="menu-item item-1"><i class="fa fa-angle-double-up"></i></a>
		<a href="cart.php" class="menu-item item-2"><i class="fa fa-shopping-cart"><span><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span></i></a>
		<a href="index.php" class="menu-item item-3"><i class="fa fa-home"></i></a>
	</nav>
</div>
<!-- Gooey Menu end -->

<!-- all js here -->
<!-- jquery latest version -->
<script src="admin/public/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="admin/public/autoNumeric/autoNumeric-2.0-BETA.js"></script>
<script>
	$('#product .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#list .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#bot .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#cart .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#cart-top .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#trending .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#detail_pro .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#shop-left .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#order .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
	$('#cart-account .price').autoNumeric("init", {
		aSign: ' đ',
		pSign: 's',
		mDec: '0'
	});
</script>
<script>
	$(document).ready(function() {
		$(".quickviews").click(function() {
			var proid = $(this).attr('id');
			$.ajax({
					method: "GET",
					url: "ajax.php",
					data: {
						id: proid,
						// location: "Boston"
					}
				})
				.done(function(data) {
					$("#view").html(data);
					$("#productModal" + proid).modal();
				});
		});
	});
</script>
<script src="public/js/vendor/jquery-1.12.0.min.js"></script>
<!-- bootstrap js -->
<script src="public/js/bootstrap.min.js"></script>
<!-- owl.carousel js -->
<script src="public/js/owl.carousel.min.js"></script>
<!-- meanmenu js -->
<script src="public/js/jquery.meanmenu.js"></script>
<!-- wow js -->
<script src="public/js/wow.min.js"></script>
<!-- jquery.parallax-1.1.3.js -->
<script src="public/js/jquery.parallax-1.1.3.js"></script>
<!-- jquery.countdown.min.js -->
<script src="public/js/jquery.countdown.min.js"></script>
<!-- jquery.flexslider.js -->
<script src="public/js/jquery.flexslider.js"></script>
<!-- chosen.jquery.min.js -->
<script src="public/js/chosen.jquery.min.js"></script>
<!-- jquery.counterup.min.js -->
<script src="public/js/jquery.counterup.min.js"></script>
<!-- waypoints.min.js -->
<script src="public/js/waypoints.min.js"></script>
<!-- plugins js -->
<script src="public/js/plugins.js"></script>
<!-- main js -->
<script src="public/js/main.js"></script>
</body>

<!-- Mirrored from demo.devitems.com/koparion-v2/koparion/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 May 2019 08:10:33 GMT -->

</html>