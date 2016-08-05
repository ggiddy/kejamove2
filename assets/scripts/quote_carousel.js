/**
 * THis script runs the carousel that displays the quote to the customer.
 */
$(document).ready( function() {
    var clickEvent = false;

    $('#addons_proceed').on('click', function(){
        clickEvent = false;
        $('.nav li').removeClass('active');
        $('#addons').addClass('active');
        $('#dispatch_anchor')[0].click();
    });

    $('#options_carousel').on('click', '.nav a', function() {
        clickEvent = false;
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active');
    });
});