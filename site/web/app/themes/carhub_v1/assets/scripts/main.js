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
        $(window).scroll(function(){
          scrollTop = $(window).scrollTop();
           $('.counter').html(scrollTop);

          if (scrollTop >= 100) {
            $('.navbar').addClass('scrolled-nav');
          } else if (scrollTop < 100) {
            $('.navbar').removeClass('scrolled-nav');
          }

        });


      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page


          $.ajaxSetup({cache:false});
        var $openform = $('.openform');
        $openform.click(function(){
        var $this = $(this);
        var post_url = $this.attr('data-href');
        var post_name = $this.attr('data-car-choise');
        TweenLite.to(window, 1, {scrollTo:{y:".feedback", offsetY:160}});
        $(".feedback").html('<div class="loading">loading...</div>');
        //$('.feedback').load('http://carhub.dev/web/app/themes/carhub_v1/woocommerce-bookings/single-product/add-to-cart/booking.php');
        $('selected').html(post_name);
        });

        $('.dropdown-item').click(function(){
        $('.chosen').html($(this).text() + '<span class="caret"></span>');
        });
          $('.js-example-basic-single').select2({ width: '100%' });
        $(".openform").click(function(){
          //TweenMax.fromTo( $(".paralsec"), 1.2, {css: {backgroundSize: "100% 80%"}}, {css:{backgroundSize: "100% 41%" }, ease: Elastic.easeOut.config(1, 0.3) }) ;
        //  TweenMax.fromTo( $(".forma"), 1.2, {css: {display: "none"}}, {css:{display: "block" }, ease: Elastic.easeOut.config(1, 0.3) }) ;
            });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
        jQuery(document).ready(function ($) {
            var is_sending = false,
                failure_message = 'Whoops, looks like there was a problem. Please try again later.';

            $('#contact-form').submit(function (e) {
              if (is_sending || !validateInputs()) {
                return false; // Don't let someone submit the form while it is in-progress...
              }
              e.preventDefault(); // Prevent the default form submit
              var $this = $(this); // Cache this
              $.ajax({
                url: '<?php echo admin_url("admin-ajax.php") ?>', // Let WordPress figure this url out...
                type: 'post',
                dataType: 'JSON', // Set this so we don't need to decode the response...
                data: $this.serialize(), // One-liner form data prep...
                beforeSend: function () {
                  is_sending = true;
                  // You could do an animation here...
                },
                error: handleFormError,
                success: function (data) {
                  if (data.status === 'success') {
                    // Here, you could trigger a success message
                  } else {
                    handleFormError(); // If we don't get the expected response, it's an error...
                  }
                }
              });
            });

            function handleFormError () {
              is_sending = false; // Reset the is_sending var so they can try again...
              alert(failure_message);
            }

            function validateInputs () {
              var $name = $('#contact-form > input[name="name"]').val(),
                  $email = $('#contact-form > input[name="email"]').val(),
                  $message = $('#contact-form > textarea').val();
              if (!$name || !$email || !$message) {
                alert('Before sending, please make sure to provide your name, email, and message.');
                return false;
              }
              return true;
            }
          });
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
