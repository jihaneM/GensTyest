jQuery(document).ready(function(){

	/* BOX Do you like? */

	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.doyoulike').fadeIn();
		} else {
			$('.doyoulike').fadeOut();
		}
	});

    /* POP UP */

    $('#content article header .share li span, .doyoulike div span').popupWindow({ 
		centerBrowser:1 
	});

	 /* MENU - SELECT */
	
	$('<div id="menu-mobile">').appendTo("#menu");

	$("<select />").appendTo("#menu-mobile");
	
	$("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : "Menu"
	}).appendTo("#menu select");
	
	$("#menu a").each(function() {
		var el = $(this);
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo("#menu select");
	});

	$("#menu select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
		 
});

/* CARGO JS DE FORMA ASINCRONA */

$(window).load(function () {

	(function(doc, script) {
        var js, 
            fjs = doc.getElementsByTagName(script)[0],
            frag = doc.createDocumentFragment(),
            add = function(url, id) {
                if (doc.getElementById(id)) {return;}
                js = doc.createElement(script);
                js.src = url;
                id && (js.id = id);
                frag.appendChild( js );
            };
        
        // Google Analytics
	    //add(('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js', 'ga');
	    // Google+ button
	    add('https://apis.google.com/js/plusone.js');
	    // Facebook SDK
	    add('//connect.facebook.net/es_LA/all.js#xfbml=1');
	    // Twitter SDK
	    add('//platform.twitter.com/widgets.js', 'twitter-wjs');       
    
        fjs.parentNode.insertBefore(frag, fjs);
    }(document, 'script'));

});

/* POP UP */

(function($){ 		  
	$.fn.popupWindow = function(instanceSettings){
		
		return this.each(function(){
		
		$(this).click(function(){
		
		$.fn.popupWindow.defaultSettings = {
			centerBrowser:0,
			centerScreen:0,
			height:500,
			left:0,
			location:0,
			menubar:0,
			resizable:0,
			scrollbars:0,
			status:0,
			width:500,
			windowName:null,
			windowURL:null,
			top:0,
			toolbar:0
		};
		
		settings = $.extend({}, $.fn.popupWindow.defaultSettings, instanceSettings || {});
		
		var windowFeatures =    'height=' + settings.height +
								',width=' + settings.width +
								',toolbar=' + settings.toolbar +
								',scrollbars=' + settings.scrollbars +
								',status=' + settings.status + 
								',resizable=' + settings.resizable +
								',location=' + settings.location +
								',menuBar=' + settings.menubar;

				settings.windowName = this.name || settings.windowName;
				settings.windowURL = $(this).data('link') || settings.windowURL;
				var centeredY,centeredX;
			
				if(settings.centerBrowser){
						
					if ($.browser.msie) {//hacked together for IE browsers
						centeredY = (window.screenTop - 120) + ((((document.documentElement.clientHeight + 120)/2) - (settings.height/2)));
						centeredX = window.screenLeft + ((((document.body.offsetWidth + 20)/2) - (settings.width/2)));
					}else{
						centeredY = window.screenY + (((window.outerHeight/2) - (settings.height/2)));
						centeredX = window.screenX + (((window.outerWidth/2) - (settings.width/2)));
					}
					window.open(settings.windowURL, settings.windowName, windowFeatures+',left=' + centeredX +',top=' + centeredY).focus();
				}else if(settings.centerScreen){
					centeredY = (screen.height - settings.height)/2;
					centeredX = (screen.width - settings.width)/2;
					window.open(settings.windowURL, settings.windowName, windowFeatures+',left=' + centeredX +',top=' + centeredY).focus();
				}else{
					window.open(settings.windowURL, settings.windowName, windowFeatures+',left=' + settings.left +',top=' + settings.top).focus();	
				}
				return false;
			});
			
		});	
	};
})(jQuery);