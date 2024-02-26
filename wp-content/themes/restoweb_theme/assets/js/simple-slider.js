function slider(id) {

    $ = jQuery;

    $('.checkbox').change(function(){
        setInterval(function () {
            moveRight();
        }, 3000);
    });
    
    var slideCount = $('#slider_' +id+ ' ul li').length;
    var slideWidth = $('#slider_' +id+ ' ul li').width();
    var slideHeight = $('#slider_' +id+ ' ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    
    $('#slider_' +id+ '').css({ width: slideWidth, height: slideHeight });
    $('#slider_' +id+ ' ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    $('#slider_' +id+ ' ul li:last-child').prependTo('#slider_' +id+ ' ul');
  
    /* $('a.control_prev').click(function () {
        moveLeft(id);
    });

    $('a.control_next').click(function () {
        moveRight(id);
    }); */
  
}

function moveLeft(id) {
    var slideWidth = $('#slider_' +id+ ' ul li').width();
    $('#slider_' +id+ ' ul').animate({
        left: + slideWidth
    }, 200, function () {
        $('#slider_' +id+ ' ul li:last-child').prependTo('#slider_' +id+ ' ul');
        $('#slider_' +id+ ' ul').css('left', '');
    });
};

function moveRight(id) {
    var slideWidth = $('#slider_' +id+ ' ul li').width();
    $('#slider_' +id+ ' ul').animate({
        left: - slideWidth
    }, 200, function () {
        $('#slider_' +id+ ' ul li:first-child').appendTo('#slider_' +id+ ' ul');
        $('#slider_' +id+ ' ul').css('left', '');
    });
};