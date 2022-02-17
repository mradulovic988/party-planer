jQuery(document).ready(function ($) {
    const result = $('#pp-calculated');

    if ($(result).length > 0) {
        $('html, body').animate({
            scrollTop: result.offset().top
        }, 1000);
    }
});