$(document).ready(function(){

	$("#side-nav  ul").hide();
	
	$("#side-nav .title").click( function() { 
		$(this).toggleClass('open').next("ul").stop().slideToggle(); 
	});
	
	
	$(".box.active .h_title").trigger('click');
	
	
	// Sidebar: Menu: Ordenacao
	//if(draggable.options.refreshPositions) $.ui.ddmanager.prepareOffsets(draggable, event);
	//$(ui.draggable).draggable('option','refreshPositions',true);
	$('#side-nav, #side-nav ul').sortable({
		disabled : true,
		cursor: 'move',
		refreshPositions : true,
		stop : function(){

		}
	});
	
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
	
	
	function MadFileBrowser(field_name, url, type, win) {
	  tinyMCE.activeEditor.windowManager.open({
	      file : "mfm.php?field=" + field_name + "&url=" + url + "",
	      title : 'Gerenciador de Arquivos',
	      width : 640,
	      height : 450,
	      resizable : "no",
	      inline : "yes",
	      close_previous : "no"
	  }, {
	      window : win,
	      input : field_name
	  });
	  return false;
	}
	
	
	tinyMCE.init({
        // General options
        mode : "exact",
        //language : "pt",
        elements : "tiny_mce1,tiny_mce2,tiny_mce3,tiny_mce4,tiny_mce5",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        //plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,formatselect,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,removeformat,|,bullist,numlist,|,undo,redo,|,link,unlink,image,insertimage",
        //theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,removeformat,|,bullist,numlist,|,undo,redo,|,link,unlink,image",
        //theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        //theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal: false,
        
        theme_advanced_blockformats: "p,h2,h3,h4",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        },
        
        file_browser_callback: MadFileBrowser
        
	});

});