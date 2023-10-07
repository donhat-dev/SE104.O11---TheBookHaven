<?php include 'header.php' ?>

<?php
if (!empty($_POST)) {
	$error = [];
	if (!empty($_POST['cus_name'])) {
		$name = $_POST['cus_name'];
	}
	if (!empty($_POST['cus_email'])) {
		$email = $_POST['cus_email'];
	}
	if (!empty($_POST['cus_birthday'])) {
		$birthday = $_POST['cus_birthday'];
	}
	if (!empty($_POST['cus_phone'])) {
		$phone = $_POST['cus_phone'];
	}
	if (!empty($_POST['cus_address'])) {
		$address = $_POST['cus_address'];
	}

	// $re_name = $_POST['cuss_name'];
	// $re_phone = $_POST['cuss_phone'];
	// $re_address = $_POST['cuss_address'];
	//$re_city = $_POST['cuss_city'];
}
if (isset($_POST['updatebtn'])) {
	$id = $_SESSION['customer']['id'];
	$name = $_POST['cus_name'];
	$email = $_POST['cus_email'];
	$birthday = $_POST['cus_birthday'];
	$phone = $_POST['cus_phone'];
	$address = $_POST['cus_address'];

	//

	$update_query = "UPDATE account SET name='$name', email='$email', phone='$phone', birthday='$birthday', address='$address' WHERE id='$id'";
	// $result =mysqli_query($conn, $update_query);
	// $conn->query($update_query)
	if (execute($update_query)) {
		echo "<script>
        	alert('Cập nhật tài khoản thành công');
        	window.location.href = 'category.php'
        </script>";

		//header('Location: index.php');
	} else {
		echo '<script type="text/javascript">
        	prompt("Cập nhật tài khoản thất bại");
        </script>';
	}
}
?>
<div class="container">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form action="" method="POST">
			<div style="margin: 30px">
				<div class="checkbox-form">
					<h3>Thông tin khách hàng</h3>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
							<div class="checkout-form-list">
								<label>Họ Tên <span class="required">*</span></label>
								<input type="text" placeholder="" name="cus_name" value="<?php echo $_SESSION['customer']['name'] ?>" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="checkout-form-list">
								<label>Ngày sinh <span class="required">*</span></label>
								<input type="date" placeholder="" name="cus_birthday" value="<?php echo $_SESSION['customer']['birthday'] ?>" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="checkout-form-list">
								<label>Số điện thoại <span class="required">*</span></label>
								<input type="" placeholder="" name="cus_phone" value="<?php echo $_SESSION['customer']['phone'] ?>" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="checkout-form-list">
								<label>Email Address <span class="required">*</span></label>
								<input type="email" placeholder="" name="cus_email" value="<?php echo $_SESSION['customer']['email'] ?>" required>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="checkout-form-list">
									<label>Địa chỉ <span class="required">*</span></label>
									<input type="text" placeholder="" name="cus_address" value="<?php echo $_SESSION['customer']['address'] ?>" required>
								</div>
							</div>
						</div>
						<div class="order-button-payment">
							<input type="submit" name="updatebtn" value="Cập nhật thông tin">
						</div>
						<div class="order-button-payment">
						</div>
						<div class="order-button-payment" style="margin-left: 50px; margin-right: 50px;">
							<input type="button" onclick="location.href='follow_order.php'" value="Xem tiến trình đơn hàng của bạn">
						</div>

					</div>

				</div>
			</div>

		</form>
	</div>
</div>


<?php include 'footer.php' ?>