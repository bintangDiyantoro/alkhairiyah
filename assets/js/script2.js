$(function () {

    const title = $('title').html().split(' ')[3]
    const navlink = $('a:contains(' + title + ')')
    const fill = $('.fill')
    const success = $('.success').val()
    const postimg = $('.image-style-side').children('img')
    const postimgwide = $('.image').not('.image-style-side').children('img')


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

    postimg.attr('align', 'right')
    postimg.css({
        "width": "50%",
        "margin-left": "20px"
    })

    postimgwide.attr('align','center')
    postimgwide.css({
        "display": "block",
        "margin": "auto",
        "width": "70%"
    })

})