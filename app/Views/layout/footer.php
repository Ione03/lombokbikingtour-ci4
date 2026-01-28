    <!-- Footer -->
    <?php
        $addr_email = '';
        $addr_telp = '';
        $addr_wa = '';
        $addr_location = '';
        
        // Ensure value is passed or check global
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
            
            <hr class="my-4">
            
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
