<?php include 'header.php' ?>
<?php
$id = $_SESSION['customer']['id'];

$result = execute("SELECT id, name, phone, address, created, status from orders where acc_id='$id' and status<3");
// if ($result) {
//     $madon = $result['id'];
//     $name_nn = $result['name'];
//     $phone_nn = $result['phone'];
//     $address_nn = $result['address'];
//     $tinhtrang = $result['status'];
//     $date = $result['created'];
?>
<div class="container">
    <h3>Các đơn hàng chưa giao của bạn</h3>
    <table class="table table-bordered table-hover dataTable" id="dataTable">
        <thead>
            <tr class="text-center text-nowrap">
                <th>Mã đơn</th>
                <th>Thông tin người mua</th>
                <th>Thông tin người nhận</th>
                <th>Chi tiết đơn hàng</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-nowrap" id="order-price">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td class="text-center"><?php echo $row['id']; ?></td>
                        <td>
                            <p>Tên người mua: <?php echo $_SESSION['customer']['name']; ?></p>
                            <p>Email: <?php echo $_SESSION['customer']['email']; ?></p>
                            <p>phone: <?php echo $_SESSION['customer']['phone']; ?></p>
                        </td>
                        <td>
                            <p>Tên người nhận: <?php echo $row['name']; ?></p>
                            <p>phone: <?php echo $row['phone']; ?></p>
                            <p>Địa chỉ: <?php echo $row['address']; ?></p>
                        </td>
                        <td>
                            <p>Ngày đặt: <?php echo ($row['created']); ?></p>
                            <?php
                            $madon = $row['id'];
                            $total_order = execute("SELECT SUM(dt.quantity*dt.price) total FROM orders_detail dt WHERE dt.orders_id = $madon")->fetch_assoc(); ?>
                            <p>Tổng giá đơn hàng: <span class="price bg-success text-light"><?php echo $total_order['total']; ?></span></p>
                        </td>
                        <td class="text-center">
                            <?php if ($row['status'] == 0) { ?>
                                <h6><span class="badge badge-danger"><i class="fa fa-times"></i> Chờ duyệt</span></h6>
                                <input type="button" class="cancer-order" name="cancer-order" value="Hủy">
                                <?php if (isset($_GET['cancer-order'])) {
                                    $result = execute("UPDATE orders SET status = 2 WHERE id = $madon");
                                } ?>
                            <?php } else if ($row['status'] == 1) { ?>
                                <h6><span class="badge badge-success"><i class="fa fa-check"></i> Đang giao hàng</span></h6>
                            <?php } else if ($row['status'] == 2) { ?>
                                <h6><span class="badge badge-secondary"><i class="fa fa-times"></i> Đã hủy</span></h6>
                            <?php } else { ?>
                                <h6><span class="badge badge-info"><i class="fa fa-thumbs-up"></i> Đã giao hàng</span></h6>
                            <?php } ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php' ?>