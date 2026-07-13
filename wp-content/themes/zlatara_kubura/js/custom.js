jQuery(document).ready(function($) {
    var page = 2;
    
    // Header scroll effect
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });
    
    // Mobile menu toggle
    $('.menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.main-navigation').toggleClass('active');
    });
    
    // Close mobile menu when clicking on menu items
    $('.main-menu a').on('click', function() {
        $('.menu-toggle').removeClass('active');
        $('.main-navigation').removeClass('active');
    });
    
    // Close mobile menu when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.site-header').length) {
            $('.menu-toggle').removeClass('active');
            $('.main-navigation').removeClass('active');
        }
    });
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000, 'easeInOutQuad');
        }
    });
    
    // Load more button functionality
    $('#load-more-proizvodi').on('click', function() {
        var button = $(this);
        var originalText = button.text();
        button.text('Učitava...');
        button.prop('disabled', true);
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_products',
                page: page,
                nonce: ajax_object.nonce
            },
            success: function(response) {
                if(response.trim() !== '') {
                    var newItems = $(response);
                    $('#proizvodi-slider').append(newItems);
                    
                    // Animate new items
                    newItems.each(function(index) {
                        var item = $(this);
                        item.css({
                            opacity: 0,
                            transform: 'translateY(30px)'
                        });
                        
                        setTimeout(function() {
                            item.addClass('animate-in').css({
                                opacity: 1,
                                transform: 'translateY(0)'
                            });
                        }, index * 100);
                    });
                    
                    page++;
                    button.text(originalText);
                    button.prop('disabled', false);
                } else {
                    button.text('Nema više proizvoda').prop('disabled', true);
                }
            },
            error: function() {
                button.text('Greška! Pokušajte ponovo.');
                button.prop('disabled', false);
                
                // Reset button after 3 seconds
                setTimeout(function() {
                    button.text(originalText);
                }, 3000);
            }
        });
    });
    
    // Gallery functionality for single product
    $('.gallery-thumbs img').on('click', function() {
        var newSrc = $(this).attr('src').replace('-150x150', '-1024x1024');
        $('.main-image img').attr('src', newSrc);
        $('.gallery-thumbs img').removeClass('active');
        $(this).addClass('active');
        
        // Add fade effect
        $('.main-image img').fadeOut(200, function() {
            $(this).attr('src', newSrc).fadeIn(200);
        });
    });
    
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const animateElements = document.querySelectorAll('.kategorija-item, .proizvod-item');
        
        const elementObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    elementObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        animateElements.forEach(el => elementObserver.observe(el));
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        $('.kategorija-item, .proizvod-item').addClass('animate-in');
    }
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Parallax effect for hero section
    $(window).scroll(function() {
        var scrolled = $(this).scrollTop();
        var parallax = $('.hero-image');
        var speed = 0.5;
        
        if (parallax.length) {
            var yPos = -(scrolled * speed);
            parallax.css('transform', 'translateY(' + yPos + 'px)');
        }
    });
    
    // Add smooth easing function
    $.easing.easeInOutQuad = function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t + b;
        return -c/2 * ((--t)*(t-2) - 1) + b;
    };
    
    // Preloader (optional)
    $(window).on('load', function() {
        $('#preloader').fadeOut('slow', function() {
            $(this).remove();
        });
    });
    
    // Back to top button
    var backToTop = $('<button id="back-to-top" title="Back to top">↑</button>');
    backToTop.css({
        'position': 'fixed',
        'bottom': '20px',
        'right': '20px',
        'width': '50px',
        'height': '50px',
        'border-radius': '50%',
        'background': 'var(--primary-gold)',
        'color': 'white',
        'border': 'none',
        'cursor': 'pointer',
        'font-size': '20px',
        'z-index': '999',
        'display': 'none',
        'transition': 'all 0.3s ease'
    });
    
    $('body').append(backToTop);
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 500) {
            backToTop.fadeIn();
        } else {
            backToTop.fadeOut();
        }
    });
    
    backToTop.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800, 'easeInOutQuad');
    });
    
    // Form validation (if needed)
    $('form').on('submit', function(e) {
        var isValid = true;
        
        $(this).find('input[required], textarea[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('error');
                isValid = false;
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Molimo popunite sva obavezna polja.');
        }
    });
    
    // Auto-hide success/error messages
    setTimeout(function() {
        $('.notice, .alert').fadeOut('slow');
    }, 5000);
    
    // Initialize tooltips (if using them)
    $('[data-toggle="tooltip"]').each(function() {
        $(this).hover(
            function() {
                var tooltip = $('<div class="tooltip">' + $(this).data('tooltip') + '</div>');
                $('body').append(tooltip);
                
                var pos = $(this).offset();
                tooltip.css({
                    top: pos.top - tooltip.outerHeight() - 10,
                    left: pos.left + ($(this).outerWidth() / 2) - (tooltip.outerWidth() / 2)
                });
            },
            function() {
                $('.tooltip').remove();
            }
        );
    });
});

// Additional utility functions
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Optimized scroll events
var scrollHandler = debounce(function() {
    // Add any scroll-based functionality here
}, 100);

window.addEventListener('scroll', scrollHandler);