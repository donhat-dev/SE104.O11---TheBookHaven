# ban_sach

Web bán sách
localhost:5500
CzSu4MAsH-zQ|o1V

<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
				<div class="shop-left" id="shop-left">
					<div class="left-title mb-20">
						<h4>Sản phẩm liên quan</h4>
					</div>
					<div class="random-area mb-30">
						<div class="product-active-2 owl-carousel">
							<?php
							$limit = 3;
							for ($i = 0; $i < $limit; $i++) {
								$cate = $product['cate_id'];
								$start =  $i * $limit;
								$random_pro3 = execute("SELECT p.*,c.name as 'cate_name' FROM product p,category c WHERE p.cate_id = c.id and c.id = $cate LIMIT $start,$limit")->fetch_all(MYSQLI_ASSOC);

    						?>
    							<div class="product-total-2">
    								<?php foreach ($random_pro3 as $value) { ?>
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
    			</div>
    		</div>
