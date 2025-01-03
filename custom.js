// (function() {
//     // Add event listener
//     document.addEventListener("mousemove", parallax);
//     const elem = document.querySelector("#parallex");
//     // Magic happens here
//     function parallax(e) {
//         let _w = window.innerWidth/2;
//         let _h = window.innerHeight/2;
//         let _mouseX = e.clientX;
//         let _mouseY = e.clientY;
//         let _depth1 = `${50 - (_mouseX - _w) * 0.01}%`;
//         let _depth2 = `${50 - (_mouseX - _w) * 0.02}%`;
//         let x = `${_depth2}, ${_depth1}`;
//         console.log(x);
//         elem.style.backgroundPosition  = x;
//         // console.log(elem.style.backgroundPosition);
//     }

// })();
var currentX = '';
var currentY = '';
var movementConstant = .025; 

jQuery(document).mousemove(function(e) {
  if (currentX == '') currentX = e.pageX;
  var xdiff = e.pageX - currentX;
  currentX = e.pageX;
  if (currentY == '') currentY = e.pageY;
  var ydiff = e.pageY - currentY;
  currentY = e.pageY;

  jQuery('.fl-col-content .parallex-img').each(function(i, el) {
    var movement = (i + 1) * (xdiff * movementConstant);
    var movementy = (i + 1) * (ydiff * movementConstant);
    var newX = jQuery(el).position().left + movement;
    var newY = jQuery(el).position().top + movementy;
    var cssObj = {
      'left': newX + 'px',
      'top': newY + 'px'
    };

    // $(el).css('left', newX + 'px');
    // $(el).css('top', newY + 'px');
    jQuery(el).css({
      "transform": "translate(" + newX + "px," + newY + "px)"
    });
  });
});


jQuery(document).ready(function() {
    jQuery('#vertical').lightSlider({
      gallery:true,
      item:1,
      auto:false,
      loop:false,
      vertical:true,
      slideEndAnimation: true,
      pager: true,
      currentPagerPosition: 'middle',
      verticalHeight:295,
      vThumbWidth:50,
      thumbItem:8,
      thumbMargin:4,
      slideMargin:0,
      freeMove:true,
      onBeforeStart: function (el) {},
        onSliderLoad: function (el) {},
        onBeforeSlide: function (el) {},
        onAfterSlide: function (el) {},
        onBeforeNextSlide: function (el) {},
        onBeforePrevSlide: function (el) {}
    });  
  });



// New Custom Hero section Zoom on scroll js code
jQuery(document).ready(function(){
   var currentURL = window.location.href;
   var welcomeSec = jQuery(".welcome .fl-row-content-wrap");
   console.log(welcomeSec);
   console.log("Outer : "+ currentURL);
  // Check if the current URL contains the excluded parameters
  if (currentURL.indexOf("fl_builder") === -1) {

   console.log("Inner : "+ currentURL);
    jQuery(window).scroll(function() {
      var scrollTop = jQuery(window).scrollTop();
      var scale = 1 + (scrollTop / 1500); // Adjust the scale factor as needed

      jQuery(".custom-hero-bg .fl-col-content")
        .css("opacity", 1 - scrollTop / 700)
        .css("transform", "scale(" + scale + ")");
    });

    jQuery(window).scroll(function() {
      var scrollTop = jQuery(window).scrollTop();
      var scale = 1 + (scrollTop / 1500); // Adjust the scale factor as needed

      jQuery(".custom-hero-content")
        .css("opacity", 1 - scrollTop / 450);
    });

    jQuery(window).scroll(function() {
      var scrollTop = jQuery(window).scrollTop();
      var scale = 1 + (scrollTop / 150); // Adjust the scale factor as needed

      jQuery(".custom-hero-front-img .fl-col-content")
        .css("transform", "scale(" + scale + ")");
    });
  }  
});



// New Custom Hero section Zoom on scroll js code will not affect on the builder edit









