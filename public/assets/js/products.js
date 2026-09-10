document.addEventListener('DOMContentLoaded', function () {
    // Card entrance animation
    const cards = document.querySelectorAll('.product-card');
    cards.forEach((card, index) => {
        card.animate([
            { transform: 'translateY(18px)', opacity: 0 },
            { transform: 'translateY(0)', opacity: 1 }
        ], {
            duration: 420 + (index * 70),
            easing: 'cubic-bezier(.2,.8,.2,1)'
        });
    });

    // Form submission loading state
    const forms = document.querySelectorAll('form[data-live-form]');
    forms.forEach((form) => {
        form.addEventListener('submit', function () {
            const submit = form.querySelector('button[type="submit"]');
            if (submit) {
                submit.disabled = true;
                submit.innerHTML = '<span class="loader-inline"></span> Processing...';
                submit.classList.add('btn-loading');
            }
        });
    });

    // Link navigation loading state
    const productLinks = document.querySelectorAll('a[href*="/products"]');
    productLinks.forEach((link) => {
        link.addEventListener('click', function (e) {
            // Only show loader for actual navigation links, not delete confirmations
            if (!link.hasAttribute('onclick') || !link.getAttribute('onclick').includes('confirm')) {
                showPageLoader();
            }
        });
    });

    // Show loader on page unload (when form submits or links are clicked)
    window.addEventListener('beforeunload', function () {
        showPageLoader();
    });
});

// Global page loader
function showPageLoader() {
    let loader = document.getElementById('page-loader');
    if (!loader) {
        loader = document.createElement('div');
        loader.id = 'page-loader';
        loader.className = 'page-loader';
        loader.innerHTML = `
            <div class="loader-content">
                <div class="loader-spinner"></div>
                <p>Loading...</p>
            </div>
        `;
        document.body.appendChild(loader);
    }
    loader.classList.add('active');
}

function hidePageLoader() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.classList.remove('active');
    }
}

// Hide loader when page is fully loaded
window.addEventListener('load', hidePageLoader);

