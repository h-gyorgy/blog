$('.comment-header').click(function(){
    if($(this).hasClass('open')){
        $(this).find('.arrow').removeClass('rotate');
        $(this).siblings('.comment-body').slideUp();
        $(this).removeClass('open');
    }else{
        $(this).find('.arrow').addClass('rotate');
        $(this).siblings('.comment-body').slideDown();
        $(this).addClass('open');
    }
});

$('.submit').click(function(){
    setTimeout(() => {
        $(".submit").attr("disabled", true);
    }, 1); 
});

$('input, textarea').focusin(function(){
    $(".submit").attr("disabled", false);
});