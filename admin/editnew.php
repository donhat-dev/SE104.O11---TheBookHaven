<?php include "header.php" ?>
<?php
// Lấy hành động
$action = 'new';
if (isset($_GET['name'])) {
    $action = $_GET['name'];
} else {
    $action = "new";
}

?>

<?php if ($action == "new") { ?>
    <?php
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $news = execute("SELECT * FROM news WHERE id = $id")->fetch_assoc();
    } else {
        echo 'Không tồn tại';
    }

    if (!empty($_POST)) {
        $title = $_POST['name'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $ordering = $_POST['ordering'];
        $sql = "UPDATE news SET title = '$title', content = '$content', ordering = '$ordering', status = '$status' WHERE id = $id";
        $result = execute($sql);
        if ($result) {
            header('location: news.php?name=news');
        } else {
            echo "Thêm mới không thành công";
        }
    }
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sửa tin</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 border">
                        <form action="" method="POST" enctype="multipart/form-data" id="formthemmoi">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group price">
                                                <label for="pro_price">Tiêu đề</label>
                                                <input type="text" class="form-control" id="pro_price" name="name" value="<?php echo $news['title']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Thứ tự</label>
                                                <input type="text" class="form-control" id="pro_price" name="ordering" value="<?php echo $news['ordering']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Trạng thái</label>
                                                <select class="form-control" name="status">
                                                    <option value="0" <?php echo $news['ordering'] == 0 ? "selected" : ''; ?>>Hiện</option>
                                                    <option value="1" <?php echo $news['ordering'] == 1 ? "selected" : ''; ?>>Ẩn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="content">Tiểu sử</label>
                                                <textarea class="form-control" id="content" rows="3" name="content"><?php echo $news['content']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success m-2">Thêm Tin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php } ?>


<?php include "footer.php" ?>