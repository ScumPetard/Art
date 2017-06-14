(function(){

})();

$(function(){
	
	new ChangeDiv({
		btns : $(".det_tabs .handle a"),
		divs : $(".det_tabs .con")	
	});
	
	//分享
	$(".share_a").click(function(){
		if($(".share_area").is(":hidden")){
			$(".share_area").show();	
		}else{
			$(".share_area").hide();		
		}
	});
	
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