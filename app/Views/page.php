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
    <?= view('layout/navbar') ?>

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
                     <?php if (!empty($page['img'])): ?>
                        <div class="text-center mb-4">
                            <img src="<?= base_url('assets/themes/images/' . $page['img']) ?>" class="img-fluid rounded shadow" alt="<?= $page['teks'] ?>">
                        </div>
                     <?php endif; ?>
                     <div class="ck-content">
                        <?= $page['other_teks'] ?>
                     </div>
                </div>
            </div>
            

        </div>
    </section>

    <!-- Footer -->
    <?= view('layout/footer', ['value' => $value ?? []]) ?>

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
