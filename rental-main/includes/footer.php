<footer>
    <div class="brand">
        <h2>Rydr.</h2>
        <p>Stap in. Rij weg. Simpel.</p>
    </div>
    <div class="footer-links">
        <div class="links">
            <h3>Over ons</h3>
            <ul>
                <li><a href="./over-ons" class="footer-link">Het team</a></li>
                <li><a href="#" class="footer-link">Onze visie</a></li>
                <li><a href="#" class="footer-link">Vacatures</a></li>
            </ul>
        </div>
        <div class="links">
            <h3>Community</h3>
            <ul>
                <li><a href="#" class="footer-link">Events</a></li>
                <li><a href="#" class="footer-link">Blog</a></li>
                <li><a href="#" class="footer-link">Podcast</a></li>
                <li><a href="#" class="footer-link">Invite a friend</a></li>
            </ul>
        </div>
        <div class="links">
            <h3>Socials</h3>
            <ul>
                <li><a href="#" class="footer-link">Discord</a></li>
                <li><a href="#" class="footer-link">Instagram</a></li>
                <li><a href="#" class="footer-link">Twitter</a></li>
                <li><a href="#" class="footer-link">Facebook</a></li>
            </ul>
        </div>
    </div>
</footer>
<div class="legal-footer">
    <div class="legal">
        <div class="copyright">
            © <?= date("Y") ?> Rydr. All rights reserved
        </div>
    </div>
    <div class="legal-links">
        <ul>
            <li><a href="#" class="legal-link">Privacy & Policy</a></li>
            <li><a href="#" class="legal-link">Terms & Condition</a></li>
        </ul>
    </div>
</div>
<div id="loginModal" class="modal hidden" role="dialog" aria-labelledby="modalTitle">
    <div class="modal-content">
        <h2 id="modalTitle">Welkom bij Rydr</h2>
        <p>Kies hoe je verder wilt gaan:</p>
        <div class="modal-actions">
            <a href="./login-form" class="button-secondary">Inloggen</a>
            <a href="./register-form" class="button-primary">Account aanmaken</a>
        </div>
        <button class="modal-close" aria-label="Sluiten">&times;</button>
    </div>
</div>
</body>
</html>