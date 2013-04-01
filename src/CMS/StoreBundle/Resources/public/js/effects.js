$(document).ready(function(){

	$("#side-nav  ul").hide();
	
	$("#side-nav .title").click( function() { 
		$(this).toggleClass('open').next("ul").stop().slideToggle(); 
	});
	
	
	$(".box.active .h_title").trigger('click');
	
	
	// Sidebar: Menu: Ordenacao
	//if(draggable.options.refreshPositions) $.ui.ddmanager.prepareOffsets(draggable, event);
	//$(ui.draggable).draggable('option','refreshPositions',true);
	$('#side-nav, #side-nav ul, #items-order, #items-order ul').sortable({
		disabled : true,
		cursor: 'move',
		refreshPositions : true,
		stop : function(){

		}
	});
	$('#items-order, #items-order ul').sortable({ disabled: false });
	
	$('a.side-btn.order').click(function(){
		
		var sidenav = $('#side-nav');
		
		if( sidenav.hasClass('sortable') ){
			
			$('#side-nav, #side-nav ul').sortable({ 
				disabled: true
			}).sortable('cancel');
			
		} else {
			
			$('#side-nav, #side-nav ul').sortable({ 
				disabled: false
			});
			
			//sidenav.sortable( "option", { disabled: false } );
			
			//.find('ul').sortable('enable');
			
			// Blocos principais
			
			
		}
		
		sidenav.toggleClass('sortable').disableSelection();
		
		$(this).toggleClass('active').next('ul').stop().slideToggle(500);
		
		return false;
	});
	
	$('.box.order button.cancel').click(function(){
		$('.box.order a.side-btn.order').trigger('click');
	});
	
	$('.box.order button.save').click(function(){
		
		$('.box.order li').slideToggle(100);
		
		$('#side-nav, #side-nav ul').sortable('destroy');
		
		// FN de Salvar orderm aqui
		
	});
	
        
        
	
	
});