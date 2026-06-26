jQuery(function($) {

    $('.slick-related').flickity({
        cellAlign: 'left',
        groupCells: true,
        autoPlay: true,
        autoPlay: 2000,
        wrapAround: true,
        lazyLoad: true,
        pageDots: false
    });

    $('.slick-post').flickity({
        cellAlign: 'left',
        groupCells: true,
        autoPlay: true,
        autoPlay: 2000,
        wrapAround: true,
        lazyLoad: true,
        pageDots: false,
        // prevNextButtons: false,
    });

    document.addEventListener('click', function(event) {
        var toggle = event.target.closest('#navbarNavOffcanvas .dropdown-toggle, #secondaryNavOffcanvas .dropdown-toggle');
        if (!toggle) {
            return;
        }

        var dropdown = toggle.closest('.dropdown');
        var submenu = null;
        if (dropdown) {
            for (var i = 0; i < dropdown.children.length; i++) {
                if (dropdown.children[i].classList.contains('dropdown-menu')) {
                    submenu = dropdown.children[i];
                    break;
                }
            }
        }
        if (!submenu) {
            return;
        }

        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        var isOpen = submenu.classList.contains('show');
        submenu.classList.toggle('show', !isOpen);
        toggle.classList.toggle('show', !isOpen);
        toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    }, true);
});
