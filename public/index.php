<?php require('includes/header.php') ?>
<?php require('includes/navbar.php') ?>

<div class="call_text_main">
    <div class="container">
        <div class="call_taital">
            <div class="call_text"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span
                            class="padding_left_15">Pokhara </span></a></div>
            <div class="call_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span
                            class="padding_left_15">9825189079</span></a></div>
            <div class="call_text"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span
                            class="padding_left_15">vehiclehub@gmail.com</span></a></div>
        </div>
    </div>
</div>
<!-- banner section start -->
<div class="banner_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="banner_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="banner_taital_main">
                                <h1 class="banner_taital">Vehicle Rental <br><span style="color: #fe5b29;">For You</span></h1>
                                <p class="banner_text">There are variety of vehicle with us you can rent your desried vehicle</p>
                                <div class="btn_main">
                                    <div class="contact_bt"><a href="#">Read More</a></div>
                                    <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_taital_main">
                                <h1 class="banner_taital">Vehicle Rental <br><span style="color: #fe5b29;">For You</span></h1>
                                <p class="banner_text">
                                There are variety of vehicle with us you can rent your desried vehicle</p>
                                <div class="btn_main">
                                    <div class="contact_bt"><a href="#">Read More</a></div>
                                    <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_taital_main">
                                <h1 class="banner_taital">Vehicle Rental <br><span style="color: #fe5b29;">For You</span></h1>
                                <p class="banner_text">There are variety of vehicle with us you can rent your desried vehicle</p>
                                <div class="btn_main">
                                    <div class="contact_bt"><a href="#">Read More</a></div>
                                    <div class="contact_bt active"><a href="#">Contact Us</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner_img"><img src="images/banner-img.png"></div>
            </div>
        </div>
    </div>
</div>
<!-- banner section end -->

<!-- about section start -->
<div class="about_section layout_padding">
    <div class="container">
        <div class="about_section_2">
            <div class="row">
                <div class="col-md-6">
                    <div class="image_iman"><img src="images/about-img.png" class="about_img"></div>
                </div>
                <div class="col-md-6">
                    <div class="about_taital_box">
                        <h1 class="about_taital">About <span style="color: #fe5b29;">Us</span></h1>
                        <p class="about_text">Welcome to our vehicle rental service, where convenience meets reliability. Whether you're exploring new horizons or just need a dependable ride, we offer a diverse fleet to suit every journey. Enjoy seamless booking, transparent pricing, and exceptional customer service. Your adventure starts here with us.</p>
                        <div class="readmore_btn"><a href="#">Read More</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about section end -->

<!-- gallery section start -->
<div class="gallery_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="gallery_taital">Our best offers</h1>
            </div>
        </div>
        <div class="gallery_section_2">
            <div class="row">
                <?php
                $vehicles = $connection->query("SELECT * FROM vehicles");
                $vehicles = mysqli_fetch_all($vehicles, MYSQLI_ASSOC);
                foreach ($vehicles as $vehicle):
                    if ($vehicle['is_available']):
                        ?>
                        <div class="col-md-4">
                            <div class="gallery_box">
                                <div class="gallery_img"><img src="uploads/<?= $vehicle['image'] ?>"></div>
                                <h3 class="types_text"><?= $vehicle['name'] ?></h3>
                                <p class="looking_text">Start per hour Rs. <?= $vehicle['price_per_hour'] ?></p>
                                <div class="read_bt"><a href="vehicle-detail.php?id=<?= $vehicle['id'] ?>">Book Now</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- gallery section end -->
<!-- choose section start -->
<div class="choose_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="choose_taital">WHY CHOOSE US</h1>
            </div>
        </div>
        <div class="choose_section_2">
            <div class="row">
                <div class="col-sm-4">
                    <div class="icon_1"><img src="images/icon-1.png"></div>
                    <h4 class="safety_text">SAFETY & SECURITY</h4>
                    <p class="ipsum_text">we look for your safety and SECURITY </p>
                </div>
                <div class="col-sm-4">
                    <div class="icon_1"><img src="images/icon-2.png"></div>
                    <h4 class="safety_text">Online Booking</h4>
                    <p class="ipsum_text">Easy online booking and payments </p>
                </div>
                <div class="col-sm-4">
                    <div class="icon_1"><img src="images/icon-3.png"></div>
                    <h4 class="safety_text">Best Offers</h4>
                    <p class="ipsum_text">Get best offers in vehicle Hub </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- choose section end -->

<!-- contact section start -->
<div class="contact_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="contact_taital">Get In Touch</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="contact_section_2">
            <div class="row">
                <div class="col-md-12">
                    <div class="mail_section_1">
                        <input type="text" class="mail_text" placeholder="Name" name="Name">
                        <input type="text" class="mail_text" placeholder="Email" name="Email">
                        <input type="text" class="mail_text" placeholder="Phone Number" name="Phone Number">
                        <textarea class="massage-bt" placeholder="Message" rows="5" id="comment"
                                  name="Massage"></textarea>
                        <div class="send_bt"><a href="#">Send</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact section end -->

<?php require('includes/footer.php') ?>
