$(document).ready(function(){
    $('.bigdiv ul li').each(function(){
        $(this).on("click",function(){
            $(this).addClass("active").siblings().removeClass("active")
            $(".parent").children().addClass('hide') ;
            $($(this).data('value')).addClass("animate__animated animate__fadeIn").removeClass('hide')
            
        })
    })
})