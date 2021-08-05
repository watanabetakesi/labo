$.fn.exists = function()
{
	return $(this).length>0;
};

function isiPhone()
{
	if(navigator.userAgent.toLowerCase().indexOf("iphone") > -1) return true;
}

var isTouch = navigator.userAgent.match(/iPad/i) != null || !!('ontouchstart' in window);

/*--------------------------------------------------------------------------------------------
*
*	accordion
*
*--------------------------------------------------------------------------------------------*/
$('.accordion .toggle').live('click', function(){
	
	var mask = $(this).siblings('.mask');
	var new_height = 0;
	
	if(!$(this).hasClass('active'))
	{
		$(this).addClass('active');
		
		var orig_height = mask.height();
		mask.css({'height' : 'auto', 'padding-bottom' : '20px' });
		new_height = mask.height();
		mask.css({'height' : orig_height});
	}
	else
	{
		$(this).removeClass('active');
		mask.css({ 'padding-bottom' : '0px' });
	}

	mask.stop().animate({ height : new_height }, 500);	
	
	return false;
});



function reflowFixed() {
	
	$('body').css('padding-right', '1px');

	setTimeout(function() {

		$('body').css('padding-right', '0px');

	}, 0);

}


/*--------------------------------------------------------------------------------------------
*
*	super_wrapper
*
*--------------------------------------------------------------------------------------------*/
function setup_super_wrapper()
{
	// if hero does not exist, return false and end this function
	if(!$('#hero').exists())
	{
		return false;
	}
	
	// find height of browser and minus section h2 height
	var finalHeight = $(window).height() - $('#super_wrapper h2:first').height();
	
	// set margin top of super_wrapper to this height
	$('#super_wrapper').css({
		'margin-top' : finalHeight
	});

}

function setup_slider()
{
	// if hero does not exist, return false and end this function
	if(!$('#hero').exists())
	{
		return false;
	}
	
	var is_animating = false;

	// slider auto
	var is_auto = false;
	
	var auto_interval = setInterval(function()
	{
		
		if( is_auto == false)
		{
			clearInterval( auto_interval );
			return false;
		}
		
		hero_next();
	
	}, 5000);
	
	// add active class to first slide (that will show the first slide)
	$('#hero .slides .slide:first').addClass('active');
	
	// add live click functino to slide
	$('#hero .slides').live('click', function(){
		//hero_next();
		//clearInterval( auto_interval );
			
	});
	
	// add swipe function to slide 
	//Assign handlers to the simple direction handlers.
	var swipeOptions = {
		'swipeLeft' : hero_next,
		'swipeRight' : hero_prev,
		'threshold' : 10
	}
	
	//Enable swiping...
	$("#hero .slides").swipe(swipeOptions);
	
	function hero_next()
	{
		is_animating = true;
		
		// referencing
		var active = $('#hero .slides .slide.active');
		
		// find next slide, choose first if nothing after active
		var next = active.next('.slide').exists() ? active.next('.slide') : $('#hero .slides .slide:first');
		
		// change active to last-active
		active.removeClass('active');
		active.addClass('last-active');
		next.addClass('active');
		
		// use css to change next opacity to 0
		next.css({ opacity : 0, '-webkit-opacity': 0 });
		next.animate({ opacity : 1 , '-webkit-opacity': .99 }, 500, function(){
			
			// on complete, remove "last-active" class from active
			active.removeClass('last-active');
			
			// set trigger back to false, this will let you click again
			is_animating = false;	
		});
	}
	
	
	function hero_prev()
	{
		is_animating = true;
		
		// referencing
		var active = $('#hero .slides .slide.active');
		
		// find next slide, choose first if nothing after active
		var prev = active.prev('.slide').exists() ? active.prev('.slide') : $('#hero .slides .slide:last');
		
		// change active to last-active
		active.removeClass('active');
		active.addClass('last-active');
		prev.addClass('active');
		
		// use css to change next opacity to 0
		prev.css({ opacity : 0, '-webkit-opacity': 0 });
		prev.animate({ opacity : 1 , '-webkit-opacity': .99 }, 500, function(){
			
			// on complete, remove "last-active" class from active
			active.removeClass('last-active');
			
			// set trigger back to false, this will let you click again
			is_animating = false;	
		});	
	}
}

function scale_slider()
{

	// if hero does not exist, return false and end this function
	if(!$('#hero').exists())
	{
		return false;
	}
	
	var finalHeight = $(window).height() - $('#super_wrapper h2.border:first').height();
	
	// find available space	
	var availableSpace = finalHeight - $('#header_wrap').height();
	
	// set slide height
	$('#hero .slides .slide').css({
		'height' : availableSpace + "px"
	});
	
	// set image height and width to default values
	$('#hero .slides .slide img').css({
		'height' : 'auto',
		'width' : '100%'
	});	

	$('#hero .slides .slide').each(function(){
		var slideHeight = $(this).height();
		var imageHeight = $(this).find('img').height();

		if(slideHeight > imageHeight)
		{
			$(this).find('img').css({
				'height' : '100%',
				'width' : 'auto'
			});
		}
	});
}

