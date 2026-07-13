<footer id="colophon" class="site-footer">

    <div class="footer-container">

        <!-- 1. LOGO + SLOGAN + SOCIAL -->
        <div class="footer-logo-column">

            <div class="footer-logo">
                <?php 
                    $logo = get_field('site_logo', 'option');
                    if ($logo) : ?>
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="Footer Logo">
                <?php endif; ?>
            </div>

            <p class="footer-slogan">Elegance in every detail</p>

            <div class="footer-social">
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>

        </div>

        <!-- 2. WORKING HOURS -->
        <div class="footer-hours">
            <h3>Working Hours</h3>
            <p>Monday – Friday: 08–20h</p>
            <p>Saturday: 08–14h</p>
            <p>Sunday: Closed</p>
        </div>

        <!-- 3. NAVIGATION (WP MENU) -->
        <div class="footer-nav">
            <h3>Menu</h3>

            <?php 
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'footer-menu',
                ]);
            ?>
        </div>

        <!-- 4. CONTACT INFO -->
        <div class="footer-contact">
            <h3>Contact</h3>

            <div class="footer-contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Address, City, Country</span>
            </div>

            <div class="footer-contact-item">
                <i class="fas fa-phone-alt"></i>
                <span>+381 62 000 0000</span>
            </div>

            <div class="footer-contact-item">
                <i class="fas fa-envelope"></i>
                <span>jewelrystore@gmail.com</span>
            </div>

        </div>

    </div>

    <!-- LINE + SCROLL TOP -->
    <div class="footer-bottom">
        <div class="scroll-top-wrapper">
            <button id="scrollTopBtn" class="scroll-top-btn">
            <i class="fa-solid fa-chevron-up"></i>
            </button>
        </div>

        <p>&copy; <?php echo date("Y"); ?> Jewelry Store. All rights reserved.</p>
    </div>

</footer>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    /* =======================
       BURGER MENU
    ======================= */
    const burger = document.getElementById("burgerBtn");
    const menu = document.getElementById("mobileMenu");
    const header = document.querySelector(".site-header");
    const overlay = document.querySelector(".menu-overlay");

    if (burger && menu && overlay && header) {
        burger.addEventListener("click", () => {
            burger.classList.toggle("active");
            menu.classList.toggle("active");
            overlay.classList.toggle("active");
        });

        overlay.addEventListener("click", () => {
            burger.classList.remove("active");
            menu.classList.remove("active");
            overlay.classList.remove("active");
        });

        window.addEventListener("scroll", () => {
            header.classList.toggle("scrolled", window.scrollY > 10);
        });
    }


    /* =======================
       SCROLL TO TOP
    ======================= */
    const topBtn = document.getElementById("scrollTopBtn");
    if (topBtn) {
        topBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }


    /* =======================
       FADE-ITEM (kategorije)
    ======================= */
    const fadeItems = document.querySelectorAll(".fade-item");

    if (fadeItems.length) {
        const fadeItemObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                    fadeItemObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        fadeItems.forEach(item => fadeItemObserver.observe(item));
    }


    /* =======================
       FADE-SECTION (hero, slider)
    ======================= */
    const fadeSections = document.querySelectorAll(".fade-section");

    function checkFade() {
        const trigger = window.innerHeight * 0.85;

        fadeSections.forEach(sec => {
            if (sec.getBoundingClientRect().top < trigger) {
                sec.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", checkFade);
    checkFade();


    /* =======================
       HIGHLIGHT SLIDER
    ======================= */
    const track = document.querySelector(".highlight-slider");
    const wrapper = document.querySelector(".highlight-slider-wrapper");

    if (track && wrapper) {
        const slides = Array.from(track.querySelectorAll(".highlight-slide"));
        const next = document.querySelector(".highlight-next");
        const prev = document.querySelector(".highlight-prev");
        const dotsContainer = document.querySelector(".highlight-dots");

        let index = 0;

        // Kreiraj tačkice
        slides.forEach((_, i) => {
            const dot = document.createElement("button");
            if (i === 0) dot.classList.add("active");
            dotsContainer.appendChild(dot);

            dot.addEventListener("click", () => {
                index = i;
                updateSlider();
            });
        });

        const dots = dotsContainer.querySelectorAll("button");

        function updateSlider() {
            // svaki slajd je 100% širine track-a ⇒ 100% po slajdu
            track.style.transform = `translateX(-${index * 100}%)`;

            dots.forEach(d => d.classList.remove("active"));
            dots[index].classList.add("active");
        }

        // Navigacija
        next.addEventListener("click", () => {
            index = (index + 1) % slides.length;
            updateSlider();
        });

        prev.addEventListener("click", () => {
            index = (index - 1 + slides.length) % slides.length;
            updateSlider();
        });

        window.addEventListener("resize", updateSlider);
        updateSlider();
    }

});

    /* =======================
       Category fade in
    ======================= */

document.addEventListener("DOMContentLoaded", () => {
    const faders = document.querySelectorAll(".fade-in");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, { threshold: 0.3 });

    faders.forEach(f => observer.observe(f));
});

document.addEventListener("DOMContentLoaded", () => {
    // ===== KATALOG: UČITAJ JOŠ PROIZVODA =====
    const loadMoreBtn = document.getElementById("catalogLoadMore");

    if (loadMoreBtn) {
        const cards = Array.from(document.querySelectorAll(".product-card"));
        let visible = 8; // isti broj kao u PHP-u

        loadMoreBtn.addEventListener("click", () => {
            visible += 8;
            cards.slice(0, visible).forEach(card => {
                card.classList.remove("is-hidden");
            });

            if (visible >= cards.length) {
                loadMoreBtn.style.display = "none";
            }
        });
    }

});

/* =======================
       Brands fade in
    ======================= */
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".fade-in");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    items.forEach(item => observer.observe(item));
});



</script>

<?php wp_footer(); ?>
</div>

</body>
</html>