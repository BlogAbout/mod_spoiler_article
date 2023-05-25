jQuery(document).ready(function ($) {
    $('.mount-sys > .mount-article > .article-title').click(function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active')
            $(this).siblings('.article-content').slideUp()
        } else {
            $(this).parent().addClass('active')
            $(this).siblings('.article-content').slideDown()

            $('.mount-sys > .mount-article > .article-title')
                .not($(this))
                .siblings('.article-content').slideUp()
                .parent().removeClass('active')
        }
    })
})