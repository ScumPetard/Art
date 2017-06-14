(function(){

})();

$(function(){
	
	//det_slide 滚动
	$('.det_slide ul').carouFredSel({
			auto : {				
					timeoutDuration: 5000
				},
			direction : "left",
			prev : ".det_slide .pre",
			next : ".det_slide .next",
			scroll : 1
		});

});	