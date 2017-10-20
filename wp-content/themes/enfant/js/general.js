(function ($) {
    'use strict';

    //window load 
    $(window).load(function () {
        var headerHeight = parseInt($('#masthead').outerHeight(true));
        //stick footer 
        stickyFooter();

        $(window).resize(function () {
            headerHeight = parseInt($('#masthead').outerHeight(true));
            //stick footer 
            stickyFooter();
            //stick navigation
            stickyNav();
        });

        $(window).scroll(function() {
            stickyNav();
        });


        var isFixed = false;
        var stickyNav = function () {
            var scrollTop = $(window).scrollTop();
            var shouldBeFixed = scrollTop > headerHeight;

            var viewPortWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if (viewPortWidth >= 768) {
                if (shouldBeFixed && !isFixed) {
                    $('#masthead').hide(function () {
                        $(this).addClass('fixed-header');
                        $(this).slideDown();
                        isFixed = true;
                    });
                } else if (!shouldBeFixed && isFixed) {
                    $('#masthead').removeClass('fixed-header');
                    isFixed = false;
                }
            }
        };

        stickyNav();

        //make footer stick to bottom
        function stickyFooter() {
            if (!$('body.home').length) {
                //skip home page of this rule
                var footerHeight = $('.site-footer').height();
                $('#content').css('paddingBottom', (footerHeight > 80 ? footerHeight : 80));
            }
        }

        //pre-loader
        function preloader(){
            if ($('#ztl-overlay').length) {
                $('#ztl-overlay').fadeOut('500',function(){
                    $('#page').css('visibility','visible');
                });

            }
        }

        preloader();
    });

    $(document).ready(function () {

        //make nice comments form 
        if ($('#commentform').length > 0) {
            $('#commentform label').each(function () {
                var item;
                var labelName;
                item = $(this).attr('for');
                labelName = $(this).text();
                if ($('#' + item).length > 0) {
                    $('#' + item).attr("placeholder", labelName);
                }
            });
        }


        $('.ztl-date-line a').each(function(){
            $(this).html( $(this).text().replace(/(^\w{1,2} \/)/,'<span>$1</span>'));
        });


        $('#comments p.form-submit').addClass('ztl-button-three');

        //add a span
        $('.woocommerce form .form-row label input[type=checkbox]+span').before('<span class=\"ztl-checkbox-helper\"></span>');


        //Smooth scroll to top
        $(window).scroll(function () {
            if ($(this).scrollTop() > 400) {
                $('.ztl-scroll-top').fadeIn();
            } else {
                $('.ztl-scroll-top').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.ztl-scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        //Show/hide placeholder on focus
        $('input, textarea').each(function(){
            $(this).data('holder', $(this).attr('placeholder'));
        });

        $('input, textarea').focusin(function () {
            $(this).attr('placeholder', '');
        });
        $('input, textarea').focusout(function () {
            $(this).attr('placeholder', $(this).data('holder'));
        });

    });

}(jQuery));

