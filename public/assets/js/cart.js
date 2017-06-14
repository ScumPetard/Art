(function(){

})();

$(function(){
	
	//数量控制
	
	function setNum(){
		
		var yNum1 = 0;
		var yNum2 = 0;
		
		$(".chk").each(function(num){			
			if($(this).hasClass("chk_hover")){
				var _par = $(this).parents(".cart_item");
				yNum1++;
				yNum2 += $(".num",_par).val()*1;	
			}
		});
		
		$(".yx1").html(yNum1);		
		$(".yx2").html(yNum2);
		
	}

	//全选
	$(".chk_all").click(function(){
		
		if($(this).hasClass("chk_allhover")){	//取消全选
			$(this).removeClass("chk_allhover");	
			$(".chk").removeClass("chk_hover");
			$(".ck_d").each(function(){
				this.checked=false;	
			});
		}else{	//全选
			$(this).addClass("chk_allhover");		
			$(".chk").addClass("chk_hover");
			$(".ck_d").each(function(){
				this.checked=true;	
			});
		}
		
		setNum();
			
	});
	
	//单选
	$(".chk").click(function(){
		if($(this).hasClass("chk_hover")){	//取消选中
			$(this).removeClass("chk_hover");	
		}else{	//选中
			$(this).addClass("chk_hover");		
		}	
		setNum();
	});
	
	$(".num_ctrl .c_btn").click(function(){
		setNum();	
	});

});	