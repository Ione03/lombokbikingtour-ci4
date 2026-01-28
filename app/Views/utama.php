<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lombok Biking Tour</title>
    
    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Lombok Biking Tour - Explore Lombok on Two Wheels">
    <meta property="og:description" content="Experience the best biking adventures in Lombok with professional guides and top-quality equipment. Discover scenic routes and beautiful landscapes.">
    <meta property="og:image" content="<?= base_url('assets/themes/img/Logo.png') ?>">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Lombok Biking Tour">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Lombok Biking Tour - Explore Lombok on Two Wheels">
    <meta name="twitter:description" content="Experience the best biking adventures in Lombok with professional guides and top-quality equipment.">
    <meta name="twitter:image" content="<?= base_url('assets/themes/img/Logo.png') ?>">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Plugin CSS -->
    <link href="<?= base_url('assets/themes/vendor/magnific-popup/magnific-popup.css') ?>" rel="stylesheet">
    
    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?= base_url('assets/themes/css/creative.css') ?>" rel="stylesheet">
    
    <!-- Slideshow CSS -->
    <link href="<?= base_url('assets/themes/css/slideshow.css') ?>" rel="stylesheet">
    
    <!-- Package Cards CSS -->
    <link href="<?= base_url('assets/themes/css/package-cards.css') ?>" rel="stylesheet">

    <!-- Custom Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body, h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Poppins', sans-serif !important;
        }
        p, .text-muted, .card-text, small {
            font-family: 'Inter', sans-serif !important;
        }

        /* Prevent modal flicker - keep scrollbar always visible */
        html {
            overflow-y: scroll;
        }
        
        /* CRITICAL: Prevent Bootstrap AND Magnific Popup from hiding scrollbar */
        body {
            overflow: visible !important;
        }
        
        /* Prevent Bootstrap from adding padding when modal opens */
        body.modal-open,
        .modal-open .modal {
            padding-right: 0 !important;
        }
        
        /* Modal scrolls internally when content overflows */
        .modal-dialog {
            max-height: 90vh;
            margin: 1.75rem auto;
        }
        
        .modal-content {
            max-height: 90vh;
        }
        
        .modal-body {
            overflow-y: auto;
            max-height: calc(90vh - 120px); /* Account for header and footer */
        }
        
        /* Scroll hint animation */
        @keyframes scrollBounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(10px);
            }
            60% {
                transform: translateY(5px);
            }
        }
        
        .modal-body.scroll-hint {
            animation: scrollBounce 2s ease-in-out;
        }
        
        /* Parallax section styling */
        .parallax-section {
            position: relative;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .parallax-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(211, 47, 47, 0.85); /* Primary color overlay */
            z-index: 0;
        }
        
        /* Video Gallery Styles */
        .video-box {
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }
        
        .video-play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            z-index: 2;
        }
        
        .video-box:hover .video-play-overlay {
            color: #d32f2f;
            transform: translate(-50%, -50%) scale(1.2);
        }
        
        .video-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease;
        }
        
        .video-box:hover::after {
            background: rgba(0, 0, 0, 0.5);
        }
        
        /* Contact form styles */
        .contact-info a.btn-link {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
        }
        
        .contact-info a.btn-link:hover {
            color: #d32f2f;
        }
    </style>
    

</head>

