                            var destaqueProdutos = $('#destaqueProdutos').owlCarousel({
                                    loop:false,
                                    margin:32,
                                    items: 4.5,
                                    autoplay: true,
                                    center: true,
                                    navText: [
                                        '<img src="images/esquerda.png" alt="Banner anterior">',
                                        '<img src="images/direita.png" alt="Próximo banner">'
                                    ], 
                                    navContainer: '.custom-nav-banner2',
                                    autoplayTimeout:6500,
                                    dotsContainer: '#carousel-custom-dots',
                                    autoplayHoverPause:true,
                                    responsive:{
                                            0:{
                                                items:1.5,
                                                margin:10
                                            },
                                            600:{
                                                items:2.5,
                                                margin:10
                                            },
                                            900:{
                                                items:2.5,
                                                margin:20
                                            },
                                            1200:{
                                                margin:32,
                                                items: 4.5,
                                            }
                                    }                                          
                            });

                            // AGORA TEMOS ATÉ DOTS!!!
                            $('.owl-dot').click(function () {
                               superBanner.trigger('to.owl.carousel', [$(this).index(), 300]);
                            });



                            var depoimentos = $('#depoimentos').owlCarousel({
                                    loop:true,
                                    margin:0,
                                    items: 1,
                                    autoplay: true,
                                    center: true,
                                    navText: [
                                        '<img src="images/esquerda.png" alt="Banner anterior">',
                                        '<img src="images/direita.png" alt="Próximo banner">'
                                    ], 
                                    navContainer: '.custom-nav-banner3',
                                    autoplayTimeout:6500,
                                    
                                    autoplayHoverPause:true,
                                                                             
                            });





function mudarDemoVideo(seletor){
    
    $("section.demo ul li").removeClass("ativo");
    $(seletor).parent().addClass("ativo");

}


// MENU FIXO NAS PÁGINAS INTERNA
jQuery(document).ready(function ($) {
  
  var entreiAnimateNumber = 0;
  
  $(window).scroll(function(){
     
     var scroll = $(window).scrollTop();
     
     if (scroll < 550){
         $("header.fixo").css("top","-100%");
     }

     if (scroll > 550){
         $("header.fixo").css("top","0px");
         //new WOW().init();
     }

  });

});


// ABRIR E FECHAR MENU CLIENTE
function abrirFecharMenuMobile(){

      if($(".menu-mobile-side").hasClass("aberto")){
         
        $(".menu-mobile-side").removeClass("aberto");
        
      }else{

        $(".menu-mobile-side").addClass("aberto");
        
      }

}

// ABRIR FECHAR NAVEGAÇÃO EM CURSO
function abrirFecharNavegacaoEmCurso(){

      if($(".sidebar-em-curso").hasClass("aberto")){
         
        $(".sidebar-em-curso").removeClass("aberto");
        
      }else{

        $(".sidebar-em-curso").addClass("aberto");
        
      }

}


