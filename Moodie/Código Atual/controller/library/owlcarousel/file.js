// var owl = $('.owl-carousel');

$('.owl-carousel').owlCarousel({    
    margin: 8,    
    nav:false,    
    responsive:{
        0:{
            loop:false,
            items:2,
            stagePadding: 30,
            autoplay:false
        },
        576:{
            loop:true,
            items:3,
            autoplay:false,
            stagePadding: 50
        },
        768:{
            loop:true,
            items:4,
            autoplay:false,
            stagePadding: 50
        },
        992:{
            loop:true,
            items:4,
            autoplay:false,
            stagePadding: 50
        },
        1000:{
            loop:true,
            items:3,
            autoplay:false,
            stagePadding: 50
        },
        1200:{
            loop:true,
            items:4,
            autoplay:false,
            stagePadding: 50
        }
    }
});

// owl.on('mousewheel', '.owl-stage', function (e) {
//     if (e.deltaY>0) {
//         owl.trigger('next.owl');
//     } else {
//         owl.trigger('prev.owl');
//     }
//     e.preventDefault();
// });