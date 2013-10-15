jQuery(document).ready(function($) {

	jQuery('.social-buttons li').hover(function($){
		jQuery(this).toggleClass('on');
	});

});


	$(document).ready(function() {
		//TABS-SYSTEM
		//When page loads...
		$(".tab-content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(".tab-content:first").show(); //Show first tab content
	
		//On Click Event
		$("ul.tabs li").click(function() {
	
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab-content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
		});
		
		
	 
	});

/* MODERNIZR
//------------------------------------------------- */

$(document).ready(function() {

if(!Modernizr.input.placeholder){
	$("input").each(function(){
		if($(this).val()=="" && $(this).attr("placeholder")!=""){
			$(this).val($(this).attr("placeholder"));
			$(this).focus(function(){
				if($(this).val()==$(this).attr("placeholder")) $(this).val("");
			});
			$(this).blur(function(){
				if($(this).val()=="") $(this).val($(this).attr("placeholder"));
			});
		}
	});
}
});


/* SOCIAL SCRIPTS
//-------------------------------------------------
// Facebook Commenting/Like Box/Like Button Javascript SDK //
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=";
  js.src += fb_app_id;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


// Pinterest
(function (w, d, load) {
 var script, 
 first = d.getElementsByTagName('SCRIPT')[0],  
 n = load.length, 
 i = 0,
 go = function () {
   for (i = 0; i < n; i = i + 1) {
     script = d.createElement('SCRIPT');
     script.type = 'text/javascript';
     script.async = true;
     script.src = load[i];
     first.parentNode.insertBefore(script, first);
   }
 }
 if (w.attachEvent) {
   w.attachEvent('onload', go);
 } else {
   w.addEventListener('load', go, false);
 }
}(window, document, 
 ['//assets.pinterest.com/js/pinit.js']
));    

// Google
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

// Twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs"); */