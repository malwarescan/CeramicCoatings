<footer class="footer">
    <div class="container">
        <div class="footer-content" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            <div>
                <h3>Florida Ceramic Coatings</h3>
                <p>Professional ceramic coating services across Florida. Protect your vehicle from UV, salt air, humidity, and lovebugs.</p>
            </div>
            <div>
                <h3>Services</h3>
                <ul style="list-style: none;">
                    <li><a href="/ceramic-coating" style="color: #ccc; text-decoration: none;">Ceramic Coating</a></li>
                    <li><a href="/coating-maintenance" style="color: #ccc; text-decoration: none;">Coating Maintenance</a></li>
                    <li><a href="/water-spot-removal" style="color: #ccc; text-decoration: none;">Water Spot Removal</a></li>
                    <li><a href="/lovebug-protection" style="color: #ccc; text-decoration: none;">Lovebug Protection</a></li>
                </ul>
            </div>
            <div>
                <h3>Contact</h3>
                <p>Phone: <a href="tel:<?= \App\Core\Env::get('APP_PHONE') ?>" style="color: #ccc; text-decoration: none;"><?= \App\Core\Env::get('APP_PHONE') ?></a></p>
                <p>Address: <?= \App\Core\Env::get('APP_ADDRESS') ?></p>
            </div>
        </div>
        <div class="footer-bottom" style="border-top: 1px solid #555; padding-top: 1rem; text-align: center;">
            <p>&copy; <?= date('Y') ?> Florida Ceramic Coatings. All rights reserved.</p>
        </div>
    </div>
</footer>
