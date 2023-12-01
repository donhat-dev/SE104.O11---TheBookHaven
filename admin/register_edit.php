<?php
include 'header.php';
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
            <!-- cái này update dưới quyền boss -->
            <?php
            if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT id, name, email, phone, password, address, type FROM `account` WHERE id='$id' ";
                $query_run = $conn->query($query);
                foreach ($query_run as $row) {
            ?>

                    <form action="code.php" method="POST" name="update">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_username" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="edit_phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Phone">
                        </div>
                        <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
                        </div> -->
                        <div class="form-group">
                            <label> Address </label>
                            <input type="text" name="edit_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label> Account Type </label>
                            <select id="user-type" name="update_usertype" class="form-control" onchange="onchangeAccountType()">
                                <option value="admin"> Admin </option>
                                <option value="user"> User </option>
                            </select>
                            <input type="hidden" id="ac-type" name="update_usertype" value="<?php echo $row['type'] ?>">
                            <script type="text/javascript">
                                function onchangeAccountType() {
                                    var account_type = document.querySelector('#user-type').value;
                                    document.querySelector('#ac-type').value = account_type;
                                }
                            </script>

                        </div>
                        <a href="register.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                    </form>
                <?php
                }
            }


            //cái này để update user đang đăng nhập
            if (isset($_POST['edit_acc'])) {
                $id = $_POST['edit_id'];
                $account_type = $_POST['ac-type'];
                $query = "SELECT id, name, email, phone, password, address FROM `account` WHERE id='$id' ";
                $query_run = $conn->query($query);

                foreach ($query_run as $row) {
                    ?>

                    <form action="code.php" method="POST" name="update">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_username" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="edit_phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Phone">
                        </div>
                        <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
                        </div> -->
                        <div class="form-group">
                            <label> Address </label>
                            <input type="text" name="edit_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label> Account Type </label>
                            <select id="user-type" name="update_usertype" class="form-control" onchange="onchangeAccountType()">
                                <option value="admin"> Admin </option>
                                <option value="user"> User </option>
                            </select>
                            <input type="hidden" id="ac-type" name="update_usertype" value="<?php echo $row['type'] ?>">
                            <script type="text/javascript">
                                function onchangeAccountType() {
                                    var account_type = document.querySelector('#user-type').value;
                                    document.querySelector('#ac-type').value = account_type;
                                }
                            </script>

                        </div>
                        <a href="register.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                    </form>
                <?php
                }
            }

                ?>


            <?php
            ?>
        </div>
    </div>
</div>

</div>

<?php
include('footer.php');
?>