/* Parallax Scroll */
function parallax_scroll()
{
	if(!isTouch){
		var scrolled = $(window).scrollTop();
		$('#hero').css('top',(0-(scrolled*.5))+'px');
	}
}

/*--------------------------------------------------------------------------------------------
*
*	Textual Slider
*
*--------------------------------------------------------------------------------------------*/

function setup_rotator_wrapper()
{
	if(!$('#rotator_wrapper').exists())
	{
		return false;
	}
		
	// live event click ul.navigation li
	var prev_i = 0;
	var next_i = 0;
	
	if( $('#rotator_wrapper .slides .slide').length == 1 )
	{
		$('#rotator_wrapper .navigation').hide();
	}
	
	$('#rotator_wrapper .navigation li a').live('click', function(){
	
		// stores data-i var
		prev_i = next_i;
		next_i = $(this).attr('data-i');
		
		speed = next_i - prev_i;
		if(speed < 0)
		{
			speed = -speed;
		}
		
		// stores amount to move as var distance -(data-i * 100%)
		var distance = '-' + (next_i * 100) + '%';
		
		// add active class to the clicked li
		$(this).parent('li').addClass('active').siblings('li').removeClass('active');
		
		update_rotator_wrapper_height();
		
		// move required distance
		$('#rotator_wrapper .slides').animate({ 'left' : distance }, speed * 250);
		
		return false;
		
	});
	
	function update_rotator_wrapper_height()
	{
		// find height of .slide[data-i="next_i"]
		var height = $('#rotator_wrapper .slides .slide[data-i="' + next_i + '"]').height();
		
		console.log(height);
		
		// animate the height of #rotator_wrapper to this new height
		$('#rotator_wrapper').animate({ 'height' : height });
		
	}
	
	// set height for first slide
	update_rotator_wrapper_height();
	
	// add active state to first li
	$('#rotator_wrapper .navigation ul li:first-child').addClass('active');
	
	
	var swipeOptions= {
		'swipeLeft' : rotator_next,
		'swipeRight' : rotator_prev,
		'threshold' : 10
	}
	
	//Enable swiping...
	$("#rotator_wrapper").swipe(swipeOptions);
	
	
	function rotator_next()
	{
		var current_li = $('#rotator_wrapper .navigation li.active');
		
		// test if the next li (li after .active) exists. If not, return false and end the function
		if(!current_li.next('li').exists())
		{
			return false;
		}

		// // trigger click on the next li
		var next_li = current_li.next('li');
		next_li.find('a').trigger('click');
		
		return false;
	}
	
	function rotator_prev()
	{
		
		var current_li = $('#rotator_wrapper .navigation li.active');
		
		// test if the next li (li after .active) exists. If not, return false and end the function
		if(!current_li.prev('li').exists())
		{
			return false;
		}

		// // trigger click on the next li
		var next_li = current_li.prev('li');
		next_li.find('a').trigger('click');
		
		return false;
	
	}
}


/*--------------------------------------------------------------------------------------------
*
*	Tool Tips
*
*--------------------------------------------------------------------------------------------*/

$('#project_next, #profile_next').live('mousemove', function(e)
{
	var x = e.pageX + 15;
	var y = e.pageY + 5;
		
	$('.tool-tip').css({ 'top' : y, 'left' : x });
		
});

$('#project_previous, #profile_previous').live('mousemove', function(e)
{
	var x = e.pageX;
	var y = e.pageY;
		
	$('.tool-tip').css({ 'top' : y, 'left' : x });
		
});

// next project
$('#project_next').live('mouseenter', function()
{
	$('.tool-tip').html("Next Project");
	$('.tool-tip').addClass('active');
});

$('#project_next').live('mouseleave', function()
{
	$('.tool-tip').removeClass('active');
});

// next profile
$('#profile_next').live('mouseenter', function()
{
	$('.tool-tip').html("Next Profile");
	$('.tool-tip').addClass('active');
});

$('#profile_next').live('mouseleave', function()
{
	$('.tool-tip').removeClass('active');
});

// prev project
$('#project_previous').live('mouseenter', function()
{
	$('.tool-tip').html("Previous Project");
	$('.tool-tip').addClass('active');
});

$('#project_previous').live('mouseleave', function()
{
	$('.tool-tip').removeClass('active');
});

// prev profile
$('#profile_previous').live('mouseenter', function()
{
	$('.tool-tip').html("Previous Profile");
	$('.tool-tip').addClass('active');
});

$('#profile_previous').live('mouseleave', function()
{
	$('.tool-tip').removeClass('active');
});

/*--------------------------------------------------------------------------------------------
*
*	Profile Overlay
*
*--------------------------------------------------------------------------------------------*/

