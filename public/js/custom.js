	var screenWidth = $( window ).width();
function getUrlParams(dParam) {
    var dPageURL = window.location.search.substring(1),
        dURLVariables = dPageURL.split('&'),
        dParameterName,
        i;

    for (i = 0; i < dURLVariables.length; i++) {
        dParameterName = dURLVariables[i].split('=');

        if (dParameterName[0] === dParam) {
            return dParameterName[1] === undefined ? true : decodeURIComponent(dParameterName[1]);
        }
    }
}


jQuery(window).on("load", function() {
    $('#preloader').fadeOut(500);
    $('#main-wrapper').addClass('show');

    // if($('body').attr('data-sidebar-position') === "fixed") {
    //     $('.deznav-scroll').slimscroll({
    //         position: "right",
    //         size: "5px",
    //         height: "100%",
    //         color: "transparent"
    //     });
    // }
	$('select').selectpicker();
});

(function($) {
    "use strict";

    $("#menu").metisMenu();

    // $(function() {
    //     AOS.init({
    //         duration: 1500,
    //         easing: 'ease-in-out',
    //     });
    // });

    $("#checkAll").change(function() {
        $("td input:checkbox").prop('checked', $(this).prop("checked"));
    });





    /* $('.sidebar-right-inner').slimscroll({
        position: "left",
        size: "5px",
        height: "100%",
        color: "#c6c8c9"
    }); */

    $(".nav-control").on('click', function() {

        $('#main-wrapper').toggleClass("menu-toggle");

        $(".hamburger").toggleClass("is-active");
    });

    //to keep the current page active
    
	for (var nk = window.location,
			o = $("ul#menu a").filter(function() {
				return this.href == nk;
			})
			.addClass("mm-active")
			.parent()
			.addClass("mm-active");;) {
		// console.log(o)
		if (!o.is("li")) break;
		o = o.parent()
			.addClass("mm-show")
			.parent()
			.addClass("mm-active");
	}
	
	
	// custom file input
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});


	$("ul#menu>li").on('click', function() {
		const sidebarStyle = $('body').attr('data-sidebar-style');
		if (sidebarStyle === 'mini') {
			console.log($(this).find('ul'))
			$(this).find('ul').stop()
		}
	})
   

    
	// var win_w = window.outerWidth;
	var win_h = window.outerHeight;
	var win_h = window.outerHeight;
	if (win_h > 0 ? win_h : screen.height) {
		$(".content-body").css("min-height", (win_h + 60) + "px");
	};
    


    $('a[data-action="collapse"]').on("click", function(i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="collapse"] i').toggleClass("mdi-arrow-down mdi-arrow-up"),
            $(this).closest(".card").children(".card-body").collapse("toggle");
    });

    $('a[data-action="expand"]').on("click", function(i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-size-actual icon-size-fullscreen"),
            $(this).closest(".card").toggleClass("card-fullscreen");
    });



    $('[data-action="close"]').on("click", function() {
        $(this).closest(".card").removeClass().slideUp("fast");
    });

    $('[data-action="reload"]').on("click", function() {
        var e = $(this);
        e.parents(".card").addClass("card-load"),
            e.parents(".card").append('<div class="card-loader"><i class=" ti-reload rotate-refresh"></div>'),
            setTimeout(function() {
                e.parents(".card").children(".card-loader").remove(),
                    e.parents(".card").removeClass("card-load")
            }, 2000)
    });

    const headerHight = $('.header').innerHeight();

    $(window).scroll(function() {
        if ($('body').attr('data-layout') === "horizontal" && $('body').attr('data-header-position') === "static" && $('body').attr('data-sidebar-position') === "fixed")
            $(this.window).scrollTop() >= headerHight ? $('.deznav').addClass('fixed') : $('.deznav').removeClass('fixed')
    });
	
	
	jQuery('.dz-scroll').each(function(){
		
		var scroolWidgetId = jQuery(this).attr('id');
		const ps = new PerfectScrollbar('#'+scroolWidgetId, {
		  wheelSpeed: 2,
		  wheelPropagation: true,
		  minScrollbarLength: 20
		});
	})
	
	jQuery('.metismenu > .mm-active ').each(function(){
		if(!jQuery(this).children('ul').length > 0)
		{
			jQuery(this).addClass('active-no-child');
		}
	});
	if(screenWidth <= 991 ){
		jQuery('.menu-tabs .nav-link').on('click',function(){
			if(jQuery(this).hasClass('open'))
			{
				jQuery(this).removeClass('open');
				jQuery('.fixed-content-box').removeClass('active');
				jQuery('.hamburger').show();
			}else{
				jQuery('.menu-tabs .nav-link').removeClass('open');
				jQuery(this).addClass('open');
				jQuery('.fixed-content-box').addClass('active');
				jQuery('.hamburger').hide();
			}
			//jQuery('.fixed-content-box').toggleClass('active');
		});
		jQuery('.close-fixed-content').on('click',function(){
			jQuery('.fixed-content-box').removeClass('active');
			jQuery('.hamburger').removeClass('is-active');
			jQuery('#main-wrapper').removeClass('menu-toggle');
			jQuery('.hamburger').show();
		});
	}
	jQuery('.bell-link').on('click',function(){
		jQuery('.chatbox').addClass('active');
	});
	jQuery('.chatbox-close').on('click',function(){
		jQuery('.chatbox').removeClass('active');
	});
	
	const qs = new PerfectScrollbar('.deznav-scroll');
