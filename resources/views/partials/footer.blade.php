<footer class="bg-black text-light border-top border-secondary mt-5 py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a class="heading-font fs-2 text-white text-decoration-none" href="/">FC <span class="text-danger">LEGEND</span></a>
                <p class="text-secondary mt-3">Official Football Club website. Passion, glory, and history forged on the pitch. Follow all latest news, live fixture events, and player statistics.</p>
                <div class="d-flex gap-3 fs-5 mt-4 text-danger">
                    <a href="#" class="text-danger"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-danger"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-danger"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-danger"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h5 class="heading-font text-white mb-3">Quick Links</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 text-secondary fs-6">
                    <li><a href="/" class="text-secondary text-decoration-none">Home</a></li>
                    <li><a href="/about" class="text-secondary text-decoration-none">About Club</a></li>
                    <li><a href="/players" class="text-secondary text-decoration-none">First Team</a></li>
                    <li><a href="/legends" class="text-secondary text-decoration-none">Club Legends</a></li>
                    <li><a href="/matches" class="text-secondary text-decoration-none">Fixtures & Results</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h5 class="heading-font text-white mb-3">Community</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 text-secondary fs-6">
                    <li><a href="/news" class="text-secondary text-decoration-none">Latest News</a></li>
                    <li><a href="/contact" class="text-secondary text-decoration-none">Contact Us</a></li>
                    <li><a href="/login" class="text-secondary text-decoration-none">Member Login</a></li>
                    <li><a href="/register" class="text-secondary text-decoration-none">Register Account</a></li>
                    <li><a href="/profile" class="text-secondary text-decoration-none">User Profile</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="heading-font text-white mb-3">Newsletter</h5>
                <p class="text-secondary">Subscribe to receive official match updates, transfer news, and exclusive club announcements.</p>
                <form class="d-flex gap-2" onsubmit="event.preventDefault(); alert('Subscribed to FC Legend Newsletter!');">
                    <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="Your email address" required>
                    <button class="btn btn-danger px-4" type="submit">Join</button>
                </form>
            </div>
        </div>
        <div class="border-top border-secondary mt-5 pt-4 text-center text-secondary small">
            &copy; {{ date('Y') }} FC Legend. All rights reserved. Built with Laravel, Blade & Bootstrap 5.
        </div>
    </div>
</footer>
