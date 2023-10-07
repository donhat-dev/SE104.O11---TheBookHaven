<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Patua-One|Syne" rel="stylesheet">
    <title>Bookstore - 10 năm tồn kho</title>
</head>

<?php
include 'config/connect.php';
include 'config/funtion.php';
include 'scrolltop.php';
//include 'auth.php';
// session_start();
//   session_destroy();
ob_start();
// print_r($_SESSION);
?>
<?php
$slider =  execute("SELECT * FROM  image WHERE type = 0 and status = 0 ORDER BY ordering")->fetch_all(MYSQLI_ASSOC);
$banner =  execute("SELECT * FROM  image WHERE type = 1 and status = 0 ORDER BY ordering")->fetch_all(MYSQLI_ASSOC);
$payment =  execute("SELECT * FROM  image WHERE type = 3 and status = 0 ORDER BY ordering DESC limit 0,5")->fetch_all(MYSQLI_ASSOC);
if (isset($_SESSION['customer'])) {
    $user_id = $_SESSION['customer']['id'];
}
?>


<style>
    .modal-ld {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .2) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
    }

    /* When the body has the loading class, we turn
    the scrollbar off with overflow:hidden */
    body.loading .modal-ld {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
    modal element will be visible */
    body.loading .modal-ld {
        display: block;
    }


    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        transition: 1s;
    }

    .modal.is-open {
        transform: scale(0.8);
        opacity: 1;
    }

    /* Modal Content/Box */
    .modal-content {
        max-height: 600px;
        overflow-y: hidden;
        overflow-x: hidden;
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        animation-name: zoom;
        animation-duration: 0.6s;
        /* Could be more or less, depending on screen size */
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    .modal-header {
        font-size: 18px;
        color: #444444;
        font-weight: bold;
    }

    .modal-body {
        max-height: 360px;
        overflow: scroll;
        overflow-x: hidden;
        border: 1px thin black;
    }

    .product-clone {
        max-height: 500px;
        overflow: scroll;
        overflow-x: hidden;
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    a:hover {
        text-decoration: none !important;
    }

    .active {
        color: white;
    }

    .dropdown-container {
        display: none;
        background-color: #ebebeb;
        padding-left: 8px;
    }

    .fa-caret-down {
        float: right;
        padding-right: 8px;
    }

    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    .main-menu-area {
        background: white !important;
        color: black !important;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <!-- meanmenu css -->
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="public/css/owl.carousel.css">
    <!-- font-awesome css -->
    <!-- <link rel="stylesheet" href="public/css/font-awesome1.min.css"> -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- flexslider.css-->
    <!-- style css -->
    <link rel="stylesheet" href="public/style.css">
    <link href="admin/public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
</head>
<?php if (isset($_POST['logout'])) { ?>
    unset($_SESSION['customer']);
<?php } ?>

<body class="home-4 preloading">
    <?php include 'loader.php' ?>
    <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

    <!-- Add your site or application content here -->
    <!-- header-area-start -->
    <header>
        <!-- header-top-area-start -->

        <!-- header-top-area-end -->
        <!-- header-mid-area-start -->
        <div class="header-mid-area md1200">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-5 col-sm-6 col-xs-6">
                        <div class="logo-area">
                            <a href="category.php" class="logo-icon"><img src="public/img/logo/imglogo.jpg" alt="logo" style=" margin-bottom: 10px;" /></a>
                            <a href="category.php" class="logo-text"><img src="public/img/logo/textlogo.jpg" alt="logo" style=" margin-bottom: 10px;" /></a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-sm-6 col-xs-6">

                        <aside class="top-info">
                            <div class="my-cart" id="cart-top">
                                <ul>
                                    <li><a href="cart.php" class="cart-link" id="cart"><i class="lnr lnr-cart"></i></a>
                                        <span id="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                                        <div class="mini-cart-sub">
                                            <div class="cart-product">
                                                <table>
                                                    <?php if (isset($_SESSION['cart'])) { ?>
                                                        <?php foreach ($_SESSION['cart'] as $key => $value) {
                                                            if ($value['quantity'] > 0) {
                                                        ?>
                                                                <tr class='single-cart'>
                                                                    <td class='cart-img'>
                                                                        <a href='#' name='product<?php echo $key; ?>'><img src='admin/public/image/product/<?php echo $value['image'] ?>' alt='book' /></a>
                                                                    </td>
                                                                    <td class='cart-info'>
                                                                        <h5><a href='#' name='product<?php echo $key; ?>'><?php echo $value['name'] ?></a></h5>
                                                                        <p><?php echo $value['quantity'] ?> x <span class='price'><?php echo $value['price'] ?></span></p>
                                                                    </td>
                                                                    <td class='cart-icon'>
                                                                        <a type='button' href='#' onclick="deleteProduct(<?php echo $key; ?>,<?php echo $value['quantity'] ?> )"><i class='fa fa-remove'></i></a>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                            <div class="cart-totals">
                                                <h5>Total <span class="price total-price"><?php echo isset($_SESSION['total_cart']) ? $_SESSION['total_cart'] : 0 ?></span></h5>
                                            </div>
                                            <div class="cart-bottom">
                                                <a class="view-cart" href="cart.php">Xem giỏ hàng</a>
                                                <a href="checkout.php">Thanh toán</a>
                                            </div>
                                        </div>


                                    </li>
                                </ul>
                            </div>

                            <div class="navholder">
                                <div class="account-area hidden-md hidden-sm hidden-xs">
                                    <!-- text-right -->

                                    <div class="my-cart" id="cart-top">
                                        <div class="user">
                                            <ul>
                                                <li><a href="auth_edituser.php" class="cart-link" id="cart"><i class="lnr lnr-user"></i></a>
                                                    <?php
                                                    if (isset($_SESSION['customer'])) { ?>
                                                        <div class="mini-cart-sub">
                                                            <div class="cart-bottom">
                                                                <p><?php echo "Xin chào, " . $_SESSION['customer']['name'] ?></p>
                                                                <?php if ($_SESSION['customer']['type'] == '1')
                                                                    echo "<a href='admin/index.php'>
                                                                    Admin
                                                                </a>";
                                                                ?>
                                                                <a href="auth_edituser.php">
                                                                    Tài Khoản
                                                                </a>
                                                                <a href="logout.php">
                                                                    Đăng Xuất
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="my-cart" id="cart-top">
                                        <div class="user">
                                            <ul>
                                                <li><a type='button' href="fav.php" class="cart-link" id="cart"><i class="lnr lnr-heart"></i></a>
                                                    <div class="mini-cart-sub">
                                                        <table class="fav-card">
                                                            <?php
                                                            if (isset($_SESSION['customer'])) {
                                                                $row_fav = execute("SELECT * FROM fav WHERE user_id ='$user_id'")->fetch_assoc();
                                                                $str = "SELECT * FROM fav WHERE user_id ='$user_id'";
                                                                $rs = $conn->query($str);
                                                                while ($row = $rs->fetch_assoc()) {
                                                                    $id = $row['product_id'];
                                                                    $product_dt = execute("SELECT * FROM product WHERE id = '$id'")->fetch_assoc(); ?>
                                                                    <tr class='single-cart'>
                                                                        <td class='cart-img'>
                                                                            <a href='#'><img src='admin/public/image/product/<?php echo $product_dt['anh_bia'] ?>' alt='book' /></a>
                                                                        </td>
                                                                        <td class='cart-info'>
                                                                            <h3><a href='#'><?php echo $product_dt['name'] ?></a></h3>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!--Lấy cookie để hiển thị thông tin user-->

                                    <!--  <div class="header-line">
                                        <p>Free Ship Cho Đơn Hàng Trên 300K</p>
                                    </div> -->
                                </div>


                                <div class="modal-ld">
                                    <!-- Place at bottom of page -->
                                </div>
                            </div>
                        </aside>
                    </div>



                </div>
            </div>
        </div>

        <div class="mobile-nav">

            <div class="mobile-menu">
                <div class="menu-logo">
                    <h1 class="logo logo-mobile">
                        <a href="category.php">
                            <img src="public/img/logo/logo.jpg" class="img-responsive logoicon" alt="">
                        </a>
                    </h1>


                    <div class="nav-login">
                        <div class="subnav-mobile">
                            <a href="auth_edituser.php" class="cart">
                                <i class="icon icon-user"><i class="lnr lnr-user" style="font-size: 20px;"></i></i>
                            </a>
                        </div>
                    </div>
                    <div id="cart-targets" class="cart">
                        <div class="subnav-mobile">
                            <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 22px;"></i></a>
                            <span id="cart-count" class="price"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                        </div>

                    </div>
                    <div class="side-nav">
                        <div class="subnav-mobile">
                            <a class="cart" onclick="openNav()">
                                <i class="icon icon-user"><i class="lnr lnr-menu" style="font-size: 20px;"></i></i>
                            </a>
                        </div>

                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <a href="index.php">Trang Chủ</a>
                            <a href="#" class="dropdown-btn">Danh Mục
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <div class="dropdown-container">
                                <?php
                                $category = execute("SELECT * FROM category WHERE parent_id = 0");
                                foreach ($category as $key => $value) {
                                    $parent = $value['id'];
                                    $sub = execute("SELECT * FROM category WHERE parent_id = $parent");
                                ?>
                                    <span>
                                        <a href="category.php?cate_id=<?php echo $value['id']; ?>" class="title"><?php echo $value['name']; ?></a>

                                    </span>
                                <?php } ?>
                            </div>
                            <a href="mainternance.php">Tin Tức</a>
                            <a href="contact.php">Liên Hệ</a>
                            <a href="about.php">About Us</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- header-mid-area-end -->
        <!-- main-menu-area-start -->
        <div class="main-menu-area  fs14-pd10-0" id="header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 hd-768">
                        <div class="menu-area" id="top-nav">
                            <nav>
                                <ul>
                                    <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                            <i class="fa fa-bars"></i>
                                        </a></li>
                                    <li class="active"><a href="index.php" style="color: white !important;">Trang chủ</a></li>
                                    <li><a href="category.php">Danh mục<i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu">
                                            <?php
                                            $category = execute("SELECT * FROM category WHERE parent_id = 0");
                                            foreach ($category as $key => $value) {
                                                $parent = $value['id'];
                                                $sub = execute("SELECT * FROM category WHERE parent_id = $parent");
                                            ?>
                                                <span>
                                                    <a href="category.php?cate_id=<?php echo $value['id']; ?>" class="title"><?php echo $value['name']; ?></a>
                                                    <?php foreach ($sub as $k => $val) { ?>
                                                        <a href="category.php?cate_id=<?php echo $val['id']; ?>"><?php echo $val['name']; ?></a>
                                                    <?php } ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <li><a href="news.php">Tin tức</a></li>
                                    <li><a href="contact.php">Liên hệ</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                </ul>
                            </nav>


                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="header-search">
                            <form action="category.php" id="search_form">
                                <input type="text" placeholder="  Nhập từ khóa tìm kiếm. . ." name="search" />
                                <a href="javascript:{}" onclick="document.getElementById('search_form').submit();"><i class="lnr lnr-magnifier"></i><input type="hidden"></a>
                                <div class="test"></div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="container">
                <div class="modal-content">
                    <div class="modal-header">
                        <p href="#">Bạn đang có <span id="big-cart-count" class="price"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                            sản phẩm trong giỏ hàng
                        </p>
                        <span class="close"><i class="fa fa-times" style="font-size: 25px;"></i></span>
                    </div>
                    <div class="modal-body">
                        <div class="table-content table-responsive">
                            <form method="GET">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Hình ảnh</th>
                                            <th class="product-name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng giá</th>
                                            <th class="product-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-body">
                                        <?php
                                        if (isset($_SESSION['cart'])) { ?>
                                            <?php foreach ($_SESSION['cart'] as $key => $value) {
                                                if ($value['quantity'] > 0) {
                                                    echo    "<tr class='product-info'><input name='id_up[]' id='id_up[]' type='hidden' value='$key'>";
                                                    echo    "<td class='product-thumbnail'><a href='#'><img src='admin/public/image/product/" . $value['image'] . "' alt='man' /></a></td>";
                                                    echo    "<td class='product-name'><a  href='#' name='product" . $key . "'>" . $value['name'] . "</a></td>";
                                                    echo    "<td class='product-price'><span class='amount price single-price' name='product-sub-" . $key . "'>" . $value['price'] . "</span></td>";
                                                    echo    "<td class='product-quantity'><input class='product-quantity' product-id='" . $key . "' type='number' id='qtt_up[]' name='qtt_up[]' value='" . $value['quantity'] . "'></td>";
                                                    echo    "<td class='product-subtotal price'>" . $value['total_price'] . "</td>";
                                                    echo    "<td class='product-remove'><button type='button'  onclick='deleteProduct(" . $key . "," . $value['quantity'] . ")' class='delete_prod'><i class='fa fa-times'></i></button></td>";
                                                    echo    "</tr>";
                                                }
                                            } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="buttons-cart mb-30 tl-right">
                        <ul>
                            <div class="mini-totals" style=" margin:10px;">
                                <h2>Tổng cộng</h2>
                                <span class="amount price total-price" style="font-size:25px;font-weight:600;"><?php echo isset($_SESSION['total_cart']) ? number_format($_SESSION['total_cart']) : 0; ?> VNĐ</span>
                            </div>
                            <li style="float:right"><a href="checkout.php">Check Out</a></li>
                            <li style="float:right"><a type="button" href="javascript:{}" class="update-btn">Cập nhật giỏ hàng</a></li>
                            <li style="float:right"><a type="button" href="javascript:{}" onclick="clearCart()">Xóa toàn bộ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal2" class="modal">
            <div class="container">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="product-clone">
                        <div class="clone-product">

                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <table class="form-cart"></table>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function() {
                    // hide sidebar
                    $('#sidebar').removeClass('active');
                    // hide overlay
                    $('.overlay').removeClass('active');
                });

                $('#sidebarCollapse').on('click', function() {
                    // open sidebar
                    $('#sidebar').addClass('active');
                    // fade in the overlay
                    $('.overlay').addClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
        <script>
            function myFunction() {
                var x = document.getElementById("top-nav");
                if (x.className === "menu-area") {
                    x.className += " responsive";
                } else {
                    x.className = "menu-area";
                }
            }
        </script>
        <script>
            $(function() {
                $('nav#menu-mobile').mmenu();
            });
            $(document).ready(function() {
                flagg = true;
                if (flagg) {
                    $('.click-menu-mobile a').click(function() {
                        $('#menu-mobile').removeClass('hidden');
                        flagg = false;
                    })
                }
            });
        </script>
        <script>
            $(document).on("click", ".mobile-menu-icon .dropdown-menu ,.drop-control .dropdown-menu, .drop-control .input-dropdown", function(e) {
                e.stopPropagation();
            });
        </script>
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="aos_scroll/aos.css">
        <script src="aos_scroll/aos.js"> </script>
        <script>
            AOS.init({
                disable: 'mobile'
            });
            AOS.init({
                disable: function() {
                    var maxWidth = 1024;
                    return window.innerWidth < maxWidth;
                }
            });
        </script>
        <!-- Nav Mobile JS-->
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("container").style.marginLeft = "250px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("container  ").style.marginLeft = "0";
                document.body.style.backgroundColor = "white";
            }
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
        <!-- loading screen-->
        <script>
            $(window).on('load', function(event) {
                $('body').removeClass('preloading');
                // $('.load').delay(1000).fadeOut('fast');
                $('.loader').delay(500).fadeOut('fast');
            });
        </script>
        <!-- cart modal -->
        <script>
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btnn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btnn.onclick = function() {
                modal.style.display = "block";
                $("body").addClass("modal-open");
                var scrollTop = $(window).scrollTop(),
                    topOffset = $(this).offset().top + ($(this).outerHeight() / 2) - scrollTop,
                    leftOffset = $(this).offset().left + ($(this).outerWidth() / 2),
                    $target = $($(this).attr('href'));
                $target.css('transform-origin', leftOffset + 'px ' + topOffset + 'px');
                $target.addClass('is-open');
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    $("body").removeClass("modal-open");
                    modal.removeClass('is-open');
                }
            }
            $(btnn).on('click', function(event) {
                var scrollTop = $(window).scrollTop(),
                    topOffset = $(this).offset().top + ($(this).outerHeight() / 2) - scrollTop,
                    leftOffset = $(this).offset().left + ($(this).outerWidth() / 2),
                    $target = $($(this).attr('href'));
                event.preventDefault;
                $target.css('transform-origin', leftOffset + 'px ' + topOffset + 'px');
                $target.addClass('is-open');
            });
        </script>

        <!--clone modal -->
        <script>
            var modalclone = document.getElementById("myModal2");
            var clonebtn = document.getElementById("clone-btn");
            var closebtn = document.getElementsByClassName("close")[1];
            clonebtn.onclick = function() {
                modalclone.style.display = "block";
                $("body").addClass("modal-open");

            }
            closebtn.onclick = function() {
                modalclone.style.display = "none";
                $("body").removeClass("modal-open");
            }
            window.onclick = function(e) {
                if (e.target == modalclone) {
                    modalclone.style.display = "none";
                    $("body").removeClass("modal-open");
                }
            }

            function closeModal() {
                var modalclone = document.getElementById("myModal2");
                modalclone.style.display = "none";
                $("body").removeClass("modal-open");
            }

            function cloneProduct(id) {
                var id = id;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: id,
                        action: 'show-product'
                    }
                }).done(function(data) {
                    $(".clone-product").html(data);
                });
            };
        </script>


        <!--ajax them vao gio hang/update gio hang/delete san pham -->
        <script>
            function deleteProduct(p_id, p_qty) {
                var p_id = p_id;
                var this_btn = document.getElementsByName('product' + p_id);
                $(this_btn).parent().parent().remove();
                var p_qty = p_qty;
                var action = 'remove';
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: p_id,
                        action: action,
                        quantity: p_qty
                    }
                }).done(function() {
                    updateCart_toltals(p_id);
                    updateCartcount(p_id, 'delete');
                })
            };

            function updateCartcount(p_id, method) {
                var id = p_id;
                var action = 'update-cartcounts';
                var quantity = 0;
                var method = method;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    dataType: 'html',
                    type: 'GET',
                    data: {
                        id: id,
                        action: action,
                        quantity: quantity,
                        method: method
                    }
                }).done(function(data) {
                    $("#cart-count").html(data);
                    $("#big-cart-count").html(data);
                });
            };

            function updateMiniCart(p_id) {
                var id = p_id;
                var action = 'add-to-minicart';
                var quantity = 0;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: id,
                        action: action,
                        quantity: quantity
                    }
                }).done(function(data) {
                    $(".cart-product").html(data);
                });
            };

            function updateCart_toltals(p_id) {
                var action = 'update-totalcart';
                var id = p_id;
                var quantity = 0;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        action: action,
                        id: id,
                        quantity: quantity
                    }
                }).done(function(data) {
                    $(".total-price").html(data);
                });
            };
        </script>
        <script>
            function addFunction(p_id) {
                var id = p_id;
                var action = 'add';
                var quantity = 1;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: id,
                        action: action,
                        quantity: quantity
                    }
                }).done(function(data) {
                    $(".cart-body").html(data);
                    updateCartcount(id, 'update');
                    updateMiniCart(id);
                    updateCart_toltals(id);
                });
            };

            function addFunctionMultiple(p_id, quantity) {
                var id = p_id;
                var action = 'add';
                var quantity = quantity;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: id,
                        action: action,
                        quantity: quantity
                    }
                }).done(function(data) {
                    $(".cart-body").html(data);
                    updateCartcount(id, 'update');
                    updateMiniCart(id);
                    updateCart_toltals(id);
                });
            };



            $('.update-btn').click(function() {
                var elements = $('.product-quantity input[name="qtt_up[]"]'),
                    qtt_up = [];
                for (var i = 0; i < elements.length; i++) {
                    var element = $(elements[i]);
                    var value = element.val();
                    qtt_up.push(JSON.stringify(
                        value
                    ));
                };
                var get_id = $('.product-info input[name="id_up[]"]'),
                    id_up = [];
                for (var i = 0; i < get_id.length; i++) {
                    var element = $(get_id[i]);
                    var value = element.val()
                    id_up.push(JSON.stringify(
                        value
                    ));
                };

                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        'qtt_up[]': qtt_up,
                        'id_up[]': id_up,
                        action: 'update'
                    }
                }).done(function(data) {
                    $(".total-price").html(data);
                    show_me_sub_price_now();
                    refreshMinicart();
                });
            });

            function show_me_sub_price_now() {
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        action: 'update-after-update'
                    }
                }).done(function(data) {
                    $(".cart-body").html(data);
                })
            };

            function refreshMinicart() {
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        action: 'refresh-mini-cart'
                    }
                }).done(function(data) {
                    $(".cart-product").html(data);
                });
            };
        </script>
        <script>
            function addToFav(product_id, customer_id, method) {
                var p_id = product_id;
                var c_id = customer_id;
                var method = method;
                var action = 'add-to-favorites';
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        id: p_id,
                        cid: c_id,
                        action: action,
                        method: method,

                    }
                }).done(function(data) {
                    $(".test").html(data);
                });
                if (method == 'like') {
                    changeFavBtn(p_id, c_id, 'like');
                    $.ajax({
                        url: 'xulicart-ajax.php',
                        dataType: 'html',
                        type: 'GET',
                        data: {
                            id: p_id,
                            cid: c_id,
                            action: 'update-fav'
                        }
                    }).done(function(data) {
                        $(".fav-card").html(data);
                    });
                } else {
                    changeFavBtn(p_id, c_id, 'unlike');
                    $.ajax({
                        url: 'xulicart-ajax.php',
                        dataType: 'html',
                        type: 'GET',
                        data: {
                            id: p_id,
                            cid: c_id,
                            action: 'update-fav'
                        }
                    }).done(function(data) {
                        $(".fav-card").html(data);
                    });
                };
            };

            function changeFavBtn(p_id, c_id, method) {
                var p_id = p_id;
                var c_id = c_id;
                var action = 'change-fav-btn';
                var method = method;
                var location = location;
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    data: {
                        p_id: p_id,
                        c_id: c_id,
                        action: action,
                        method: method,
                    }
                }).done(function(data) {
                    var thisbtn = document.getElementsByName("p" + p_id);
                    $(thisbtn).parent().html(data);
                });

            };

            function clearCart() {
                var action = 'clear';
                $.ajax({
                    url: 'xulicart-ajax.php',
                    type: 'GET',
                    data: {
                        action: action
                    }
                }).done(function() {
                    var select = document.getElementsByName("id_up[]");
                    $(select).parent().remove();
                    var afterclear = 0;
                    $("#cart-count").html(afterclear);
                    $("#big-cart-count").html(afterclear);
                    $(".total-price").html(afterclear + " Đ")
                });
            };
        </script>
        </head>
        <!-- main-menu-area-end -->
    </header>