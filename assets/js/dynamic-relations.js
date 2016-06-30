// http://stackoverflow.com/questions/9659265/check-if-javascript-script-exists-on-page
function scriptLoaded(url) {
    var scripts = document.getElementsByTagName('script');
    for (var i = scripts.length; i--;) {
        if (scripts[i].src == url) return true;
    }
    return false;
}
function showLoader(spin){
	spin.css("height",spin.parent().css("height"));
	spin.css("width",spin.parent().css("width"));
	$(spin).removeClass("kv-hide");
}
function hideLoader(spin){
	$(spin).addClass("kv-hide");
}

jQuery(document).ready(function () {

	var removeFn = function(sel){
		jQuery('.remove-dynamic-relation').on('click', function(event){	
			event.preventDefault();
			var spin = $(this).closest(".box").children(".kv-spin-center").first();
			showLoader(spin);
			var me = this;
			var myLi = jQuery(me).closest('li');
			removeRoute = jQuery(this).parent().find("[data-dynamic-relation-remove-route]").attr("data-dynamic-relation-remove-route");
			
			// Set a delay to append this selected option to other selects
			setTimeout(function(){
				if(removeRoute)
				{
					jQuery.post(removeRoute, function(result){
						hideLoader(spin);
						if (result == "OK"){
							myLi.remove();
						}else{
							alert(result);
						}						
					});
				}
				else
				{
					hideLoader(spin);
					myLi.remove();
				}
			}, 2000);
		});		
	};

	jQuery('.add-dynamic-relation').on('click', function(event){
		event.preventDefault();
		var spin = $(this).parent().parent().prevAll(".kv-spin-center");
		showLoader(spin);
		
		var me = this;
		var ul =jQuery(me).parent().parent().prev().children('[data-related-view]');
		view = ul.attr('data-related-view') + "&t=" + ( new Date().getTime() );
		jQuery.get(view, function(result){
			$result = jQuery(result);
			ul.append('<li class="form-group"></li>');
            li = ul.children().last();
            hideLoader(spin);        

			li.append( $result.filter("#root") );			
					
			$result.filter('script').each(function(k,scriptNode){
				if(!scriptNode.src || !scriptLoaded( scriptNode.src ) )
				{
					jQuery("body").append( scriptNode); 
				}
			});
			removeFn( li.find('.remove-dynamic-relation') );
		});
		
	});
	removeFn('.remove-dynamic-relation');
	
});
