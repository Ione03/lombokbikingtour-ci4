<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lombok Biking Tour</title>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    
    <!-- Plugin CSS -->
    <link href="<?= base_url('assets/themes/vendor/magnific-popup/magnific-popup.css') ?>" rel="stylesheet">
    
    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?= base_url('assets/themes/css/creative.css') ?>" rel="stylesheet">
    
    <!-- Slideshow CSS -->
    <link href="<?= base_url('assets/themes/css/slideshow.css') ?>" rel="stylesheet">
    
    <!-- Package Cards CSS -->
    <link href="<?= base_url('assets/themes/css/package-cards.css') ?>" rel="stylesheet">
    
    <script type="text/javascript">
        function openWA() {
            var number = document.getElementById("waNumber").value;
            window.open("https://api.whatsapp.com/send?phone=" + number + "&text=Hi, I contacted you through your website.", "_blank");
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
                                '            <small class="text-muted"><i class="fa fa-clock-o"></i> Updated ' + (value.last_update || 'recently') + '</small>' +
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
                    <li class="nav-item"><a class="nav-link" href="#package">Package</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
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
                if (isset($item->kd_teks) && $item->kd_teks == "T01") {
                    $teks_01 = $item->teks ?? '';
                    $teks_other_01 = $item->other_teks ?? '';
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
                        <?php if (isset($item->status) && $item->status == "5"): ?>
                        <?php
                            $tmp = $item->other_teks ?? '';
                            $arr = explode(" ", $tmp);
                            $tmp_text = implode(' ', array_slice($arr, 0, 20));
                        ?>
                        <div class="col-sm-6 col-lg-4 mb-4">
                            <div class="card package-card" 
                                 data-toggle="modal" 
                                 data-target="#packageModal"
                                 data-package-id="<?= $item->kd_teks ?>"
                                 data-package-title="<?= htmlspecialchars($item->teks) ?>"
                                 data-package-description="<?= htmlspecialchars($item->other_teks ?? '') ?>"
                                 data-package-image="<?= base_url('assets/themes/images/' . $item->img) ?>">
                                <div class="package-card-img-container">
                                    <img src="<?= base_url('assets/themes/images/' . $item->img) ?>" class="package-card-img" alt="<?= htmlspecialchars($item->teks) ?>">
                                    <span class="package-badge">#<?= $item->kd_teks ?></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $item->teks ?></h5>
                                    <p class="card-text"><?= $tmp_text ?>...</p>
                                    <button class="btn btn-view-details">View Details</button>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> Updated <?= $item->last_update ?? 'recently' ?></small>
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
                    <img src="" id="modalPackageImage" class="package-modal-img" alt="Package Image">
                    <h3 id="modalPackageTitle"></h3>
                    <p id="modalPackageDescription" style="white-space: pre-line; line-height: 1.8; color: #4a5568;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#contact" class="btn btn-primary" data-dismiss="modal">Book This Tour</a>
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
                    <img width="550" height="350" src="<?= base_url('assets/themes/images/about_us.png') ?>" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- About content will be loaded from database -->
                    <p>Welcome to Lombok Biking Tour!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright &copy; 2026 - LombokBikingTour.com</div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= base_url('assets/themes/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/vendor/magnific-popup/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets/themes/js/creative.js') ?>"></script>
    
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
        $(document).ready(function() {
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
                modal.find('#modalPackageDescription').text(packageDescription);
                modal.find('#modalPackageImage').attr('src', packageImage);
                modal.find('.modal-title').text('Package #' + packageId + ' Details');
            });
        });
    </script>
</body>
</html>
