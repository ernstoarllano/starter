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

(function ($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function () {
        // JavaScript to be fired on all pages
        var viewportWidth = $(window).width();

        // Fastclick
        FastClick.attach(document.body);

        // Remove empty p tags
        $('p:empty').remove();

        // External links
        $('a').filter(function () {
          return this.hostname && this.hostname !== location.hostname;
        }).addClass('is-external').attr('target', '_blank');

        // Navigation
        /*
        $('.js-toggle-nav').click(function (e) {
          e.preventDefault();

          $('.header').toggleClass('is-visible');
        });

        // Dropdown
        $('.js-toggle-dropdown').click(function (e) {
          e.preventDefault();

          $(this).parent().toggleClass('is-expanded').siblings().removeClass('is-expanded');
        });
        */

        // Initiate lazy load
        //new LazyLoad();
      },
      finalize: function () {
        // JavaScript to be fired on all pages, after page specific JS is fired
        var viewportWidth = $(window).width();
        var maxViewport = 1024;

        /*
        // Hero background
        var hero = $('.hero');
        var heroMobileBG = hero.data('mobile');
        var heroDesktopBG = hero.data('desktop');

        if (viewportWidth < maxViewport) {
          hero.css('background-image', 'url(' + heroMobileBG + ')');
        } else {
          hero.css('background-image', 'url(' + heroDesktopBG + ')');
        }

        // Detect window scroll
        var jsScrollCheck = $('.js-scroll-check');

        $('window').on('scroll', function() {
          var viewportTop = $(window).scrollTop();
          var viewportBottom = viewportTop + $(this).height();

          // Add class to body
          if (viewportTop > 1) {
            $('body').addClass('is-scrolling');
          } else {
            $('body').removeClass('is-scrolling');
          }

          // Detect if element is visible in viewport
          jsScrollCheck.each(function () {
            var jsScrollCheckTop = $(this).offset().top;

            if (jsScrollCheckTop < viewportBottom) {
              $(this).addClass('is-visible');
            }
          });
        });
        */
      }
    },
    // Home page
    'home': {
      init: function () {
        // JavaScript to be fired on the home page
      },
      finalize: function () {
        // JavaScript to be fired on the home page, after the init JS
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
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
    loadEvents: function () {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
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
