//  1. Count


(function($) {
  $.fn.countTo = function(options) {
    options = options || {};

    return $(this).each(function() {
      // set options for current element
      var settings = $.extend(
        {},
        $.fn.countTo.defaults,
        {
          from: $(this).data("from"),
          to: $(this).data("to"),
          speed: $(this).data("speed"),
          refreshInterval: $(this).data("refresh-interval"),
          decimals: $(this).data("decimals")
        },
        options
      );

      // how many times to update the value, and how much to increment the value on each update
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
        increment = (settings.to - settings.from) / loops;

      // references & variables that will change with each update
      var self = this,
        $self = $(this),
        loopCount = 0,
        value = settings.from,
        data = $self.data("countTo") || {};

      $self.data("countTo", data);

      // if an existing interval can be found, clear it first
      if (data.interval) {
        clearInterval(data.interval);
      }
      data.interval = setInterval(updateTimer, settings.refreshInterval);

      // initialize the element with the starting value
      render(value);

      function updateTimer() {
        value += increment;
        loopCount++;

        render(value);

        if (typeof settings.onUpdate == "function") {
          settings.onUpdate.call(self, value);
        }

        if (loopCount >= loops) {
          // remove the interval
          $self.removeData("countTo");
          clearInterval(data.interval);
          value = settings.to;

          if (typeof settings.onComplete == "function") {
            settings.onComplete.call(self, value);
          }
        }
      }

      function render(value) {
        var formattedValue = settings.formatter.call(self, value, settings);
        $self.html(formattedValue);
      }
    });
  };

  $.fn.countTo.defaults = {
    from: 0, // the number the element should start at
    to: 0, // the number the element should end at
    speed: 1000, // how long it should take to count between the target numbers
    refreshInterval: 100, // how often the element should be updated
    decimals: 0, // the number of decimal places to show
    formatter: formatter, // handler for formatting the value before rendering
    onUpdate: null, // callback method for every time the element is updated
    onComplete: null // callback method for when the element finishes updating
  };

  function formatter(value, settings) {
    return value.toFixed(settings.decimals);
  }
})(jQuery);

jQuery(function($) {
  // custom formatting example
  $(".count-number").data("countToOptions", {
    formatter: function(value, options) {
      return value
        .toFixed(options.decimals)
        .replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
    }
  });

  // start all the timers
  $(".timer").each(count);

  function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data("countToOptions") || {});
    $this.countTo(options);
  }
});


/* 2. logodata */ 
jQuery(document).ready(function($){
    $('.logodata').owlCarousel({
    loop:true,
    dot:false,
    nav:false,
    autoplay:true,
    autoplayTimeout:3000,
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        800:{
            items:3
        },
        1000:{
            items:4
        },
        1400:{
            items:5
        }
      }
    })
  }) ;

/* 3. accordion */
    $('.accordion-item .heading').on('click', function(e) {
        e.preventDefault();

        // Add the correct active class
        if($(this).closest('.accordion-item').hasClass('active')) {
            // Remove active classes
            $('.accordion-item').removeClass('active');
        } else {
            // Remove active classes
            $('.accordion-item').removeClass('active');

            // Add the active class
            $(this).closest('.accordion-item').addClass('active');
        }

        // Show the content
        var $content = $(this).next();
        $content.slideToggle(100);
        $('.accordion-item .content').not($content).slideUp('fast');
    });


    // 4. stickyHeader

  if ($("#stickyHeader")[0]){
 
    var new_scroll_position = 0;

        var last_scroll_position;

        var header = document.getElementById("stickyHeader");



        window.addEventListener('scroll', function(e) {

        last_scroll_position = window.scrollY;



        if (new_scroll_position < last_scroll_position && last_scroll_position > 100) {

        

          header.classList.remove("slideUp");

          header.classList.add("slideUp");




        } 

        else if (last_scroll_position < 100) {

          header.classList.remove("slideUp");

        } 

        else if (new_scroll_position > last_scroll_position) {

          header.classList.remove("slideUp");

          header.classList.add("slideUp");

        }



          new_scroll_position = last_scroll_position;

        });
      }



/* 5. back to top button */ 

var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
