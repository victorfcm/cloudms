jQuery.fn.jequalize = function(x) {
	function equalize(e){
		var h = 0;
		e.height('').each(function(){
			oh = jQuery(this).height();
			if (oh > h) { h = oh; }
		});
		e.height(h);
	}
	
	if (x == undefined)
	{
	equalize(jQuery(this));
	return this;
	}
	
	for(i = 0; i < jQuery(this).length; i+=x)
	{
	equalize(jQuery(this).slice(i, i + x))
	}
	return this;
};

function contentWidth(windowWidth,itemWidth,items){
	
	var nColunas = parseInt(windowWidth/itemWidth)
	
	if(nColunas <= 4 && nColunas > 2) {
		$('#lendo').width( (itemWidth-15)*2 );
	} else if(nColunas > 4) {
		$('#lendo').width( (itemWidth-10)*3 );
	}
	
	if(nColunas >= 2) items.width(itemWidth*nColunas);
}

function wrapContent(container,a){
	$(container+' '+a).each(function(){
		
		if(!$(this).nextUntil(a).length == 0){
			$(this).addClass('wrap').append('<span class="icon"></span>').nextUntil(a).wrapAll('<div class="subcontent c-'+a+'" />');
		}
		
	}).click(function(){
		$(this).toggleClass('open').next('.subcontent').slideToggle(500);
	});
}

$(document).ready(function(){
	
	
	if($('#slider').length > 0) {
		
		$('#slider .item:not(.item:first)').hide();
		
		var sliderTime;
		function sliderShow(obj, prevObj, btn){
			
			//Fade
			/*prevObj.css({zIndex:10});
			obj.css({zIndex:20, opacity:0, display:'block'}).animate({opacity:1},800,function(){
				
				obj.find('.i-txt').css({opacity:0,display:'block'}).animate({opacity:1},400,function(){ obj.find('.i-txt').fixClearType(); });
				prevObj.css({zIndex:1});
			
			}).find('.i-txt').hide();
			*/
			
			//prevObj.css({zIndex:10}).animate({left:'-940'},1000,function(){ prevObj.css({zIndex:1}).hide(); });
			
			//Movimento Lateral
			var mov = 580;
			
			btn.addClass('off').siblings().addClass('off');
			
			/*
			Item aparece + Animacao texto
			obj.css({zIndex:10, left: mov, display:'block'}).animate({left:0},700,function(){
				obj.find('.i-txt').css({opacity:0,display:'block'}).animate({opacity:1},400,function(){ obj.find('.i-txt').fixClearType(); });
			}).find('.i-txt').hide();
			*/
			
			obj.css({zIndex:10, left: mov, display:'block'}).animate({left:0},700);
			
			prevObj.css({zIndex:10}).animate({left:'-'+mov},700,function(){ 
				prevObj.css({zIndex:1}).hide();
				btn.removeClass('off').siblings().removeClass('off');
			});
			
		}
		
		function sliderLoop(next){
			
			clearTimeout(sliderTime);
			sliderTime = setTimeout(function(){
				
				var next = $('#slider .nav span.ativo').next();
				if(next.length == 0){ var next = $('#slider .nav span:first'); }
				
				next.trigger('click');
			
			},6000);
			
		}
		sliderLoop();
		
		//Nav
		$('#slider .item').each(function(){
			$('#slider .nav').append('<span>'+ parseInt($(this).index()+1) +'</span>');
		});
		$('#slider .nav span:first').addClass('ativo');
		
		//Nav Click
		$('#slider .nav span').click(function(){
		
			if($(this).hasClass('ativo') || $(this).hasClass('off')) return false;
			
			var a = $(this);
				
			var atual = $('#slider .item:eq('+a.siblings('.ativo').index()+')')
			var next = $('#slider .item:eq('+a.index()+')')
			
			sliderShow(next, atual, a);
			
			a.addClass('ativo').siblings().removeClass('ativo');
			
			sliderLoop();
		
		});
	
	}
	
	
	// PAGINA: Quem Somos
	if($('#quem-somos-lista').length > 0){
		
		$('#quem-somos-lista .item .link').click(function(){
			
			$(this).parent().toggleClass('open').find('.txt').slideToggle(500);
		
		});
	
	}
	
	// PAGINA: Link Especial PDF
	if($('#pg-txt').length > 0){
		
		$('#pg-txt a').each(function(){
		
			if( $(this).attr('href').split('.pdf').length > 1) $(this).addClass('link-pdf');
		
		});
		
	}
	
	// PAGINA: SANFONA
	if($('#pg-txt.sanfona').length > 0){
		
		wrapContent('#pg-txt','h2');
	
	}
	
	// PAGINA : MENU - DIVISOES DO TEXTO
	if($('#pg-txt.menu-conteudo').length > 0){
		
		$('#pg-txt h2:first').before('<ul id="pg-menu" />');
		var pgMenu = $('#pg-menu');
		
		
		$('#pg-txt h2').each(function(){
		
			if(!$(this).nextUntil('h2').length == 0){
				
				pgMenu.append('<li>'+$(this).html()+'</li>');
				
				$(this).nextUntil('h2').wrapAll('<div class="subcontent" />');
				$('#pg-txt .subcontent:last').prepend('<h2 class="titulo">'+$(this).html()+'</h2>');
				
				$(this).remove();
				
			}
			
		});
		
		$('.subcontent').wrapAll('<div id="pg-menu-textos" />');
		
		//Navegacao
		$('#pg-menu li').click(function(){
		
			if($(this).hasClass('ativo')) return;
			
			$(this).addClass('ativo').siblings().removeClass('ativo');
			
			var i = $(this).index()
			$('.subcontent:visible').fadeOut(300,function(){
			
				$('.subcontent:eq('+i+')').fadeIn(600);
			
			});
		
		});
		
		//Ativa o primeiro
		$('#pg-menu li:first, .subcontent:first').show().addClass('ativo');
		
	}
	
	// PAGINA: GALERIA DE FOTOS
	if($('#pg-galeria').length > 0){
	
		var foto = $('#pg-galeria .foto');
		
		$('#pg-galeria li').click(function(){
		
			if($(this).hasClass('ativo')) return;
			
			var a = $(this);
			
			a.addClass('ativo').siblings().removeClass('ativo');
			
			foto.find('img').fadeOut(300,function(){
				
				foto.find('img').remove();
				foto.append('<img src="'+a.find('img').attr('src')+'" style="display:none" />');
				
				foto.find('img').fadeIn(600);
				
				//a.find('img').clone().hide().fadeIn(300);
			
			});
		
		});
	
	}
	
});

$(window).scroll(function(){

});

$(window).resize(function(){
			
});