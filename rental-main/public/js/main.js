document.addEventListener('DOMContentLoaded', function() {
    // Hamburger menu functionality
    const navContainer = document.querySelector('.nav-container');
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menuOverlay = document.querySelector('.menu-overlay');
    const body = document.body;

    if (hamburgerMenu && navContainer) {
        hamburgerMenu.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            navContainer.classList.toggle('active');
            body.style.overflow = navContainer.classList.contains('active') ? 'hidden' : '';
            
            // Update aria-expanded attribute
            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded);
        });

        // Close menu when clicking overlay
        if (menuOverlay) {
            menuOverlay.addEventListener('click', function() {
                hamburgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                body.style.overflow = '';
                hamburgerMenu.setAttribute('aria-expanded', 'false');
            });
        }

        // Close menu on window resize if above mobile breakpoint
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && navContainer.classList.contains('active')) {
                hamburgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                body.style.overflow = '';
                hamburgerMenu.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu when clicking a link
        const navLinks = navContainer.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                body.style.overflow = '';
                hamburgerMenu.setAttribute('aria-expanded', 'false');
            });
        });

        // Close menu when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navContainer.classList.contains('active')) {
                hamburgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                body.style.overflow = '';
                hamburgerMenu.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Category filter functionality
    const categoryButtons = document.querySelectorAll('.category-buttons .btn');
    categoryButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Remove active class from all buttons
            categoryButtons.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary');
            });
            
            // Add active class to clicked button
            this.classList.remove('btn-secondary');
            this.classList.add('btn-primary');
        });
    });

    // Account dropdown functionality
    const accountImage = document.querySelector('.account img');
    if (accountImage) {
        accountImage.addEventListener('click', function () {
            const account = this.closest('.account');
            account.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            const account = document.querySelector('.account');
            if (account && !account.contains(e.target)) {
                account.classList.remove('active');
            }
        });
    }

    // Login modal functionality
    const registerButton = document.querySelector('.auth-buttons .button-primary');
    if (registerButton) {
        registerButton.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = document.getElementById('loginModal');
            if (modal) modal.classList.remove('hidden');
        });
    }

    const modalClose = document.querySelector('.modal-close');
    if (modalClose) {
        modalClose.addEventListener('click', function () {
            const modal = document.getElementById('loginModal');
            if (modal) modal.classList.add('hidden');
        });
    }

    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    }
}); 