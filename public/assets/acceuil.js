$(document).ready(function() {
    // Transition effect for navbar
    scrollEvent()
    $(window).scroll(function() {
        // checks if window is scrolled more than 500px, adds/removes solid class
        scrollEvent()
    });


    function scrollEvent() {
        if($(this).scrollTop() > 500) {
            $('.navbar').addClass('solid');
            $('.navbar').css({ background: '#ffc107'});
        } else {
            $('.navbar').removeClass('solid');
            $('.navbar').css({ background: 'transparent' });
        }
    }
});