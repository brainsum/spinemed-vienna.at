
$(document).ready(function() {

	// SLIDERS PLUGIN
	///////////////////////

	// $('.why-good-slider').unslider();
	// $('.how-it-works-slider').unslider();



});


// any button animation

$(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
         if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
             var target = $(this.hash);
             target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
             if (target.length) {
                 $('html, body').animate({
                     scrollTop: target.offset().top
                 }, 800);
                 return false;
             }
         }
    });
});

//Navigation active class

function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);

    $(".top-menu a, .footer-menu a").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $(this).closest('li').addClass('is-active');
        }
    });
}

$(function () {
    setNavigation();
});

//hamburger menu
$(function () {
    if($(window).width() < 992){
        $('.navbar-header').on('click touchstart', function (e) {
            $('ul.top-menu').toggleClass('menu-active');
            e.preventDefault();
        });
    }
    $(window).on("resize", function () {
        if ($(window).width() > 991) {
            $('ul.top-menu').removeClass('menu-active');
        }
    }).resize();
});
