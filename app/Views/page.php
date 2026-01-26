<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $page['teks'] ?> - Lombok Biking Tour</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?= base_url('assets/themes/vendor/magnific-popup/magnific-popup.css') ?>" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?= base_url('assets/themes/css/creative.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/themes/css/package-cards.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    
    <style>

    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?= base_url() ?>">
                <img height="40" src="<?= base_url('assets/themes/img/Logo.png') ?>"><span class="align-bottom">&nbsp; Lombok Biking Tour</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#package">Package</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#galery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <!-- Page Header -->
    <section class="page-section bg-success" id="page-header" 
        style="padding-top: 3rem; padding-bottom: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                     
                </div>
            </div>
        </div>
    </section>

    <!-- Page Content -->
    <section class="page-content">
        <div class="container mb-5">
            <h2 class="text-uppercase font-weight-bold text-primary pt-4"><?= $page['teks'] ?></h2>
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a class="text-primary" href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page"><?= $page['teks'] ?></li>
                </ol>
            </nav>

            <div class="row justify-content-center pb-5">
                <div class="col-lg-12">
                     <div class="ck-content">
                        <?= $page['other_teks'] ?>
                     </div>
                </div>
            </div>
            

        </div>
    </section>

    <!-- Footer -->
    <?php
        $addr_email = '';
        $addr_telp = '';
        $addr_wa = '';
        $addr_location = '';
        
        if (isset($value) && is_array($value)) {
            foreach ($value as $item) {
                if (isset($item['kd_teks'])) {
                    if ($item['kd_teks'] == "addr_email_01") {
                        $addr_email = $item['teks'] ?? '';
                    } else if ($item['kd_teks'] == "addr_telp_01") {
                        $addr_telp = $item['teks'] ?? '';
                    } else if ($item['kd_teks'] == "addr_wa_01") {
                        $addr_wa = $item['teks'] ?? '';
                    } else if ($item['kd_teks'] == "Footer01") {
                        $addr_location = $item['teks'] ?? '';
                    }
                }
            }
        }
    ?>
    <footer class="bg-light py-5">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Lombok Biking Tour</h4>
                    <p class="text-muted mb-0">Experience the best biking adventures in Lombok with our professional guides and top-quality equipment.</p>                    
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>#page-top">Home</a></li>
                        <li><a href="<?= base_url() ?>#package">Packages</a></li>
                        <li><a href="<?= base_url() ?>#galery">Gallery</a></li>
                        <li><a href="<?= base_url() ?>#contact">Contact</a></li>   
                        <li><a href="<?= base_url('page/payment') ?>">Payment</a></li>
                        <li><a href="<?= base_url('page/privacy-policy') ?>">Privacy Policy</a></li>
                        <li><a href="<?= base_url('page/term-of-use') ?>">Term of Use</a></li>
                        <li><a href="<?= base_url('page/faq') ?>">FAQ</a></li>                        
                    </ul>
                </div>
                <div class="col-lg-3 ">
                    <h4 class="text-uppercase mb-4">Follow Us</h4>
                    <a class="footer-social-link" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="footer-social-link" href="#"><i class="fa fa-instagram"></i></a>
                    <a class="footer-social-link" href="#"><i class="fa fa-twitter"></i></a>                    
                </div>                
            </div>
            
            <div class="small text-center text-muted mt-5 ">
                Copyright &copy; 2026 - LombokBikingTour.com<br>
                <span class="d-block mt-2">
                    <?php if ($addr_telp): ?>Phone: <?= $addr_telp ?> | <?php endif; ?>
                    <?php if ($addr_wa): ?>WhatsApp: <?= $addr_wa ?> | <?php endif; ?>
                    <?php if ($addr_email): ?>Email: <?= $addr_email ?> | <?php endif; ?>
                    <?php if ($addr_location): ?>Address: <?= $addr_location ?><?php endif; ?>
                </span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/themes/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/js/creative.js') ?>"></script>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    
    <script>
        // Scroll to top button visibility
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        // Smooth scroll for scroll to top
        $('.scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 1000, 'easeInOutExpo');
        });
    </script>
</body>
</html>
