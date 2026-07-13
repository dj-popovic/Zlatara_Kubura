/**
 * Navigation functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href === '#') return;
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Header scroll effect
    const header = document.querySelector('.site-header');
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.backgroundColor = 'white';
            header.style.backdropFilter = 'none';
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Mobile menu toggle (basic implementation)
    const nav = document.querySelector('.main-navigation');
    const navToggle = document.createElement('button');
    navToggle.classList.add('nav-toggle');
    navToggle.innerHTML = '☰';
    navToggle.style.display = 'none';
    navToggle.style.background = 'none';
    navToggle.style.border = 'none';
    navToggle.style.fontSize = '24px';
    navToggle.style.cursor = 'pointer';
    navToggle.style.color = 'var(--dark)';
    
    // Insert toggle button before navigation
    nav.parentNode.insertBefore(navToggle, nav);
    
    // Toggle functionality
    navToggle.addEventListener('click', function() {
        nav.classList.toggle('mobile-open');
    });
    
    // Show/hide toggle button based on screen size
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            navToggle.style.display = 'block';
            nav.style.display = nav.classList.contains('mobile-open') ? 'block' : 'none';
        } else {
            navToggle.style.display = 'none';
            nav.style.display = 'block';
            nav.classList.remove('mobile-open');
        }
    }
    
    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();
});