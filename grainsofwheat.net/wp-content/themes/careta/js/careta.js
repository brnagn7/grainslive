jQuery(document).ready(function($)
{
	numPosts = $('.post', '#post-list').length;
	widgets = $('.widget', '#sidebar-footer');
	numWidgets = widgets.length;

	
	$('.post', '#post-list').each
	(
		function()
		{
			if($('.no-more', this).length > 0) return;
			$(this).click(
				function()
				{
					window.location.href = $('a', this).first().attr('href');
				}
			);
		}
	);
	
	$('.gallery img', '#post').hover
	(
		function()
		{
			var g = $('.gallery img', '#post');
			for(var i = 0; i < g.length; i++)
			{
				$(g[i]).stop(true).animate({ opacity: $(this).attr('src') == $(g[i]).attr('src') ? 1 : .5 }, 300);
			}
		},
		function()
		{
			$('.gallery img', '#post').stop(true).animate({ opacity: 1 }, 300);
		}
	);
	
	$('.gallery', '#post').each
	(
		function()
		{
			$(this).magnificPopup({
				delegate: 'a[href$=".jpg"],a[href$=".png"],a[href$=".webp"],a[href$=".gif"]',
				type: 'image',
				gallery: { enabled: true }
			});
		}
	);
	
	$('a[href$=".jpg"],a[href$=".png"],a[href$=".webp"],a[href$=".gif"]', '#post').each
	(
		function()
		{
			if(!$(this).parent().hasClass('gallery-icon'))
			{
				$(this)
					.addClass('zoomLink')
					.magnificPopup({ type: 'image' })
				;
			}
		}
	);
	/*
	$(window).resize
	(
		function(e)
		{
			bodyClasses = $('body').attr('class');
			var w = $(window).width();
			var s = [480, 640, 800, 1280];
			for(var i in s) $('body').removeClass('lt-' + s[i] + ' gt-' + s[i]);
			for(var i in s) $('body').addClass((w >= s[i] ? 'g' : 'l') + 't-' + s[i]);
			
			if((numPosts > 0 || numWidgets > 0) && bodyClasses != $('body').attr('class'))
			{
				resortColumns();
			}
		}
	);
	$(window).resize();
	*/
	
	$('#mobile-menu').click(
		function(event)
		{
			event.preventDefault();
			
			if($('#page').hasClass('open'))
			{
				$('#page').removeClass('open');
			}
			else
			{
				$('#page').addClass('open');
			}
			return false;
		}
	);
});

var numPosts;
var widgets;
var numWidgets;
var bodyClasses;
var resortColumns = function()
{
	/*
	var numCols = 4;
	var jq = jQuery.noConflict();
	if(jq('body').hasClass('lt-800')) numCols = 3;
	if(jq('body').hasClass('lt-640')) numCols = 2;
	if(jq('body').hasClass('lt-480')) numCols = 1;
	for(var i = 0; i <= numPosts; i++)
	{
		if (numCols == 1)
		{
			if (jq('#post-' + i).hasClass('col1')) jq('#post-' + i).appendTo(jq('#col1'));
		}
		else
		{

			if (jq('#post-' + i).hasClass('col1')) jq('#post-' + i).appendTo(jq('#col1'));
			if (jq('#post-' + i).hasClass('col2')) jq('#post-' + i).appendTo(jq('#col2'));
			if (jq('#post-' + i).hasClass('col3')) jq('#post-' + i).appendTo(jq('#col3'));
			if (jq('#post-' + i).hasClass('col4')) jq('#post-' + i).appendTo(jq('#col4'));
		}
	}
	
	
	for(var i = 0; i <= numWidgets; i++)
	{
		jq(widgets[i]).appendTo(jq('#fcol' + ((i % numCols) + 1)));
	}
	*/
}

jQuery(document).ready(function($)
{
    $('.post-thumb').css('opacity', 0.8);  
    $('.post').hover(  
       function()
	   {  
          $(this).find('.post-thumb').stop().fadeTo('fast', 1);  
       },  
       function()
	   {  
          $(this).find('.post-thumb').stop().fadeTo('fast', 0.8);  
       });  
      
});  

jQuery(document).ready(function($)
{
    $('.social > a').css('opacity', 0.7);  
    $('.social > a').hover(  
       function()
	   {  
          $(this).stop().fadeTo('slow', 1);  
       },  
       function()
	   {  
          $(this).stop().fadeTo('slow', 0.7);  
       });  
      
});  

jQuery(document).ready(function($)
{
    $('.page-numbers').css('opacity', 0.7);  
    $('.page-numbers').hover(  
       function()
	   {  
          $(this).stop().fadeTo('slow', 1);  
       },  
       function()
	   {  
          $(this).stop().fadeTo('slow', 0.7);  
       });  

   $('.current').css('opacity', 1);  
    $('.current').hover(  
       function()
	   {  
          $(this).stop().fadeTo('slow', 1);  
       },  
       function()
	   {  
          $(this).stop().fadeTo('slow', 1);  
       });  

    $(".anyClass").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
		auto: 4000,
		speed: 1000,
		
    });
	
	$('#post-list').masonry({
		  itemSelector: '.post-entry'
	});		
});  

