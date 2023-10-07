<?php include 'header.php' ?>

<?php

$search = '';
if (isset($_GET['search'])) {
	$search = $_GET['search'];
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT  n.* , a.name , a.image FROM news n, account a
	WHERE n.author =  a.id and n.id = $id";
} else {
	$sql = "SELECT n.*,a.name,a.image FROM news n, account a
	WHERE n.author = a.id and status = 0 and n.title like '%$search%' ORDER BY ordering";
}

if (isset($_GET['name'])) {
	$name = $_GET['name'];
} else {
	$name = '';
}


if (isset($_GET["sotinmottrang"])) {
	$sotinmottrang = $_GET['sotinmottrang'];
} else {
	$sotinmottrang = 5;
}

if (isset($_GET['page'])) {
	$trang = $_GET["page"];
} else {
	$trang = 1;
}

$from = ($trang - 1) * $sotinmottrang;


$news = pagination($sql, $from, $sotinmottrang);

?>

<!-- breadcrumbs-area-start -->
<!-- breadcrumbs-area-end -->
<!-- blog-main-area-start -->
<div class="blog-main-area mb-70">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div id="dataTable_filter" class="dataTables_filter">
					<a href="addnew.php?name=news" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Thêm Mới</a>
				</div>

			</div>
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				<div class="blog-main-wrapper">
					<?php foreach ($news as $key => $value) { ?>
						<div class="single-blog-post">
							<div class="author-destils mb-30">
								<div class="author-left">
									<div class="author-description">
										<p>Đăng bởi:
											<a href="#"><span><?php echo $value['name'] ?></span></a>
											<a href="edit.php?name=new&id=<?php echo $value['id'] ?>" class="btn btn-sm btn-primary" title="Sửa"><i class="far fa-edit"></i></a>
											<a href="delete.php?id_news=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger" title="Xóa"><i class="far fa-trash-alt"></i></a>
										</p>
										<span><?php echo $value['created'] ?></span>
									</div>
								</div>

							</div>
							<div class="single-blog-content">
								<div class="single-blog-title">
									<h3><a href="news.php?id=<?php echo $value['id'] ?>" style="font-size: 20px;"><?php echo $value['title'] ?></a></h3>
								</div>
								<div class="blog-single-content">
									<div><?php echo isset($id) ? $value['content'] : get_str($value['content'], 300); ?></div>
								</div>
							</div>
							<div class="blog-comment-readmore">
								<div class="blog-readmore">
									<?php if (!isset($id)) { ?>
										<a href="news.php?id=<?php echo $value['id'] ?>">Đọc tiếp<i class="fa fa-long-arrow-right"></i></a>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<!-- pagination-area-start -->
					<div class="blog-pagination text-center">
						<?php
						if (isset($_GET['id'])) {
							$id = $_GET['id'];
							$sql = "SELECT  n.* , a.name , a.image FROM news n, account a
							WHERE n.author =  a.id and n.id = $id";
						} else {
							$sql = "SELECT n.*,a.name,a.image FROM news n, account a
							WHERE n.author = a.id and status = 0 and n.title like '%$search%' ORDER BY ordering";
						}
						$news = execute($sql);

						$sotrang = ceil(($news->num_rows) / $sotinmottrang);
						?>
						<div class="page-number">
							<ul>
								<li><a href="#"><i class="fa fa-angle-left"></i></a></li>
								<?php for ($i = 1; $i < $sotrang + 1; $i++) { ?>
									<li class="<?php if ($trang == $i) echo 'active'; ?>">
										<a href="news.php?<?php echo isset($id) ? 'id=' . $id : ''; ?>&name=news&page=<?php echo $i ?>&sotinmottrang=<?php echo $sotinmottrang; ?>&search_value=<?php echo $search ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i; ?></a>
									</li>
								<?php } ?>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- blog-main-area-end -->

<?php include 'footer.php' ?>