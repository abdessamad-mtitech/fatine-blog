$(document).ready(function () {
    

    $('.owl-carousel-images').owlCarousel({
        items:1,
        merge:true,
        loop:true,
        center:true,
        dots: false,
        responsive:{
            480:{
                items:2
            },
            600:{
                items:4
            }
        },
        margin: 50,
        nav: true,
        navText: ["",""],
        navContainer: ".img.navigation"
    })  


    $('.owl-carousel-video').owlCarousel({
        items:1,
        merge:true,
        loop:true,
        video:true,
        lazyLoad:false,
        center:true,
        dots: false,
        responsive:{
            480:{
                items:2
            },
            600:{
                items:4
            }
        },
        margin: 40,
        nav: true,
        navText: ["",""],
        navContainer: ".vid.navigation"
    });

    // $('.owl-item.active.center').prev().prev().css('opacity','0');
    // $('.owl-item.active.center').next().next().css('opacity','0');

    // $('#images .navigation .owl-next, #images .navigation .owl-prev').click(function() {
    //     $('#images .owl-item').animate({ opacity : '1'}, 200);
    //     setTimeout(function() {
    //         $('#images .owl-item.active.center').prev().prev().animate({ opacity : '0'}, 200);
    //         $('#images .owl-item.active.center').next().next().animate({ opacity : '0'}, 200);
    //     }, 200);
    // });

});