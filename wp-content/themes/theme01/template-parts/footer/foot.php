<?php
/**
 * Footer template
 */
?>
<div class="footer-container">
    <div class="footer">
        <div class="logo-section">
            <div>
                <a class="navbar-brand" href="<?php echo site_url(); //return the site url ?>">
                    <?php
                    $logoImage = get_header_image(); //return the path of header image
                    
                    ?>
                    <img src="<?php echo $logoImage; ?>" alt="logo image" width="180">
                </a>
                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    Ipsum.</p>
            </div>
        </div>
        <div class="links-section">
            <h2>Quick Links</h2>
            <!-- calling footer items -->
            <?php wp_nav_menu(array(
                'theme_location' => 'primary-menu'
                ,
                'menu_class' => 'footer-nav'
            )) ?>
        </div>
        <div class="contact-section">
            <h2>Contact Info</h2>
            <p>Email: gokarnachy28@gmail.com</p>
            <p>Address: Ekanatakuna, Lalitpur</p>
            <div class="contact-section-input">
                <input type="email" placeholder="Enter your email" required>
                <button>Send</button>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>Copyright@2024</p>
    </div>
</div>