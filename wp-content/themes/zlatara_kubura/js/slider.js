/**
 * Slider functionality for products
 */

document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.product-slide');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const loadMoreBtn = document.querySelector('.load-more-btn');
    
    if (!sliderContainer || !slides.length) return;
    
    let currentSlide = 0;
    let slidesToShow = getSlidesToShow();
    let maxSlides = Math.max(0, slides.length - slidesToShow);
    
    function getSlidesToShow() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 768) return 2;
        return 3;
    }
    
    function updateSlider() {
        const slideWidth = 100 / slidesToShow;
        const translateX = -currentSlide * slideWidth;
        sliderContainer.style.transform = `translateX(${translateX}%)`;
        
        if (prevBtn) prevBtn.disabled = currentSlide === 0;
        if (nextBtn) nextBtn.disabled = currentSlide >= maxSlides;
    }
    
    function recalculateSlider() {
        slidesToShow = getSlidesToShow();
        const allSlides = document.querySelectorAll('.product-slide');
        maxSlides = Math.max(0, allSlides.length - slidesToShow);
        
        // Adjust current slide if needed
        if (currentSlide >= maxSlides) {
            currentSlide = Math.max(0, maxSlides);
        }
        
        updateSlider();
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentSlide < maxSlides) {
                currentSlide++;
                updateSlider();
            }
        });
    }
    
    // Load more products functionality
    if (loadMoreBtn) {
        let page = 2;
        let loading = false;
        
        loadMoreBtn.addEventListener('click', function() {
            if (loading) return;
            
            loading = true;
            this.style.opacity = '0.7';
            this.textContent = 'Učitavanje...';
            
            const formData = new FormData();
            formData.append('action', 'load_more_products');
            formData.append('page', page);
            
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim()) {
                    // Create temporary container for new products
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.trim();
                    
                    // Add new slides to slider
                    while (tempDiv.firstChild) {
                        const slide = tempDiv.firstChild;
                        slide.classList.add('product-slide');
                        sliderContainer.appendChild(slide);
                    }
                    
                    // Recalculate slider parameters
                    recalculateSlider();
                    page++;
                    
                    this.style.opacity = '1';
                    this.textContent = 'Učitaj još proizvoda';
                } else {
                    // No more products
                    this.style.display = 'none';
                    const noMoreText = document.createElement('p');
                    noMoreText.style.textAlign = 'center';
                    noMoreText.style.color = '#A89F91';
                    noMoreText.style.marginTop = '20px';
                    noMoreText.textContent = 'Nema više proizvoda za prikaz';
                    this.parentNode.appendChild(noMoreText);
                }
                
                loading = false;
            })
            .catch(error => {
                console.error('Error loading more products:', error);
                this.style.opacity = '1';
                this.textContent = 'Greška - pokušajte ponovo';
                loading = false;
            });
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        recalculateSlider();
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft' && prevBtn && !prevBtn.disabled) {
            prevBtn.click();
        } else if (e.key === 'ArrowRight' && nextBtn && !nextBtn.disabled) {
            nextBtn.click();
        }
    });
    
    // Touch/swipe support for mobile
    let startX = 0;
    let isDragging = false;
    
    sliderContainer.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        isDragging = true;
    }, { passive: true });
    
    sliderContainer.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        e.preventDefault();
    }, { passive: false });
    
    sliderContainer.addEventListener('touchend', function(e) {
        if (!isDragging) return;
        
        const endX = e.changedTouches[0].clientX;
        const diff = startX - endX;
        
        if (Math.abs(diff) > 50) { // Minimum swipe distance
            if (diff > 0 && nextBtn && !nextBtn.disabled) {
                nextBtn.click();
            } else if (diff < 0 && prevBtn && !prevBtn.disabled) {
                prevBtn.click();
            }
        }
        
        isDragging = false;
    }, { passive: true });
    
    // Initialize
    updateSlider();
});