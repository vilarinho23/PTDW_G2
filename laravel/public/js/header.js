$(document).ready(function() {
    $('#wrapper').show();

    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

    trigger.click(function() {
        hamburger_cross();
    });

    $(window).resize(function() {
        checkWindowSize();
    });

    function checkWindowSize() {
        var windowWidth = $(window).width();

        if (windowWidth > 1200 && isClosed == true) {
            trigger.trigger('click');
        }
    }

    function hamburger_cross() {

        if (isClosed == true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function() {
        $('#wrapper').toggleClass('toggled');
    });
});
