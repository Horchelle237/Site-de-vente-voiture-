/* ============================================================
   EUROAUTO - JS principal
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Initialisation AOS (animations au scroll)
    if (window.AOS) {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic',
            offset: 50,
        });
    }

    // 2. Navbar : effet "scrolled"
    const navbar = document.getElementById('mainNavbar');
    const handleScroll = () => {
        if (window.scrollY > 30) {
            navbar?.classList.add('scrolled');
        } else {
            navbar?.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    // 3. Bouton retour en haut
    const backTopBtn = document.getElementById('backToTop');
    if (backTopBtn) {
        const toggleBackTop = () => {
            backTopBtn.classList.toggle('visible', window.scrollY > 400);
        };
        window.addEventListener('scroll', toggleBackTop, { passive: true });
        backTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 4. Compteurs animés (stats)
    const counters = document.querySelectorAll('[data-counter]');
    if (counters.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.4 });
        counters.forEach(el => observer.observe(el));
    }

    function animateCounter(el) {
        const target = parseInt(el.dataset.counter, 10);
        const duration = 1500;
        const start = performance.now();
        const startVal = 0;
        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
            el.textContent = Math.floor(startVal + (target - startVal) * eased).toLocaleString('fr-FR');
            if (progress < 1) requestAnimationFrame(tick);
            else el.textContent = target.toLocaleString('fr-FR');
        }
        requestAnimationFrame(tick);
    }

    // 5. Galerie miniatures (page détail)
    const thumbs = document.querySelectorAll('.detail-thumb');
    const mainImg = document.querySelector('.detail-gallery img');
    if (thumbs.length && mainImg) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', () => {
                const newSrc = thumb.querySelector('img').src;
                mainImg.style.opacity = '0.4';
                setTimeout(() => {
                    mainImg.src = newSrc;
                    mainImg.style.opacity = '1';
                }, 200);
                thumbs.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });
        });
    }

    // 6. Validation formulaires (HTML5 + visuelle)
    document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // 7. Étoiles cliquables (avis)
    const ratingInput = document.querySelector('input[name="note"]');
    const ratingStars = document.querySelectorAll('.rating-star');
    ratingStars.forEach(star => {
        star.addEventListener('click', () => {
            const val = parseInt(star.dataset.value, 10);
            if (ratingInput) ratingInput.value = val;
            ratingStars.forEach((s, idx) => {
                s.classList.toggle('bi-star-fill', idx < val);
                s.classList.toggle('bi-star',      idx >= val);
            });
        });
        star.addEventListener('mouseenter', () => {
            const val = parseInt(star.dataset.value, 10);
            ratingStars.forEach((s, idx) => {
                s.classList.toggle('text-warning', idx < val);
            });
        });
        star.addEventListener('mouseleave', () => {
            ratingStars.forEach(s => s.classList.remove('text-warning'));
        });
    });

    // 8. Confirmations de suppression admin
    document.querySelectorAll('[data-confirm]').forEach(link => {
        link.addEventListener('click', (e) => {
            const message = link.dataset.confirm || 'Êtes-vous sûr ?';
            if (!confirm(message)) e.preventDefault();
        });
    });

});

/* ============================================================
   Compléments — étoiles cliquables (.star-rating) et confirm
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {

    // Étoiles cliquables sur la page témoignages
    const starWidget = document.querySelector('.star-rating');
    if (starWidget) {
        const stars      = starWidget.querySelectorAll('i');
        const noteInput  = document.getElementById('note');
        const setVisual  = (val) => {
            stars.forEach((s, idx) => {
                s.classList.toggle('bi-star-fill', idx < val);
                s.classList.toggle('bi-star',      idx >= val);
                s.classList.toggle('active',       idx < val);
            });
        };
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const val = parseInt(star.dataset.value, 10);
                if (noteInput) noteInput.value = val;
                starWidget.dataset.rating = val;
                setVisual(val);
            });
            star.addEventListener('mouseenter', () => {
                setVisual(parseInt(star.dataset.value, 10));
            });
        });
        starWidget.addEventListener('mouseleave', () => {
            setVisual(parseInt(starWidget.dataset.rating || '0', 10));
        });
    }

    // Confirmation suppression — variante avec data-confirm-message
    document.querySelectorAll('.js-confirm-delete').forEach(el => {
        el.addEventListener('click', (e) => {
            const msg = el.dataset.confirmMessage || 'Confirmer la suppression ?';
            if (!confirm(msg)) e.preventDefault();
        });
    });
});
