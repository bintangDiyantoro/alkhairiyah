$(function(){
    
    const title = $('title').html().split(' ')[3]
    const navlink = $('a:contains('+title+')')
    const fill = $('.fill')
    const success = $('.success').val()

    navlink.addClass('active')

    if (fill.val()) {
        const len = fill.val().length
        fill[0].focus()
        fill[0].setSelectionRange(len, len)
    }

    if (success) {
        Swal.fire({
            type: 'success',
            title: 'Berhasil!',
            html: success
        })
    }

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