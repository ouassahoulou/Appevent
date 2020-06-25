(function($) {
    "use strict";

    $('.menu>li').slice(-2).addClass('last-elements');
	
    /* Menu sticky  */
    var header = $('.header-sticky');
    var win = $(window);
	
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 245) {
            header.removeClass("sticky");
        } else {
            header.addClass("sticky");
        }
    });
    
	/* meanmenu  */
    $('.main-menu nav').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: '.mobile-menu'
    });
    
	// imagesLoaded
    
 
    
    $('.portfolio-menu button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });
    
    

   


    /*--
    Magnific Popup
    ------------------------*/

    
    /*--
    menu-toggle
    ------------------------*/
	var menutoggle = $('.menu-toggle');
	var menunav = $('.main-menu nav');
    menutoggle.on('click', function() {
        if (menutoggle.hasClass('is-active')) {
            menunav.removeClass('menu-open');
        } else {
            menunav.addClass('menu-open');
        }
    });
    
    
    /*--
    	Hamburger js
    -----------------------------------*/
    var forEach = function(t, o, r) {
        if ("[object Object]" === Object.prototype.toString.call(t))
            for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
        else
            for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t)
    };
    
    var hamburgers = document.querySelectorAll(".hamburger");
    if (hamburgers.length > 0) {
        forEach(hamburgers, function(hamburger) {
            hamburger.addEventListener("click", function() {
                this.classList.toggle("is-active");
            }, false);
        });
    }
    
    
    /*--------------------------
	scrollUp
	---------------------------- */
	var totop = $('#toTop');
    win.on('scroll', function() {
        if (win.scrollTop() > 200) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    });
    
    
    /*---------------------
       Circular Bars - Knob
    --------------------- */
    if (typeof($.fn.knob) != 'undefined') {
        $('.knob').each(function() {
            var $this = $(this),
                knobVal = $this.attr('data-rel');
            $this.knob({
                'draw': function() {
                    $(this.i).val(this.cv + '%')
                }
            });
            $this.appear(function() {
                $({
                    value: 0
                }).animate({
                    value: knobVal
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.val(Math.ceil(this.value)).trigger('change');
                    }
                });
            }, {
                accX: 0,
                accY: -150
            });
        });
    }
    
    
})(jQuery);