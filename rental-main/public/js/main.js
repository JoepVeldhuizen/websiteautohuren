document.addEventListener('DOMContentLoaded', function() {
    // Hamburger menu functionality
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navContainer = document.querySelector('.nav-container');
    const body = document.body;

    if (hamburgerMenu && navContainer) {
        hamburgerMenu.addEventListener('click', function() {
            this.classList.toggle('active');
            navContainer.classList.toggle('active');
            body.style.overflow = navContainer.classList.contains('active') ? 'hidden' : '';
            
            // Update aria-expanded attribute
            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded);
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!hamburgerMenu.contains(event.target) && 
                !navContainer.contains(event.target) && 
                navContainer.classList.contains('active')) {
                hamburgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                body.style.overflow = '';
                hamburgerMenu.setAttribute('aria-expanded', 'false');
            }
        });

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
}); 