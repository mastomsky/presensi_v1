<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title><?= ucfirst($judul) ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('landing') ?>/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('landing') ?>/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?= base_url('landing') ?>/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="<?= base_url('landing') ?>/images/cup-icon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('landing') ?>/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="<?= base_url('landing') ?>/css/owl.carousel.min.css">
    <link rel="stylesoeet" href="<?= base_url('landing') ?>/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="index.html"><img src="<?= base_url('landing') ?>/images/logo.png"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#">Home</a>
                    <a class="nav-item nav-link" href="#about">About</a>
                    <a class="nav-item nav-link" href="#testimonial">Testimonial</a>
                    <a class="nav-item nav-link" href="#contact">Contact</a>
                </div>
            </div>
        </nav>
        <!-- banner section end -->
        <div class="banner_section layout_padding">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Test of <span style="color: #f3801f;">Tea</span></h1>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="<?= base_url('landing') ?>/images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Test of <span style="color: #f3801f;">Tea</span></h1>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="<?= base_url('landing') ?>/images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Test of <span style="color: #f3801f;">Tea</span></h1>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="<?= base_url('landing') ?>/images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <div class="container">
            <div class="play_icon"><a href="#"><img src="<?= base_url('landing') ?>/images/play-icon.png"></a></div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- about section start -->
    <div class="about_section layout_padding" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="about_main">
                    <h1 class="about_taital">About Our</h1>
                    <p class="about_text">It is a long established fact that a reader will be It is a long
                        established fact that a reader will be It is a long established fact that a reader will be
                    </p>
                    <div class="readmore_bt"><a href="#">Read More</a></div>
                </div>
            </div>

        </div>
    </div>
    <!-- about section end -->
    <!-- clients section start -->
    <div class="clients_section layout_padding" id="testimonial">
        <div id="custum_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="clients_taital">Client's Testimonial</h1>
                        <p class="clients_text">Potential Clients are pouring our website on a daily basis after we use
                            Organic Visit, really recommended their great job!</p>
                        <div class="client_img"><img src="<?= base_url('landing/') ?>images/client-img.png"></div>
                        <h1 class="louis_text">Louis Gilyard</h1>
                        <h1 class="smyth_text">SMYTH</h1>
                        <div class="border"></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="clients_taital">Client's Testimonial</h1>
                        <p class="clients_text">Potential Clients are pouring our website on a daily basis after we use
                            Organic Visit, really recommended their great job!</p>
                        <div class="client_img"><img src="images/client-img.png"></div>
                        <h1 class="louis_text">Louis Gilyard</h1>
                        <h1 class="smyth_text">SMYTH</h1>
                        <div class="border"></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <h1 class="clients_taital">Client's Testimonial</h1>
                        <p class="clients_text">Potential Clients are pouring our website on a daily basis after we use
                            Organic Visit, really recommended their great job!</p>
                        <div class="client_img"><img src="images/client-img.png"></div>
                        <h1 class="louis_text">Louis Gilyard</h1>
                        <h1 class="smyth_text">SMYTH</h1>
                        <div class="border"></div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#custum_slider" role="button" data-slide="next">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#custum_slider" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!-- contact section start -->
    <div class="contact_section layout_padding" id="contact">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="mail_main">
                        <h1 class="contact_taital">Contact us</h1>
                        <form action="/action_page.php">
                            <div class="form-group">
                                <input type="text" class="email-bt" placeholder="Name" name="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="email-bt" placeholder="Email" name="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="email-bt" placeholder="Subject" name="Email">
                            </div>
                            <div class="form-group">
                                <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment"
                                    name="text"></textarea>
                            </div>
                        </form>
                        <div class="send_btn">
                            <div class="main_bt"><a href="#">Send</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France"
                                width="600" height="600" frameborder="0" style="border:0; width: 100%;"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="newsletter_section">
                <div class="newsletter_left">
                    <div class="footer_logo"><img src="<?= base_url('landing') ?>/images/footer-logo.png"></div>
                </div>
                <div class="newsletter_right">
                    <h5 class="newsletter_taital">Subscribe Newsletter</h5>
                    <div class="subscribe_main">
                        <input type="text" class="mail_text" placeholder="Enter your email" name="text">
                        <div class="subscribe_bt"><a href="#">Subscribe</a></div>
                    </div>
                </div>
            </div>
            <div class="footer_taital_main">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <h2 class="useful_text">About</h2>
                        <p class="ipsum_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation u</p>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h2 class="useful_text">Menus</h2>
                        <div class="footer_links">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="services.html">Services</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h2 class="useful_text">Useful Link</h2>
                        <div class="footer_links">
                            <ul>
                                <li><a href="#">Adipiscing</a></li>
                                <li><a href="#">Elit, sed do</a></li>
                                <li><a href="#">Eiusmod </a></li>
                                <li><a href="#">Tempor </a></li>
                                <li><a href="#">incididunt</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h2 class="useful_text">Contact us</h2>
                        <div class="addres_link">
                            <ul>
                                <li><a href="#"><img src="<?= base_url('landing') ?>/images/map-icon.png"><span
                                            class="padding_left_10">No.123 Chalingt
                                            Gates</span></a></li>
                                <li><a href="#"><img src="<?= base_url('landing') ?>/images/call-icon.png"><span
                                            class="padding_left_10">+01
                                            1234567890</span></a></li>
                                <li><a href="#"><img src="<?= base_url('landing') ?>/images/mail-icon.png"><span
                                            class="padding_left_10">demo@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h1 class="follow_text">Follow Us</h1>
                <div class="social_icon">
                    <ul>
                        <li><a href="#"><img src="<?= base_url('landing') ?>/images/fb-icon.png"></a></li>
                        <li><a href="#"><img src="<?= base_url('landing') ?>/images/twitter-icon.png"></a></li>
                        <li><a href="#"><img src="<?= base_url('landing') ?>/images/linkedin-icon.png"></a></li>
                        <li><a href="#"><img src="<?= base_url('landing') ?>/images/instagram-icon.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="<?= base_url('landing') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('landing') ?>/js/popper.min.js"></script>
    <script src="<?= base_url('landing') ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('landing') ?>/js/jquery-3.0.0.min.js"></script>
    <script src="<?= base_url('landing') ?>/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="<?= base_url('landing') ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url('landing') ?>/js/custom.js"></script>
    <!-- javascript -->
    <script src="<?= base_url('landing') ?>/js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function() {
            $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function() {
            $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function() {
            $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
    </script>
</body>

</html>