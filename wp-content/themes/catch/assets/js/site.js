//=require picturefill/dist/picturefill.min.js

//=require owl.carousel/dist/owl.carousel.min.js

//=require formstone/dist/js/core.js
//=require formstone/dist/js/background.js
//=require formstone/dist/js/checkpoint.js
//=require formstone/dist/js/mediaquery.js
//=require formstone/dist/js/navigation.js
//=require formstone/dist/js/swap.js
//=require formstone/dist/js/transition.js

document.createElement( "picture" );

(function($) {

  Formstone.Ready(function() {
    var $homeSlider = $(".js-home_slider").owlCarousel({
      items: 1,
      // margin: 10,
      autoHeight: true,
      loop: true,
      center: true,
      smartSpeed: 500
    });
    $(".js-home_slider").on("click", ".js-slider_previous, .js-slider_next", function(e) {
      var $target = $(e.currentTarget);
      var direction = $target.hasClass("js-slider_previous") ? 'prev' : 'next';

      $homeSlider.trigger(direction + '.owl.carousel');
    });

    $('.page_header-slider').owlCarousel({
      items: 1,
      animateOut: 'fadeOut',
      autoplay: true,
      loop: true,
      mouseDrag: false,
    });

    $(".js-background").background();
    $(".js-checkpoint, [data-checkpoint-animation]").checkpoint({
      offset: 200,
      reverse: true
    });
    $(".js-navigation").navigation();
    $(".js-swap").swap();

    $.mediaquery("bind", "mq-key", "(min-width: 980px)", {
      enter: function() {
        $(".js-sidebar_bottom").contents().appendTo(".js-sidebar_top");
      },
      leave: function() {
        $(".js-sidebar_top").contents().appendTo(".js-sidebar_bottom");
      }
    });

    $(".js-social_links").appendTo($(".footer .js-social_links_target"));
  });

})(jQuery);
