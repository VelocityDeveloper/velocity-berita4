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
});