<body id="page-top">
    <!-- Navigation -->
    <?= view('layout/navbar') ?>

    <!-- Masthead Slideshow -->
    <?php // ... (keep masthead logic) ?>
    <?php
        $teks_01 = '';
        $teks_other_01 = '';
        
        if (isset($value) && is_array($value)) {
            foreach ($value as $item) {
                if (isset($item['kd_teks']) && $item['kd_teks'] == "T01") {
                    $teks_01 = $item['teks'] ?? '';
                    $teks_other_01 = $item['other_teks'] ?? '';
                    break;
                }
            }
        }
    ?>
    

    <?php
        $slides = [];
        if (isset($value) && is_array($value)) {
            foreach ($value as $item) {
                if (isset($item['status']) && $item['status'] == "7") {
                    $slides[] = $item;
                }
            }
        }
        
        // If no dynamic slides, use default hardcoded ones
        $use_default = empty($slides);
    ?>

    <header class="masthead-slideshow">
        <?php if ($use_default): ?>
            <!-- Default Slide 1 -->
            <div class="masthead-slide active" style="background-image: linear-gradient(to bottom, rgba(92,245,255,0.2) 0%, rgba(92, 77, 66, 0.5) 100%), url('<?= base_url('assets/themes/images/slider-image1.jpg') ?>');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center text-center">
                        <div class="col-lg-10 align-self-end">
                            <h1 class="text-white font-weight-bold"><?= $teks_01 ?: 'Lombok Biking Tour' ?></h1>
                            <hr class="divider my-4">
                        </div>
                        <div class="col-lg-8 align-self-baseline">
                            <p class="text-white-75 font-weight-light mb-5"><?= $teks_other_01 ?: 'Experience the beauty of Lombok on two wheels' ?></p>
                            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#package">Find Out More</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Default Slide 2 -->
            <div class="masthead-slide" style="background-image: linear-gradient(to bottom, rgba(92,245,255,0.2) 0%, rgba(92, 77, 66, 0.5) 100%), url('<?= base_url('assets/themes/images/slider-image2.jpg') ?>');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center text-center">
                        <div class="col-lg-10 align-self-end">
                            <h1 class="text-white font-weight-bold">Explore Lombok's Beauty</h1>
                            <hr class="divider my-4">
                        </div>
                        <div class="col-lg-8 align-self-baseline">
                            <p class="text-white-75 font-weight-light mb-5">Experience the amazing landscapes and culture of Lombok on two wheels</p>
                            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#package">View Packages</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Default Slide 3 -->
            <div class="masthead-slide" style="background-image: linear-gradient(to bottom, rgba(92,245,255,0.2) 0%, rgba(92, 77, 66, 0.5) 100%), url('<?= base_url('assets/themes/images/slider-image3.jpg') ?>');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center text-center">
                        <div class="col-lg-10 align-self-end">
                            <h1 class="text-white font-weight-bold">Adventure Awaits</h1>
                            <hr class="divider my-4">
                        </div>
                        <div class="col-lg-8 align-self-baseline">
                            <p class="text-white-75 font-weight-light mb-5">Join us for an unforgettable biking adventure through Lombok's scenic routes</p>
                            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#package">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($slides as $index => $slide): ?>
                <div class="masthead-slide <?= $index === 0 ? 'active' : '' ?>" style="background-image: linear-gradient(to bottom, rgba(92,245,255,0.2) 0%, rgba(92, 77, 66, 0.5) 100%), url('<?= base_url('assets/themes/images/' . $slide['img']) ?>');">                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center text-center">
                            <div class="col-lg-10 align-self-end">
                                <h1 class="text-white font-weight-bold"><?= $slide['teks'] ?? '' ?></h1>
                                <hr class="divider my-4">
                            </div>
                            <div class="col-lg-8 align-self-baseline">
                                <p class="text-white-75 font-weight-light mb-5"><?= strip_tags($slide['other_teks'] ?? '') ?></p>
                                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#package">Find Out More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <!-- Navigation Controls -->
        <button class="slideshow-control prev" onclick="changeSlide(-1)">
            <i class="fa fa-chevron-left"></i>
        </button>
        <button class="slideshow-control next" onclick="changeSlide(1)">
            <i class="fa fa-chevron-right"></i>
        </button>
        
        <!-- Slide Indicators -->
        <div class="slide-indicators">
            <?php if ($use_default): ?>
                <span class="indicator active" onclick="goToSlide(0)"></span>
                <span class="indicator" onclick="goToSlide(1)"></span>
                <span class="indicator" onclick="goToSlide(2)"></span>
            <?php else: ?>
                <?php foreach ($slides as $index => $slide): ?>
                    <span class="indicator <?= $index === 0 ? 'active' : '' ?>" onclick="goToSlide(<?= $index ?>)"></span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </header>

    <!-- Package Section -->
    <section class="page-section parallax-section" id="package" style="background-image: url('<?= base_url('assets/themes/images/paralax.1.jpg') ?>');">
        <div class="parallax-overlay"></div>
        <div class="container position-relative" style="z-index: 1;">
            <h2 class="text-center text-white mb-4">Our Tour Packages</h2>
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-4 text-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-light btn-sm" onclick="filterPackage(0)">All Packages</button>&nbsp;
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown">
                                Filter by Category
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(1)">Adventure Tour</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(2)">Half Day Biking Tour</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(3)">Full Day Biking Tour</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(4)">Long Route Bike</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(5)">Mountain Biking Tour</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(6)">Slope Rinjani Biking</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="filterPackage(7)">Combining Tour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row package-items">
                <?php if (isset($value) && is_array($value)): ?>
                    <?php foreach ($value as $item): ?>
                        <?php if (isset($item['status']) && $item['status'] == "5"): ?>
                        <?php
                            $tmp = $item['other_teks'] ?? '';
                            $arr = explode(" ", $tmp);
                            $tmp_text = implode(' ', array_slice($arr, 0, 40));
                        ?>
                        <div class="col-sm-6 col-lg-4 mb-4">
                            <div class="card package-card" 
                                 data-toggle="modal" 
                                 data-target="#packageModal"
                                 data-package-id="<?= $item['kd_teks'] ?>"
                                 data-package-title="<?= htmlspecialchars($item['teks']) ?>"
                                 data-package-description="<?= htmlspecialchars($item['other_teks'] ?? '') ?>"
                                 data-package-image="<?= base_url('assets/themes/images/' . $item['img']) ?>">
                                <div class="package-card-img-container">
                                    <img src="<?= base_url('assets/themes/images/' . $item['img']) ?>" class="package-card-img" alt="<?= htmlspecialchars($item['teks']) ?>">
                                    <span class="package-badge">#<?= $item['kd_teks'] ?></span>
                                </div>
                                <div class="card-body ck-content">
                                    <h5 class="card-title"><?= $item['teks'] ?></h5>
                                    <p class="card-text"><?= $tmp_text ?>...</p>
                                    <button class="btn btn-view-details">View Details</button>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> Updated <span class="human-date" data-date="<?= $item['last_update'] ?? '' ?>"><?= $item['last_update'] ?? 'recently' ?></span></small>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- Package Detail Modal -->
    <div class="modal fade package-modal" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Package Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 id="modalPackageTitle" class="mb-3"></h3>
                    <img src="" id="modalPackageImage" class="package-modal-img" alt="Package Image">
                    <div id="modalPackageDescription" class="ck-content" style="line-height: 1.8; color: #4a5568;"></div>
                    
                    <!-- Social Share Buttons -->
                    <div class="text-center my-4">
                        <p class="mb-2"><strong>Share this package:</strong></p>
                        <button class="btn btn-success btn-sm" onclick="sharePackage('whatsapp')" title="Share on WhatsApp">
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="sharePackage('facebook')" title="Share on Facebook">
                            <i class="fa fa-facebook"></i> Facebook
                        </button>
                        <button class="btn btn-info btn-sm" onclick="sharePackage('twitter')" title="Share on Twitter">
                            <i class="fa fa-twitter"></i> Twitter
                        </button>
                        <button class="btn btn-secondary btn-sm" onclick="sharePackage('copy')" title="Copy Link">
                            <i class="fa fa-link"></i> Copy Link
                        </button>
                    </div>
                    
                    <hr>
                    <h5 class="mt-4">Book This Tour</h5>
                    <form id="bookingForm">
                        <div class="form-group">
                            <label for="bookDate">Date of Tour</label>
                            <input type="date" class="form-control" id="bookDate" onkeydown="return false;" onclick="openDatePicker(this)" style="cursor: pointer; max-width: 250px;" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bikeType">Bike Type</label>
                                <select id="bikeType" class="form-control">
                                    <option>Mountain Bike</option>
                                    <option>Road Bike</option>
                                    <option>Hybrid Bike</option>
                                    <option>E-Bike</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bikeNumber">Number of Bikes</label>
                                <input type="number" class="form-control" id="bikeNumber" min="1" value="1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bookNote">Note</label>
                            <textarea class="form-control" id="bookNote" rows="3" placeholder="Additional requirements..."></textarea>
                        </div>
                        
                        <!-- Captcha for Booking Modal -->
                        <div class="form-group">
                            <label>Verify you are human</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="modal-captcha-question"></span>
                                </div>
                                <input type="number" class="form-control" id="modal-captcha" placeholder="Enter result" required>
                                <input type="hidden" id="modal-captcha-answer">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="sendBookingWA()">
                        <i class="fa fa-whatsapp"></i> Book via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <?php 
        // Find Story01 from the value array
        $story01 = null;
        if (isset($value) && is_array($value)) {
            foreach ($value as $item) {
                if (isset($item['kd_teks']) && $item['kd_teks'] == 'Story01') {
                    $story01 = $item;
                    break;
                }
            }
        }
        
        // Default values if Story01 not found
        $aboutTitle = $story01['teks'] ?? 'About Lombok Biking Tour';
        $aboutText = $story01['other_teks'] ?? 'Welcome to Lombok Biking Tour! Experience the amazing landscapes and culture of Lombok on two wheels.';
        $aboutImage = $story01['img'] ?? 'about_us.png';
    ?>
    <section class="page-section" id="about">
        <div class="container">
            <h2 class="text-center mt-0"><?= htmlspecialchars($aboutTitle) ?></h2>
            <hr class="divider my-3">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-12 mb-3">
                    <img src="<?= base_url('assets/themes/images/' . $aboutImage) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($aboutTitle) ?>">
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="text-muted">
                        <?= nl2br(htmlspecialchars($aboutText)) ?>
                    </div>
                    <a class="btn btn-primary btn-xl mt-4 js-scroll-trigger" href="#package">Explore Our Tours</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <section id="galery" class="page-section">
        <div class="container-fluid p-0">
            <h2 class="text-center mt-4 mb-4">Photo & Video Gallery</h2>
            <hr class="divider my-3">
            <div class="row no-gutters">
                <?php 
                // Gallery items from database
                $gallery_count = 0;
                if (isset($value) && is_array($value)) {
                    foreach ($value as $item) {
                        if (isset($item['status']) && $item['status'] == "1") {
                            $gallery_img = $item['img'] ?? '';
                            $gallery_title = $item['teks'] ?? '';
                            $gallery_desc = $item['other_teks'] ?? '';
                            
                            // Check if it's a YouTube video (if other_teks contains youtube URL)
                            $isVideo = strpos($gallery_desc, 'youtube.com') !== false || strpos($gallery_desc, 'youtu.be') !== false;
                            
                            if ($isVideo && $gallery_desc) {
                                // Extract YouTube ID and create embed
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $gallery_desc, $match);
                                $youtube_id = $match[1] ?? '';
                                
                                if ($youtube_id) {
                                    echo '<div class="col-lg-4 col-sm-6">';
                                    echo '   <div  class="portfolio-box video-box" data-video-id="' . $youtube_id . '">';
                                    echo '     <img class="img-fluid" src="https://img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg" alt="' . htmlspecialchars($gallery_title) . '">';
                                    echo '     <div class="video-play-overlay">';
                                    echo '       <i class="fa fa-play-circle fa-5x"></i>';
                                    echo '     </div>';
                                    echo '     <div class="portfolio-box-caption">';
                                    echo '       <div class="project-category text-white-50">';
                                    echo '         Video';
                                    echo '       </div>';
                                    echo '       <div class="project-name">';
                                    echo '         ' . $gallery_title;
                                    echo '       </div>';
                                    echo '     </div>';
                                    echo '   </div>';
                                    echo '</div>';
                                    $gallery_count++;
                                }
                            } else if ($gallery_img) {
                                // Regular image
                                echo '<div class="col-lg-4 col-sm-6">';
                                echo '   <a class="portfolio-box" href="' . base_url('assets/themes/images/' . $gallery_img) . '">';
                                echo '     <img class="img-fluid" src="' . base_url('assets/themes/images/' . $gallery_img) . '" alt="' . htmlspecialchars($gallery_title) . '">';
                                echo '     <div class="portfolio-box-caption">';
                                echo '       <div class="project-category text-white-50">';
                                echo '         ' . $gallery_title;
                                echo '       </div>';
                                echo '       <div class="project-name">';
                                echo '         ' . $gallery_desc;
                                echo '       </div>';
                                echo '     </div>';
                                    echo '   </a>';
                                echo '</div>';
                                $gallery_count++;
                            }
                        }
                    }
                }
                
                // Add sample gallery items if none from database
                if ($gallery_count == 0) {
                    for ($i = 1; $i <= 6; $i++) {
                        echo '<div class="col-lg-4 col-sm-6">';
                        echo '   <a class="portfolio-box" href="' . base_url("assets/themes/images/gallery-$i.jpg") . '">';
                        echo '     <img class="img-fluid" src="' . base_url("assets/themes/images/gallery-$i.jpg") . '" alt="Gallery Image ' . $i . '">';
                        echo '     <div class="portfolio-box-caption">';
                        echo '       <div class="project-category text-white-50">Photo Gallery</div>';
                        echo '       <div class="project-name">Experience Lombok</div>';
                        echo '     </div>';
                        echo '   </a>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Testimonies Section -->
    <section id="testimonials" class="page-section bg-light">
        <div class="container">
            <h2 class="text-center mt-0">Testimonials</h2>
            <hr class="divider my-3">
            <?php
            $testimonies = [];
            if (isset($value) && is_array($value)) {
                foreach ($value as $item) {
                    if (isset($item['status']) && $item['status'] == "2") {
                        $testimonies[] = $item;
                    }
                }
            }
            ?>

            <?php if (count($testimonies) > 0): ?>
                <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($testimonies as $index => $item): ?>
                            <?php
                                $test_name = $item['teks'] ?? 'Client';
                                $test_content = $item['other_teks'] ?? ''; // Allows HTML
                                $test_img = $item['img'] ?? '';
                                $img_src = $test_img ? base_url('assets/themes/images/' . $test_img) : 'https://ui-avatars.com/api/?name=' . urlencode($test_name) . '&size=120&background=d32f2f&color=fff';
                            ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 text-center">
                                        <div class="d-flex justify-content-center mb-4">
                                             <img src="<?= $img_src ?>" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover;" alt="<?= htmlspecialchars($test_name) ?>">
                                        </div>
                                        <h5 class="mb-3 font-weight-bold"><?= htmlspecialchars($test_name) ?></h5>
                                        <div class="testimonial-content text-muted">
                                            <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                            <div class="font-italic ck-content" style="font-size: 1.1rem; line-height: 1.8;">
                                                <?= $test_content ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($testimonies) > 1): ?>
                        <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true" style="padding: 20px;"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true" style="padding: 20px;"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="col-lg-12 text-center text-muted">
                    <p>No testimonials yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- YouTube Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="videoIframe" class="embed-responsive-item" src="" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Section -->
    <?php
        $contact_title = 'Get In Touch';
        $contact_desc = 'Ready to start your next adventure with us? Send us a message and we will get back to you as soon as possible!';
        $addr_email = '';
        $addr_telp = '';
        $addr_wa = '';
        $addr_location = '';
        $addr_email_other = '';
        $addr_telp_other = '';
        $addr_wa_other = '';
        $addr_location_other = '';
        
        if (isset($value) && is_array($value)) {
            foreach ($value as $item) {
                if (isset($item['kd_teks'])) {
                    if ($item['kd_teks'] == "contact01") {
                        $contact_title = $item['teks'] ?? $contact_title;
                        $contact_desc = $item['other_teks'] ?? $contact_desc;
                    } else if ($item['kd_teks'] == "addr_email_01") {
                        $addr_email = $item['teks'] ?? '';
                        $addr_email_other = $item['other_teks'] ?? '';
                    } else if ($item['kd_teks'] == "addr_telp_01") {
                        $addr_telp = $item['teks'] ?? '';
                        $addr_telp_other = $item['other_teks'] ?? '';
                    } else if ($item['kd_teks'] == "addr_wa_01") {
                        $addr_wa = $item['teks'] ?? '';
                        $addr_wa_other = $item['other_teks'] ?? '';
                    } else if ($item['kd_teks'] == "Footer01") {
                        $addr_location = $item['teks'] ?? '';
                        $addr_location_other = $item['other_teks'] ?? '';
                    }
                }
            }
        }
    ?>
    
    <section id="contact" class="page-section">
        <div class="container">
            <!-- Map Row (Moved Here) -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="mt-0 text-center">Find Us On Map</h2>
                    <hr class="divider my-3">
                </div>
                <div class="col-lg-12">
                     <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15783.567117173266!2d116.089856!3d-8.510000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMzAnMzYuMCJTIDExNsKwMDUnMjMuNSJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
                                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0 text-center"><?= $contact_title ?></h2>
                    <hr class="divider my-3">
                    <p class="text-muted mb-5"><?= $contact_desc ?></p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <!-- Contact Form -->
                    <form action="#" id="form_feedback">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <input type="text" class="form-control" id="cf-name" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <input type="email" class="form-control" id="cf-email" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <input type="text" class="form-control" id="cf-subject" name="title" placeholder="Subject" required>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <textarea class="form-control" rows="6" id="cf-message" name="message" placeholder="Tell us about your holiday planning" required></textarea>
                            </div>
                            
                            <!-- Captcha for Contact Form -->
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label class="text-white small mb-1" style="display:block;">Verify you are human:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="captcha-question" style="background:#d32f2f; color:white; min-width:80px; justify-content:center;">? + ?</span>
                                    </div>
                                    <input type="number" class="form-control" id="cf-captcha" placeholder="Total?" required style="height:auto;">
                                </div>
                                <input type="hidden" id="cf-captcha-answer">
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <button type="button" class="btn btn-primary btn-block" id="cf-submit" onclick="sendFeedback()">
                                    <i class="fa fa-whatsapp"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-4 col-sm-12 mt-4 mt-md-0">
                    <div class="contact-info">
                        <?php if ($addr_telp): ?>
                        <div class="mb-4">
                            <a href="tel:<?= $addr_telp_other ?>" class="btn-link d-block">
                                <i class="fa fa-phone fa-2x mb-2 text-primary"></i>
                                <p><?= $addr_telp ?></p>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($addr_wa): ?>
                        <div class="mb-4">
                            <input type="hidden" id="waNumber2" value="<?= $addr_wa_other ?>">
                            <a href="javascript:void(0)" onclick="openWA2()" class="btn-link d-block">
                                <i class="fa fa-whatsapp fa-2x mb-2 text-primary"></i>
                                <p><?= $addr_wa ?></p>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($addr_email): ?>
                        <div class="mb-4">
                            <a href="mailto:<?= $addr_email_other ?>" class="btn-link d-block">
                                <i class="fa fa-envelope fa-2x mb-2 text-primary"></i>
                                <p><?= $addr_email ?></p>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($addr_location): ?>
                        <div class="mb-4">
                            <a href="<?= $addr_location_other ?>" target="_blank" class="btn-link d-block">
                                <i class="fa fa-map-marker fa-2x mb-2 text-primary"></i>
                                <p><?= $addr_location ?></p>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= view('layout/footer', ['value' => $value]) ?>

    <!-- Scripts -->
    <script src="<?= base_url('assets/themes/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/magnific-popup/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/js/creative.js') ?>"></script>
    
    <!-- Moment.js for date formatting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    
    <!-- Slideshow Script -->
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.masthead-slide');
        const indicators = document.querySelectorAll('.indicator');
        let slideInterval;
        
        function showSlide(index) {
            // Remove active class from all slides and indicators
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            // Wrap around if index is out of bounds
            if (index >= slides.length) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slides.length - 1;
            } else {
                currentSlide = index;
            }
            
            // Add active class to current slide and indicator
            slides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
        }
        
        function changeSlide(direction) {
            showSlide(currentSlide + direction);
            resetInterval();
        }
        
        function goToSlide(index) {
            showSlide(index);
            resetInterval();
        }
        
        function autoSlide() {
            showSlide(currentSlide + 1);
        }
        
        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(autoSlide, 5000);
        }
        
        // Start automatic slideshow (change slide every 5 seconds)
        slideInterval = setInterval(autoSlide, 5000);
    </script>
    
    <!-- Package Modal Script -->
    <script>
        // Human-readable date formatting function
        function formatHumanDate() {
            $('.human-date').each(function() {
                var dateStr = $(this).data('date');
                if (dateStr) {
                    var humanDate = moment(dateStr).fromNow();
                    $(this).text(humanDate);
                }
            });
        }
        
        $(document).ready(function() {
            // Format dates on page load
            formatHumanDate();
            
            // Handle modal show event
            $('#packageModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Card that triggered the modal
                var packageTitle = button.data('package-title');
                var packageDescription = button.data('package-description');
                var packageImage = button.data('package-image');
                var packageId = button.data('package-id');
                
                // Update modal content
                var modal = $(this);
                modal.find('#modalPackageTitle').text(packageTitle);
                
                // Render HTML in description (support <b>, <i>, <p>, <br>, etc.)
                modal.find('#modalPackageDescription').html(packageDescription);
                
                modal.find('#modalPackageImage').attr('src', packageImage);
                modal.find('.modal-title').text('Package #' + packageId + ' Details');
            });
            
            // Add scroll hint animation when modal is shown
            $('#packageModal').on('shown.bs.modal', function () {
                var modalBody = $(this).find('.modal-body');
                // Only show hint if content is scrollable
                if (modalBody[0].scrollHeight > modalBody[0].clientHeight) {
                    modalBody.addClass('scroll-hint');
                    // Remove class after animation completes
                    setTimeout(function() {
                        modalBody.removeClass('scroll-hint');
                    }, 2000);
                }
            });
        });
        
        // Function to open date picker
        function openDatePicker(input) {
            if (input.showPicker) {
                input.showPicker();
            } else {
                // Fallback for browsers that don't support showPicker
                input.focus();
            }
        }
        
        
        // Share package function
        function sharePackage(platform) {
            var packageTitle = $('#modalPackageTitle').text();
            var packageDesc = $('#modalPackageDescription').text().substring(0, 100) + '...';
            var currentUrl = window.location.href;
            var shareText = packageTitle + ' - ' + packageDesc;
            
            var shareUrl = '';
            
            switch(platform) {
                case 'whatsapp':
                    shareUrl = 'https://wa.me/?text=' + encodeURIComponent(shareText + ' ' + currentUrl);
                    window.open(shareUrl, '_blank');
                    break;
                case 'facebook':
                    shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl);
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                    break;
                case 'twitter':
                    shareUrl = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(shareText) + '&url=' + encodeURIComponent(currentUrl);
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                    break;
                case 'copy':
                    // Copy to clipboard
                    var textArea = document.createElement("textarea");
                    textArea.value = currentUrl;
                    document.body.appendChild(textArea);
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        alert('Link copied to clipboard!');
                    } catch (err) {
                        alert('Failed to copy link. Please copy manually: ' + currentUrl);
                    }
                    document.body.removeChild(textArea);
                    break;
            }
        }
        
        // Initialize WhatsApp booking
        function sendBookingWA() {
            var date = $('#bookDate').val();
            var bikeType = $('#bikeType').val();
            var bikeNumber = $('#bikeNumber').val();
            var note = $('#bookNote').val();
            var packageTitle = $('#modalPackageTitle').text();
            var captchaInput = parseInt($('#modal-captcha').val());
            var captchaAnswer = parseInt($('#modal-captcha-answer').val());
            
            if (!date) {
                alert('Please select a date.');
                return;
            }
            
            // Validate Captcha
            if (isNaN(captchaInput) || captchaInput !== captchaAnswer) {
                alert('Access Denied: Incorrect Captcha Answer! Please try again.');
                return;
            }
            
            var text = "Hi, I would like to book a tour:\n" +
                       "Package: " + packageTitle + "\n" +
                       "Date: " + date + "\n" +
                       "Bike Type: " + bikeType + "\n" +
                       "Number of Bikes: " + bikeNumber + "\n" +
                       "Note: " + note;
            
            var waNumber = "628123456789"; 
            if ($('#waNumber2').length && $('#waNumber2').val()) {
                waNumber = $('#waNumber2').val();
            }
            
            var url = "https://api.whatsapp.com/send?phone=" + waNumber + "&text=" + encodeURIComponent(text);
            window.open(url, '_blank');
            
            // Regenerate captcha
            generateCaptcha();
        }
        
        // Regenerate captcha when modal opens
        $('#packageModal').on('show.bs.modal', function () {
             generateCaptcha(); 
        });
    </script>

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
    
    <!-- Gallery Video Modal Script -->
    <script>
        $(document).ready(function() {
            // Initialize Magnific Popup for image gallery
            $('.portfolio-box:not(.video-box)').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
            
            // Handle video box clicks
            $('.video-box').click(function() {
                var videoId = $(this).data('video-id');
                var videoUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                $('#videoIframe').attr('src', videoUrl);
                $('#videoModal').modal('show');
            });
            
            // Clear video when modal is closed
            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoIframe').attr('src', '');
            });
            
            // Preserve scroll position when modals open
            var scrollPosition = 0;
            
            $('#packageModal, #videoModal').on('show.bs.modal', function () {
                scrollPosition = $(window).scrollTop();
            });
            
            $('#packageModal, #videoModal').on('shown.bs.modal', function () {
                $(window).scrollTop(scrollPosition);
            });
            
            // Initialize Captcha on load
            generateCaptcha();
        });

        // Custom Functions
        function openWA() {
            var number = document.getElementById("waNumber").value;
            window.open("https://api.whatsapp.com/send?phone=" + number + "&text=Hi, I contacted you through your website.", "_blank");
        }
        
        function openWA2() {
            var number = document.getElementById("waNumber2").value;
            window.open("https://api.whatsapp.com/send?phone=" + number + "&text=Hi, I contacted you through your website.", "_blank");
        }
        
        function sendFeedback() {
            var name = $('#cf-name').val();
            var email = $('#cf-email').val();
            var subject = $('#cf-subject').val();
            var message = $('#cf-message').val();
            var captchaInput = parseInt($('#cf-captcha').val());
            var captchaAnswer = parseInt($('#cf-captcha-answer').val());
            
            if (!name || !email || !subject || !message) {
                alert('Please fill in all required fields.'); 
                return;
            }

            // Validate Email
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Validate Captcha
            if (isNaN(captchaInput) || captchaInput !== captchaAnswer) {
                alert('Access Denied: Incorrect Captcha Answer! Please try again.');
                $('#cf-captcha').addClass('is-invalid');
                return;
            }
            $('#cf-captcha').removeClass('is-invalid');

            // Prepare WhatsApp Message
            var waText = "New Message from Website:\n" +
                         "Name: " + name + "\n" +
                         "Email: " + email + "\n" +
                         "Subject: " + subject + "\n" +
                         "Message: " + message;
            
            var waNumber = "628123456789"; 
            if ($('#waNumber2').length && $('#waNumber2').val()) {
                waNumber = $('#waNumber2').val();
            }
            
            // Open WhatsApp
            window.open("https://api.whatsapp.com/send?phone=" + waNumber + "&text=" + encodeURIComponent(waText), "_blank");
            
            // Reset form and regenerate captcha
            $('#form_feedback')[0].reset();
            generateCaptcha();

            // Submit via AJAX
            $.ajax({
                url: '<?= base_url("send-contact") ?>',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                success: function(response) {},
                error: function() {}
            });
        }
        
        // Function to generate random math captcha
        function generateCaptcha() {
            var num1 = Math.floor(Math.random() * 10) + 1;
            var num2 = Math.floor(Math.random() * 10) + 1;
            var answer = num1 + num2;
            
            // Update Contact Form Captcha
            if ($('#captcha-question').length) {
                $('#captcha-question').text(num1 + " + " + num2 + " = ?");
                $('#cf-captcha-answer').val(answer);
            }
            
            // Update Modal Validation Captcha
            var mNum1 = Math.floor(Math.random() * 10) + 1;
            var mNum2 = Math.floor(Math.random() * 10) + 1;
            var mAnswer = mNum1 + mNum2;
            
            if ($('#modal-captcha-question').length) {
                $('#modal-captcha-question').text(mNum1 + " + " + mNum2 + " = ?");
                $('#modal-captcha-answer').val(mAnswer);
            }
        }
        
        function filterPackage(pIdx) {
            var url1 = "<?= base_url('package-filter/') ?>" + pIdx;
            // Add loading state
            console.log('url1', url1);
            $(".package-items").addClass('loading');
            $.ajax({
                url: url1,
                type: "GET",
                dataType: "JSON",
                success: function(json) {
                    $(".package-items").empty().removeClass('loading');
                    if (json && json.length > 0) {
                        $.each(json, function(i, value) {
                            var tmp = value.other_teks || '';
                            var arr = tmp.split(" ");
                            var tmp_text = arr.slice(0, 40).join(' ');
                            var imgUrl = "<?= base_url('assets/themes/images/') ?>" + value.img;
                            var cardHtml = 
                                '<div class="col-sm-6 col-lg-4 mb-4">' +
                                '    <div class="card package-card" ' +
                                '         data-toggle="modal" ' +
                                '         data-target="#packageModal"' +
                                '         data-package-id="' + value.kd_teks + '"' +
                                '         data-package-title="' + (value.teks || '').replace(/"/g, '&quot;') + '"' +
                                '         data-package-description="' + (value.other_teks || '').replace(/"/g, '&quot;') + '"' +
                                '         data-package-image="' + imgUrl + '">' +
                                '        <div class="package-card-img-container">' +
                                '            <img src="' + imgUrl + '" class="package-card-img" alt="' + (value.teks || '').replace(/"/g, '&quot;') + '">' +
                                '            <span class="package-badge">#' + value.kd_teks + '</span>' +
                                '        </div>' +
                                '        <div class="card-body ck-content">' +
                                '            <h5 class="card-title">' + value.teks + '</h5>' +
                                '            <p class="card-text">' + tmp_text + '...</p>' +
                                '            <button class="btn btn-view-details">View Details</button>' +
                                '        </div>' +
                                '        <div class="card-footer">' +
                                '            <small class="text-muted"><i class="fa fa-clock-o"></i> Updated <span class="human-date" data-date="' + (value.last_update || '') + '">' + (value.last_update || 'recently') + '</span></small>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>';
                            $(".package-items").append(cardHtml);
                        });
                    } else {
                        $(".package-items").html('<div class="col-12 text-center py-5"><p class="text-white h4">No packages found for this category.</p></div>');
                    }
                    formatHumanDate();
                },
                error: function(xhr, status, error) {
                    $(".package-items").removeClass('loading').html('<div class="col-12 text-center py-5"><p class="text-white h4">Error loading packages. Please try again.</p></div>');
                }
            });
        }
    </script>
          
    <!-- Histats.com  START  (aync)-->
    <script type="text/javascript">var _Hasync= _Hasync|| [];
    _Hasync.push(['Histats.start', '1,5005008,4,239,241,20,00010000']);
    _Hasync.push(['Histats.fasi', '1']);
    _Hasync.push(['Histats.track_hits', '']);
    (function() {
    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
    hs.src = ('//s10.histats.com/js15_as.js');
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
    })();</script>
    <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?5005008&101" alt="" border="0"></a></noscript>
    <!-- Histats.com  END  -->
</body>
</html>
