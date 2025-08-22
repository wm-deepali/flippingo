/*---------------------------------------------
Template name:  Dirto
Version:        1.0
Author:          Flippingo
Author Email:   contact@tecydevs.com
----------------------------------------------*/

(function ($) {
    "use strict"; //use of strict
    var $window = $(window);

    $window.on('load', function () {

        var $document = $(document);
        var $dom = $('html, body');
        var preLoader =  $('.loader-container');

        /*==== Preloader =====*/
        preLoader.delay('500').fadeOut(2000);

        /*====  side-widget-menu  =====*/
        $document.on('click', '.sub-menu-toggler', function () {
            $(this).closest('li').siblings().removeClass('active').find('.off-canvas-sub-menu').slideUp(200);
            $(this).closest('li').toggleClass('active').find('.off-canvas-sub-menu').slideToggle(200);
            return false;
        });

        /*=========== Mobile Menu Open Control ============*/
        $document.on('click', '.side-menu-open', function () {
            $('.off-canvas').addClass('active');
        });

        /*=========== Mobile Menu Close Control ============*/
        $document.on('click', '.off-canvas-close', function () {
            $(".off-canvas, .side-user-panel").removeClass('active');
        });

        /*=========== Side user panel menu Open Control ============*/
        $document.on('click', '.side-user-menu-open', function () {
            $('.side-user-panel').addClass('active');
        });

        /*===== Back to Top Button and Navbar Scrolling Effects ======*/
        $window.on('scroll', function() {
            var mainHeader = $('.main-header');
            //header fixed animation and control
            if($window.scrollTop()) {
                mainHeader.addClass('fixed-top');
            }else{
                mainHeader.removeClass('fixed-top');
            }

            //back to top button control
            var backToTopButton = $('#back-to-top');
            if ($window.scrollTop() > 300) {
                backToTopButton.addClass('show-back-to-top');
            } else {
                backToTopButton.removeClass('show-back-to-top');
            }

            // skillbar
            $('.skillbar').each(function(){
                $(this).find('.skillbar-bar').animate({
                    width:$(this).attr('data-percent')
                },6000);
            });

        });

        /*===== back to top button click control ======*/
        $document.on("click", '#back-to-top', function() {
            $dom.animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        /*==== Preview video =====*/
        var previewVideo = $('[data-fancybox="preview-video"]');
        if (previewVideo.length) {
            previewVideo.fancybox();
        }

        /*==== card-carousel =====*/
        var cardCarousel = $('.card-carousel');
        if (cardCarousel.length) {
            cardCarousel.owlCarousel({
                loop: true,
                items: 3,
                nav: false,
                dots: true,
                smartSpeed: 700,
                autoplay: false,
                margin: 0,
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        items: 1
                    },
                    // breakpoint from 767 up
                    767 : {
                        items: 2
                    },
                    // breakpoint from 992 up
                    992 : {
                        items: 3
                    },
                    
                }
            });
        }

        /*==== Client logo =====*/
        var clientLogo = $('.client-logo');
        if (clientLogo.length) {
            clientLogo.owlCarousel({
                loop: true,
                items: 6,
                nav: false,
                dots: false,
                smartSpeed: 700,
                autoplay: true,
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        items: 1
                    },
                    // breakpoint from 425 up
                    425 : {
                        items: 2
                    },
                    // breakpoint from 480 up
                    480 : {
                        items: 2
                    },
                    // breakpoint from 767 up
                    767 : {
                        items: 4
                    },
                    // breakpoint from 992 up
                    992 : {
                        items: 6
                    }
                }
            });
        }

        /*==== testimonial-carousel =====*/
        var testimonialCarousel = $('.testimonial-carousel');
        if (testimonialCarousel.length) {
            testimonialCarousel.owlCarousel({
                loop: true,
                items: 1,
                nav: false,
                dots: true,
                smartSpeed: 700,
                autoplay: false,
                stagePadding: 30,
                margin: 80
            });
        }

        /*==== gallery-carousel =====*/
        var galleryCarousel = $('.gallery-carousel');
        if (galleryCarousel.length) {
            galleryCarousel.owlCarousel({
                loop: true,
                items: 1,
                nav: true,
                dots: false,
                smartSpeed: 700,
                autoplay: false,
                navText: ["<i class=\"fal fa-angle-left\"></i>", "<i class=\"fal fa-angle-right\"></i>"]
            });
        }

        /*==== Quantity number =====*/
        var qtyButtons = $('.qtyDec, .qtyInc');
        qtyButtons.on('click', function () {
            var $this = $(this);
            var oldValue = $this.parent().find('.qtyInput').val();

            if ($this.hasClass('qtyInc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // don't allow decrementing below zero
                if (oldValue > 0) {
                    newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $this.parent().find('.qtyInput').val(newVal);
        });

        /*==== Counter up =====*/
        var counterNumber = $('.counter');
        if (counterNumber.length) {
            counterNumber.counterUp({
                delay: 20,
                time: 2000
            });
        }

        /*====  Tooltip =====*/
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('[data-bs-toggle="tooltip"]').tooltip();

      
        /*==== select2  =====*/
               var selectPicker = $('.select-picker');
               if($(selectPicker)){
                $(selectPicker).select2({
                    minimumResultsForSearch: Infinity
                });
            }
       /*======= Date range select ========*/
       var datePicker = $('.date-picker');
       if (datePicker.length) {
           datePicker.daterangepicker({
               opens: 'left',
               singleDatePicker: true,
               autoApply: true,
               locale: {
                   format: 'DD-MM-YYYY'
               }
           });
       }

        /*=========== Lazy loading ============*/
        var lazyLoading = $('.lazy');
        if (lazyLoading.length) {
            lazyLoading.Lazy({
                effect: 'fadeIn',
            });
        }

        /*==== Copy to clipboard =====*/
        $document.on('click', '.copy-btn', function(){
            var copyInput = $('.copy-input');
            var successMessage = $('.text-success-message');

            // Select the text
            copyInput.select();
            // Copy it
            document.execCommand("copy");
            // Remove focus from the input
            copyInput.blur();
            // Show message
            successMessage.addClass('active');
            // Hide message after 2 seconds
            setTimeout(function () {
                successMessage.removeClass('active');
            }, 2000);
        });

        /*=========== Progress Bar ============*/
        var rateProgressBar = $('.rate-progress-bar');
        rateProgressBar.css('width', function () {
            return $(this).attr('aria-valuenow') + '%';
        });

        /*==== Review photos =====*/
        var reviewGallery = $('[data-fancybox="review-gallery"]');
        if (reviewGallery.length) {
            reviewGallery.fancybox({
                thumbs: {
                    autoStart : true
                }
            });
        }

        /*==== Review photos =====*/
        var reviewGalleryTwo = $('[data-fancybox="review-gallery-two"]');
        if (reviewGalleryTwo.length) {
            reviewGalleryTwo.fancybox({
                thumbs: {
                    autoStart : true
                }
            });
        }

        /*==== Show/Hide password of input field =====*/
        var togglePassword = $('.toggle-password');
        togglePassword.on('click', function () {
            $(this).toggleClass('active');
            var passInput = $('.password-field');
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });

        /*==== Summernote text editor =====*/
        var userTextEditor = $('.user-text-editor');
        if (userTextEditor.length) {
            userTextEditor.summernote({
                height: 150,
            });
        }

        /*=========== Tags input ============*/
        var tagsInputField = $('.tags-input');
        if (tagsInputField.length) {
            tagsInputField.tagsinput({
                maxTags: 5,
                tagClass: 'badge badge-info'
            });
        }

        /*=========== Payment method ============*/
        var paymentMethodInput = $(".payment-method-label input[type='radio']");
        paymentMethodInput.on('change', function() {
            $(this).parent().parent().addClass('active');
            $(this).parent().parent().siblings().removeClass('active');
        });

        /*========= Ajax contact form ========*/
        var submitBtn = document.querySelector('#send-message-btn');
        var form = $('.contact-form'),
            message = $('.alert-message'),
            formData;

        // Success function
        function doneFunction(response) {
            submitBtn.innerHTML = 'Send Message';
            message.fadeIn().removeClass('alert-danger').addClass('alert-success');
            message.text(response);
            setTimeout(function () {
                message.fadeOut();
            }, 3000);
            form.find('input:not([type="submit"]), textarea').val('');
        }

        // fail function
        function failFunction(data) {
            submitBtn.innerHTML = 'Send Message';
            message.fadeIn().removeClass('alert-success').addClass('alert-danger');
            message.text(data.responseText);
            setTimeout(function () {
                message.fadeOut();
            }, 3000);
        }

        // form submit
        form.submit(function (e) {
            e.preventDefault();
            formData = $(this).serialize();
            submitBtn.innerHTML = 'Sending...';
            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData
                })
                    .done(doneFunction)
                    .fail(failFunction);
            }, 2000)
        });
        
        /*=========== Copyright date ============*/
        let copyrightDate = $('#copyright-year');
        if(copyrightDate){
            let currentYear = new Date().getFullYear();
        
            copyrightDate.html(currentYear);
        }


    });
})(jQuery);

