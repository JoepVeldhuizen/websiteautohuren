document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navContainer = document.querySelector('.nav-container');
    const body = document.body;

    hamburgerMenu.addEventListener('click', function() {
        this.classList.toggle('active');
        navContainer.classList.toggle('active');
        body.style.overflow = navContainer.classList.contains('active') ? 'hidden' : '';
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!hamburgerMenu.contains(event.target) && 
            !navContainer.contains(event.target) && 
            navContainer.classList.contains('active')) {
            hamburgerMenu.classList.remove('active');
            navContainer.classList.remove('active');
            body.style.overflow = '';
        }
    });

    // Close menu when window is resized above mobile breakpoint
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navContainer.classList.contains('active')) {
            hamburgerMenu.classList.remove('active');
            navContainer.classList.remove('active');
            body.style.overflow = '';
        }
    });
}); 