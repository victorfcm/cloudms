$(document).ready(function(){
	$('.slider-noticias').children(':first').css('display','block');
	$('.slider-noticias').children(':first').attr('active', true);
	
	all = $('.slider-noticias').children().length;
	
	$('#all').html(all);
	
	$('.right').click(function()
	{ 
		var active = $('div[active=true]');
		active.fadeOut('fast', function()
		{				
			var act = parseInt($('#act').html());
			act = (act < all) ? act + 1 : 1;
			
			$('#'+act).fadeIn('fast', function()
			{
				$('div[active=true]').removeAttr('active');
				$(this).attr('active', true);
 				
				$('#act').html(act);
			}); 
		});
	});
	
	$('.left').click(function()
	{ 
		var active = $('div[active=true]');
		active.fadeOut('fast', function()
		{				
			var act = parseInt($('#act').html());
			act = (act-1 === 0) ? all : act - 1;
			
			$('#'+act).fadeIn('fast', function()
			{
				$('div[active=true]').removeAttr('active');
				$(this).attr('active', true);
				
				$('#act').html(act);
			}); 
		});
	});
});
