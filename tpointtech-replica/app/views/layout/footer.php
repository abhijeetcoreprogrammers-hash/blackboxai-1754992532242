</main>
<footer>
    <div class="container">
        <p>G-13, 2nd Floor, Sec-3, Noida, UP, 201301, India</p>
        <p>Email: <a href="mailto:hr@tpointtech.com">hr@tpointtech.com</a></p>
        <p>Phone: <a href="tel:+919599086977">+91-9599086977</a></p>
        <div class="social-links">
            <a href="https://www.facebook.com/tpointtech" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/img/facebook.png" alt="Facebook">
            </a>
            <a href="https://x.com/tpointtech" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/images/x.png" alt="X">
            </a>
            <a href="https://www.linkedin.com/company/tpointtech/" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/images/linkedin.png" alt="LinkedIn">
            </a>
            <a href="https://t.me/tpointtech" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/images/telegram.png" alt="Telegram">
            </a>
            <a href="https://www.youtube.com/@tpointtechofficial" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/img/youtube.png" alt="YouTube">
            </a>
            <a href="https://www.instagram.com/tpointtech" target="_blank" rel="noopener">
                <img src="https://images.tpointtech.com/static/images/insta.png" alt="Instagram">
            </a>
        </div>
        <p>&copy; Copyright 2011 - 2025 TPointTech.com. All Rights Reserved.</p>
    </div>
</footer>

<script src="<?= BASE_URL ?>assets/js/main.js"></script>
<?php if (isset($jsFiles) && is_array($jsFiles)): ?>
    <?php foreach ($jsFiles as $jsFile): ?>
        <script src="<?= BASE_URL ?>assets/js/<?= h($jsFile) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
