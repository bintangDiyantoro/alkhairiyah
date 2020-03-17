$(function(){
    
    const title = $('title').html().split(' ')[3]
    const navlink = $('a:contains('+title+')')
    
    navlink.addClass('active')



})
$(window).scroll(()=>{
    var scroll = $(window).scrollTop();
    if(scroll > 70){
        $('.navbar').addClass('anu');
    }else{
        $('.navbar').removeClass('anu');
    }

    document.querySelector('.container-fluid').style.marginTop = (-80 - 0.5*scroll) + "px";
})