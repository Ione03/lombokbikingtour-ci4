<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $page['teks'] ?> - Lombok Biking Tour</title>

    <!-- Font Awesome Icons -->
    <link href="<?= base_url('assets/themes/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?= base_url('assets/themes/vendor/magnific-popup/magnific-popup.css') ?>" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?= base_url('assets/themes/css/creative.min.css') ?>" rel="stylesheet">
    
    <style>
        .page-header {
            padding-top: 10rem;
            padding-bottom: 5rem;
            background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("<?= !empty($page['img']) ? base_url('assets/themes/images/'.$page['img']) : base_url('assets/themes/images/bg-masthead.jpg') ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
        .page-content {
            padding: 5rem 0;
            min-height: 50vh;
        }
    </style>
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?= base_url() ?>">Lombok Biking Tour</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>#package">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>#galery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header text-center text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <h1 class="text-uppercase font-weight-bold"><?= $page['teks'] ?></h1>
                     <hr class="divider my-4">
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <?= $page['other_teks'] ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">
                Copyright &copy; 2026 - LombokBikingTour.com<br>
                <a href="<?= base_url() ?>">Back to Home</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/themes/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/js/creative.min.js') ?>"></script>

</body>
</html>