// open overlay
$('.people_list .tile .tile-hover a.view-profile').live('click', function(){
	
	// get href value for what to load into the div
	var 
		i = $(this).attr('data-i'),
		tiles_overlay = $(this).closest('.tiles-wrapper').find('#tiles_overlay_wrapper'),
		people_list = $(this).closest('.people_list');
	
	// find profile div that matches to i, give it a class or active (active makes it display : block)
	tiles_overlay.find('.profile').removeClass('active').hide();
	tiles_overlay.find('.profile[data-i="' + i + '"]').addClass('active').css({ 'display' : 'block', 'opacity' : 1, 'top' : 0});
	
	// fade in profile pop up
	tiles_overlay.css({ 'display' : 'block' }).animate({ 'opacity' : 1, 'top' : 0 }, 500);
	
	setTimeout(function()
	{
		people_list.animate({ 'height' : people_list.find('.profile.active').outerHeight() + 50 }, 250);
	},100);
	
	return false;
	
});

// close overlay
$('.people_list #profile_close').live('click', function(){
	
	var 
		tiles_overlay = $(this).closest('.tiles-wrapper').find('#tiles_overlay_wrapper'),
		people_list = $(this).closest('.people_list');
	
	tiles_overlay.animate({ 'opacity' : 0, 'top' : 100 }, 250, function(){
		$(this).css({ 'display' : 'none' });
	});
	
	people_list.css({ 'height' : '100%' });
	
	return false;
	
});

// next profile
$('.people_list #profile_next').live('click', function(){
	
	// referencing
	var 
		tiles_overlay = $(this).closest('.tiles-wrapper').find('#tiles_overlay_wrapper'),
		active = tiles_overlay.find('.profile.active'),
		people_list = $(this).closest('.people_list'),
		next = active.next('.profile').exists() ? active.next('.profile') : tiles_overlay.find('.profile:first-child');
	
	active.removeClass('active').animate({ 'opacity' : 0, 'top' : 50 }, 500, function(){
		active.hide();
		next.addClass('active').css({ 'display' : 'block', 'opacity' : 0, 'top' : -50 }).animate({ 'opacity' : 1, 'top' : 0 }, 500, function()
		{
			people_list.animate({ 'height' : next.outerHeight() + 50 }, 250);
		});	
	});	
	
	return false;
	
	
});

// prev profile
$('.people_list #profile_previous').live('click', function(){
	
	// referencing
	var
		tiles_overlay = $(this).closest('.tiles-wrapper').find('#tiles_overlay_wrapper'),
		active = tiles_overlay.find('.profile.active'),
		people_list = $(this).closest('.people_list'),
		prev = active.prev('.profile').exists() ? active.prev('.profile') : tiles_overlay.find('.profile:last-child');
	
	active.removeClass('active').animate({ 'opacity' : 0, 'top' : -50 }, 500, function(){
		active.hide();
		prev.addClass('active').css({ 'display' : 'block', 'opacity' : 0, 'top' : 50 }).animate({ 'opacity' : 1, 'top' : 0 }, 500, function() 
		{
		
			people_list.animate({ 'height' : prev.outerHeight() + 50 }, 250);
		
		});	
	});
	
	return false;

});

/*--------------------------------------------------------------------------------------------
*
*	back to top
*
*--------------------------------------------------------------------------------------------*/

$('#back_to_top').live("click", function(){
	$('html, body').animate({ scrollTop: 0 }, 1000);
	return false;
});


/*--------------------------------------------------------------------------------------------
*
*	scroll to element
*
*--------------------------------------------------------------------------------------------*/

$('.scroll-to').live("click", function(){
	
	var x = $(this).attr("href");
	$('html, body').animate({ scrollTop: $(x).offset().top - 70}, 1000, function()
	{
		reflowFixed();
	});

	return false;
});


/*--------------------------------------------------------------------------------------------
*
*	document.ready
*
*--------------------------------------------------------------------------------------------*/

$(document).ready(function()
{
	setup_rotator_wrapper();
	setup_super_wrapper(); // h2 to base line
	setup_slider();
	
	//iphone adjustments
	if(isiPhone())
	{	
		
	}

	
	// if(isTouch){
	// 	$('a').on('hover', function(){
	// 		$(this).trigger('click');
	// 	});
	// 	$('.tile').on('hover', function()
	// 	{
	// 		$(this).find('a').trigger('click');
	// 	});
	// }
});


/*--------------------------------------------------------------------------------------------
*
*	window.load
*
*--------------------------------------------------------------------------------------------*/

$(window).load(function()
{
	$(window).trigger('resize');
	
	// fade in hero
	var hero = $('#hero');
	hero.animate({ opacity: 1 }, 500);
	
});


	
$(window).resize(function(){
	setup_super_wrapper(); // h2 to base line
	scale_slider(); // scales images
})

$(window).scroll(function(){
	parallax_scroll();
});


// ajax subscribe
$('#email_opt_in_form').live('submit', function(){
	
	var form = $(this);
	
	form.animate({opacity : 0.5}, 300);
	
	$.getJSON(
		form.attr('action') + "?callback=?",
		form.serialize(),
		function (data)
		{
			if (data.Status === 400) {
				alert(data.Message);
				form.animate({opacity : 1}, 300);
			}
			else
			{ // 200
				form.find('input[type="text"]').val('Thank you');
				form.animate({opacity : 1}, 300);
			}
		}
	);
	
	return false;
}); 
