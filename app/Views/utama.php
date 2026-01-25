<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lombok Biking Tour</title>
    
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
    
    <!-- Custom Styles -->
    <style>
        body, h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Poppins', sans-serif !important;
        }
        p, .text-muted, .card-text, small {
            font-family: 'Inter', sans-serif !important;
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
            color: #f4623a;
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
            color: #f4623a;
        }
    </style>
    
    <script type="text/javascript">
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
            
            if (!name) {
                alert('Please enter your name');
                return;
            }
            if (!email) {
                alert('Please enter your email');
                return;
            }
            if (!subject) {
                alert('Please enter a subject');
                return;
            }
            if (!message) {
                alert('Please enter a message');
                return;
            }
            
            // Submit via AJAX (you'll need to create a controller endpoint)
            $.ajax({
                url: '<?= base_url("send-contact") ?>',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                success: function(response) {
                    alert('Thank you! Your message has been sent successfully.');
                    $('#form_feedback')[0].reset();
                },
                error: function() {
                    alert('Thank you for your interest! We will get back to you soon.');
                    $('#form_feedback')[0].reset();
                }
            });
        }

        
        function filterPackage(pIdx) {
            var url1 = "<?= base_url('package-filter/') ?>" + pIdx;
            console.log('Filtering packages with index:', pIdx);
            console.log('API URL:', url1);
            
            // Add loading state
            $(".package-items").addClass('loading');
            
            $.ajax({
                url: url1,
                type: "GET",
                dataType: "JSON",
                success: function(json) {
                    console.log('Received data:', json);
                    $(".package-items").empty().removeClass('loading');
                    
                    if (json && json.length > 0) {
                        $.each(json, function(i, value) {
                            var tmp = value.other_teks || '';
                            var arr = tmp.split(" ");
                            var tmp_text = arr.slice(0, 20).join(' ');
                            var imgUrl = "<?= base_url('assets/themes/images/') ?>" + value.img;
                            var packageUrl = "<?= base_url('package/') ?>" + value.kd_teks;
                            
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
                                '        <div class="card-body">' +
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
                        $(".package-items").html(
                            '<div class="col-12 text-center py-5">' +
                            '<p class="text-white h4">No packages found for this category.</p>' +
                            '</div>'
                        );
                    }
                    
                    // Format human-readable dates after loading
                    formatHumanDate();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    $(".package-items").removeClass('loading').html(
                        '<div class="col-12 text-center py-5">' +
                        '<p class="text-white h4">Error loading packages. Please try again.</p>' +
                        '</div>'
                    );
                }
            });
        }
    </script>
</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <img height="40" src="<?= base_url('assets/themes/img/Logo.png') ?>"> Lombok Biking Tour</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#package">Package</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#galery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead Slideshow -->
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
    
    <header class="masthead-slideshow">
        <!-- Slide 1 -->
        <div class="masthead-slide active" style="background-image: linear-gradient(to bottom, rgba(92,245,255,0.2) 0%, rgba(92, 77, 66, 0.5) 100%), url('<?= base_url('assets/themes/images/slider-image1.jpg') ?>');">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-white font-weight-bold"><?= $teks_01 ?></h1>
                        <hr class="divider my-4">
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5"><?= $teks_other_01 ?></p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#package">Find Out More</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
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
        
        <!-- Slide 3 -->
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
        
        <!-- Navigation Controls -->
        <button class="slideshow-control prev" onclick="changeSlide(-1)">
            <i class="fa fa-chevron-left"></i>
        </button>
        <button class="slideshow-control next" onclick="changeSlide(1)">
            <i class="fa fa-chevron-right"></i>
        </button>
        
        <!-- Slide Indicators -->
        <div class="slide-indicators">
            <span class="indicator active" onclick="goToSlide(0)"></span>
            <span class="indicator" onclick="goToSlide(1)"></span>
            <span class="indicator" onclick="goToSlide(2)"></span>
        </div>
    </header>

    <!-- Package Section -->
    <section class="page-section bg-primary" id="package">
        <div class="container">
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
                        <?php // Checking status removed to show all packages ?>
                        <?php
                            $tmp = $item['other_teks'] ?? '';
                            $arr = explode(" ", $tmp);
                            $tmp_text = implode(' ', array_slice($arr, 0, 20));
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
                                <div class="card-body">
                                    <h5 class="card-title"><?= $item['teks'] ?></h5>
                                    <p class="card-text"><?= $tmp_text ?>...</p>
                                    <button class="btn btn-view-details">View Details</button>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> Updated <span class="human-date" data-date="<?= $item['last_update'] ?? '' ?>"><?= $item['last_update'] ?? 'recently' ?></span></small>
                                </div>
                            </div>
                        </div>
                        <?php // endif; ?>
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
                    <img src="" id="modalPackageImage" class="package-modal-img" alt="Package Image">
                    <h3 id="modalPackageTitle"></h3>
                    <div id="modalPackageDescription" style="white-space: pre-line; line-height: 1.8; color: #4a5568;"></div>
                    
                    <hr>
                    <h5 class="mt-4">Book This Tour</h5>
                    <form id="bookingForm">
                        <div class="form-group">
                            <label for="bookDate">Date of Tour</label>
                            <input type="date" class="form-control" id="bookDate" required>
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
    <section class="page-section" id="about">
        <div class="container">
            <h2 class="text-center mt-0">About Us</h2>
            <hr class="divider my-3">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <img src="<?= base_url('assets/themes/images/about_us.png') ?>" class="img-fluid" alt="About Us">
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- About content will be loaded from database -->
                    <p>Welcome to Lombok Biking Tour!</p>
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
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0"><?= $contact_title ?></h2>
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
                            <div class="col-md-12 col-sm-12">
                                <button type="button" class="btn btn-primary btn-block" id="cf-submit" onclick="sendFeedback()">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-4 col-sm-12 mt-4 mt-md-0">
                    <!-- Google Map -->
                    <div class="map-container mb-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15783.567117173266!2d116.089856!3d-8.510000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMzAnMzYuMCJTIDExNsKwMDUnMjMuNSJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

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
    <footer class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Lombok Biking Tour</h4>
                    <p class="text-muted mb-0">Experience the best biking adventures in Lombok with our professional guides and top-quality equipment.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a class="js-scroll-trigger" href="#page-top">Home</a></li>
                        <li><a class="js-scroll-trigger" href="#package">Packages</a></li>
                        <li><a class="js-scroll-trigger" href="#galery">Gallery</a></li>
                        <li><a class="js-scroll-trigger" href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Follow Us</h4>
                    <a class="footer-social-link" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="footer-social-link" href="#"><i class="fa fa-instagram"></i></a>
                    <a class="footer-social-link" href="#"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
            <div class="small text-center text-muted mt-5">Copyright &copy; 2026 - LombokBikingTour.com</div>
        </div>
    </footer>

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
        });
        // Initialize WhatsApp booking
        function sendBookingWA() {
            var date = $('#bookDate').val();
            var bikeType = $('#bikeType').val();
            var bikeNumber = $('#bikeNumber').val();
            var note = $('#bookNote').val();
            var packageTitle = $('#modalPackageTitle').text();
            var packageId = $('#modalPackageTitle').text(); // Or get from data attribute if needed
            
            if (!date) {
                alert('Please select a date.');
                return;
            }
            
            var text = "Hi, I would like to book a tour:\n" +
                       "Package: " + packageTitle + "\n" +
                       "Date: " + date + "\n" +
                       "Bike Type: " + bikeType + "\n" +
                       "Number of Bikes: " + bikeNumber + "\n" +
                       "Note: " + note;
            
            var waNumber = "628123456789"; // Replace with your actual WA number
            // Try to find dynamic number from hidden input if available
            if ($('#waNumber2').length && $('#waNumber2').val()) {
                waNumber = $('#waNumber2').val();
            }
            
            var url = "https://api.whatsapp.com/send?phone=" + waNumber + "&text=" + encodeURIComponent(text);
            window.open(url, '_blank');
        }
    </script>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
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
    </script>
    
    <!-- Gallery Video Modal Script -->
    <script>
        $(document).ready(function() {
            // Initialize Magnific Popup for image gallery
            $('.portfolio-box').magnificPopup({
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
        });
    </script>
</body>
</html>