// const sr = new PerfectScrollbar('.sidebar-right-inner');


	//plugin bootstrap minus and plus
	$('.btn-number').on('click', function(e) {
		e.preventDefault();

		fieldName = $(this).attr('data-field');
		type = $(this).attr('data-type');
		var input = $("input[name='" + fieldName + "']");
		var currentVal = parseInt(input.val());
		if (!isNaN(currentVal)) {
			if (type == 'minus')
				input.val(currentVal - 1);
			else if (type == 'plus')
				input.val(currentVal + 1);
		} else {
			input.val(0);
		}
	});
	
	jQuery('.dz-chat-user-box .dz-chat-user').on('click',function(){
		 jQuery('.dz-chat-user-box').addClass('d-none');
		 jQuery('.dz-chat-history-box').removeClass('d-none');
	}); 
	
	jQuery('.dz-chat-history-back').on('click',function(){
		 jQuery('.dz-chat-user-box').removeClass('d-none');
		  jQuery('.dz-chat-history-box').addClass('d-none');
	}); 
	
	jQuery('.dz-fullscreen').on('click',function(){
		jQuery('.dz-fullscreen').toggleClass('active');
	});
	
	
	/*** Load More Functionality ****/
	$(".dz-load-more").on('click', function(e)
	{
		e.preventDefault();	//STOP default action
		$(this).append(' <i class="fa fa-refresh"></i>');
		
		var dzLoadMoreUrl = $(this).attr('rel');
		var dzLoadMoreId = $(this).attr('id');
		
		$.ajax({
			method: "POST",
			url: dzLoadMoreUrl,
			dataType: 'html',
			success: function(data) {
				$( "#"+dzLoadMoreId+"Content").append(data);
				$('.dz-load-more i').remove();
			}
		})
	});
	/*** End Load More Functionality ****/
	
	
	jQuery('.dz-fullscreen').on('click',function(e){
	if(document.fullscreenElement||document.webkitFullscreenElement||document.mozFullScreenElement||document.msFullscreenElement) { 
		/* Enter fullscreen */
		if(document.exitFullscreen) {
			document.exitFullscreen();
		} else if(document.msExitFullscreen) {
			document.msExitFullscreen(); /* IE/Edge */
		} else if(document.mozCancelFullScreen) {
			document.mozCancelFullScreen(); /* Firefox */
		} else if(document.webkitExitFullscreen) {
			document.webkitExitFullscreen(); /* Chrome, Safari & Opera */
		}
	} 
	else { /* exit fullscreen */
		if(document.documentElement.requestFullscreen) {
			document.documentElement.requestFullscreen();
		} else if(document.documentElement.webkitRequestFullscreen) {
			document.documentElement.webkitRequestFullscreen();
		} else if(document.documentElement.mozRequestFullScreen) {
			document.documentElement.mozRequestFullScreen();
		} else if(document.documentElement.msRequestFullscreen) {
			document.documentElement.msRequestFullscreen();
		}
	}		
	});
	
	// Chart All Pages
	
})(jQuery);