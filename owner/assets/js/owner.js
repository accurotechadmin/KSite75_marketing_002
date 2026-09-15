(function () {
    const cards = document.querySelectorAll('.component-card');
    cards.forEach((card, index) => {
        card.style.setProperty('--component-index', index.toString());
    });

    document.querySelectorAll('[data-page]').forEach((body) => {
        body.classList.add('js-ready');
    });
}());
