<?php include 'header.php' ?>

<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#" class="active">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!-- contact-area-start -->
<div class="contact-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="contact-info">
                    <h3>Thông Tin Liên Hệ</h3>
                    <ul>
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <span>Địa chỉ: </span>
                            Trường Đại học Công nghệ Thông tin ĐHQG TP.HCM, khu phố 6, Linh Trung, Thủ Đức, Ho Chi Minh City
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <span>Email: </span>
                            <a href="#">bookstore@gmail.com</a>
                        </li>
                        <li>
                            <i class="fa fa-mobile"></i>
                            <span>Phone: </span>
                            (+84) 858941658
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area-end -->
<!-- googleMap-area-start -->
<div class="map-area mb-70">
    <div class="container">
        <div class="row">
            <p>Xem bản đồ chỉ dẫn địa chỉ của chúng tôi:</p>
            <div class="col-lg-12">
                <div id="map" class="text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.2324288146733!2d106.80161941411605!3d10.869918392258132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527587e9ad5bf%3A0xafa66f9c8be3c91!2sUniversity%20of%20Information%20Technology%20VNU-HCM!5e0!3m2!1sen!2s!4v1593865278777!5m2!1sen!2s" width="97%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- googleMap-end -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMlLa3XrAmtemtf97Z2YpXwPLlimRK7Pk"></script>
<script>
    /* Google Map js */
    function initialize() {
        var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: new google.maps.LatLng(23.810332, 90.412518)
        };

        var map = new google.maps.Map(document.getElementById('googleMap'),
            mapOptions);

        var marker = new google.maps.Marker({
            position: map.getCenter(),
            animation: google.maps.Animation.BOUNCE,
            icon: 'img/map.png',
            map: map
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php include 'footer.php' ?>