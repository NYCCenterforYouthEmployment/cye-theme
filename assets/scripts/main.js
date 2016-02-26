/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
		
		$('#menulink').click(function(event) {
			event.preventDefault();
			if($('.nav-primary').hasClass('show-menu')) {
				$('.nav-primary').removeClass('show-menu');
				$('.nav').hide();
				$('.nav li').removeClass('small-padding');
				$('#menulink .hamburger-wrapper .hamburger').css({"color": "#333"});
				$('.home #menulink .hamburger-wrapper .hamburger').css({"color": "#fff"});
				$('.brand a').css({"color": "#333"});
			} else {
				$('.nav-primary').addClass('show-menu');
				$('.nav').fadeIn();
				$('.nav li').addClass('small-padding');
				$('#menulink .hamburger-wrapper .hamburger').css({"color": "#fff"});
				$('.brand a').css({"color": "#fff"});
				//$('.nav-supplemental ul li a').css({"color": "#fff", "border-color": "#fff"});
		   }
		});
		
		//Sticky footer
        //http://blog.mojotech.com/responsive-dynamic-height-sticky-footers/
        var bumpIt = function() {
          $('body').css('margin-bottom', $('footer.content-info').height()+200);
		  
        },
        didResize = false;

        bumpIt();

        $(window).resize(function() {
          didResize = true;
        });
         setInterval(function() {
          if(didResize) {
            didResize = false;
            bumpIt();
          }
        }, 250);
        //END sticky
		
		
		
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
		function parallax(){
			var scrolled = $(window).scrollTop();
    		$('header.banner.home .hero-content-wrapper').css('top', +(scrolled * 0.2) + 'px');
		}
		$(window).scroll(function(e){
			parallax();
		});


      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
