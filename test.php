<div class="slider-group  mt-30">
    <div class="container">
        <div class="row">

            <?php if (empty($payment)) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php } else { ?>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <?php } ?>
                    <!-- slider-area-start -->
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            <?php foreach ($slider as $key => $value) { ?>
                                <div class="single-slider slider-hm4-1 pt-154 pb-154 bg-img" style="background-image:url(admin/public/image/slider/<?php echo $value['img_link'] ?>);">
                                    <div class="slider-content-4 slider-animated-1 pl-40">
                                        <h1><?php echo $value['title'] ?></h1>
                                        <h2><?php echo $value['content'] ?></h2>
                                        <a href="category.php" style="background-color: #A9C7FA ">Shopping now!</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- slider-area-end -->
                    </div>
                    <div class="col-lg-3 col-md-3 hidden-sm col-xs-12">
                        <!-- banner-static-2-start -->
                        <div class="banner-static-2">
                            <div class="banner-img-2">
                                <a href="#"><img src="admin/public/image/icon-img/<?php echo $payment[0]['img_link'] ?>" alt="banner" /></a>
                                <?php unset($payment[0]); ?>
                            </div>
                            <!-- banner-area-3-start -->
                            <div class="banner-area-3">
                                <?php foreach ($payment as $key => $value) { ?>
                                    <div class="single-banner-2 mt-16">
                                        <div class="single-icon-2">
                                            <a href="#">
                                                <img class="service-blue-img" src="admin/public/image/icon-img/<?php echo $value['img_link']; ?>" alt="banner" />
                                                <img class="service-white-img" src="admin/public/image/icon-img/white-<?php echo $value['img_link']; ?>" alt="banner" />
                                            </a>
                                        </div>
                                        <div class="single-text-2">
                                            <h2><?php echo $value['title'] ?></h2>
                                            <p><?php echo $value['content'] ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- banner-area-3-end -->
                        </div>
                        <!-- banner-static-2-end -->
                    </div>
                </div>
        </div>
    </div>