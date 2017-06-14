(function(){

//清除所有input的value
	function ClearValue(forms){
		this.forms = forms;
		this.load();	
	}
	
	ClearValue.prototype = {
		constructor : this,
		load : function(){
			var _this = this;			
			this.forms.each(function(){
				_this.clearValue($(this));	
			});
		},
		clearValue : function(fm){			
			this.inputs = $("input.text,input.keyword",fm);
			this.textarea = $("textarea",fm);
			var _this = this;
			var dValues = [];	
			var aValues = [];		
			this.inputs.each(function(n){
				dValues[n] = $(_this.inputs[n]).val();
			});
			this.textarea.each(function(n){
				aValues[n] = $(_this.textarea[n]).html();
			});
						
			this.inputs.each(function(n){
				$(this).focus(function(){
					if($(this).val() == dValues[n]){
						$(this).val("");	
						$(this).addClass("text_hover");
					}
				});	
				$(this).blur(function(){
					if($(this).val() == ""){
						$(this).val(dValues[n]);	
						$(this).removeClass("text_hover");
					}else{
						$(this).addClass("text_hover");	
					}
				});
			});	
			this.textarea.each(function(n){
				$(this).focus(function(){
					if($(this).html() == aValues[n]){
						$(this).html("");	
						$(this).removeClass("text_hover");
					}
				});	
				$(this).blur(function(){
					if($(this).html() == ""){
						$(this).html(aValues[n]);	
						$(this).removeClass("text_hover");
					}else{
						$(this).addClass("text_hover");		
					}
				});	
			});
		}	
	};
	
	window.ClearValue = ClearValue;
	//清除所有input的value
	
	//顶端adver渐隐
	
function FadeAdver(args){
	for(var i in args){
			this[i] = args[i];	
		}	
		this.speed = args.speed ? args.speed : 5000;	//间隔时间默认5秒
		this.sTime = args.sTime ? args.sTime : 500;	//渐进时间，默认1秒
		this.load();
		this.start();
}

FadeAdver.prototype ={
	constructor : this,
	load : function(){
		var _this = this;
		this.num = 0;	//计时器
		this.mNum = this.num+1;	//轮播计时
		this.len = this.divs.length;					
		
		//所有div设置absolute并排好index
		this.divs.each(function(num){
			var z_index = 50-num;
			$(this).css({
				"position" : "absolute",
				"left" : 0,
				"top" : 0,
				"z-index" : z_index,
				"display" : "none"	
			})
		});
		
		$(this.divs[0]).show();
		
		//所有div设置absolute并排好index
		
			
		this.btns.each(function(num){
			$(this).mouseover(function(){
				_this.show(num);	
				_this.stop();				
			}).mouseout(function(){
				_this.start();	
			});	
		});
		
		//左右按钮的使用
		if(!!this.preBtn && !!this.nextBtn){
			this.preBtn.css("z-index",60);
			this.preBtn.click(function(){
				var num = _this.num - 1;
				if(num < 0){
					num = _this.len-1;		
				}	
				_this.show(num);
			});	
			this.nextBtn.css("z-index",60);
			this.nextBtn.click(function(){
				var num = _this.num + 1;
				if(num >= _this.len){
					num = 0;		
				}	
				_this.show(num);
			});	
		}
		
		this.divs.each(function(num){
			$(this).mouseover(function(){					
				_this.stop();				
			}).mouseout(function(){
				_this.start();	
			});	
		});
	},
	show : function(num){
		if(num == this.num) return;	//同一个返回
		
		
		var _this = this;
		this.flag  = false;	//关闭控制开关
		this.btns.each(function(i){
			if(i == num){
				$(this).addClass("hover");	
			}else{
				$(this).removeClass("hover");	
			}				
		});
				
		$(this.divs[this.num]).fadeOut(this.sTime);	//旧的淡出
						
		$(this.divs[num]).fadeIn(_this.sTime);		//新的淡入
		_this.num = num;	
		_this.mNum = num+1;			
				
	},
	start : function(){
		var _this = this;					
		this.interval = setInterval(function(){					
			if(_this.mNum >= _this.len){
				_this.mNum = 0;
			}						
			_this.show(_this.mNum);								
		},this.speed);
	},
	stop : function(){
		clearInterval(this.interval);
	}	
};

window.FadeAdver = FadeAdver;
//顶端adver	

//ChangeDiv切换效果
function ChangeDiv(args){
	for(var i in args){
		this[i] = args[i];	
	}	
	this.type = this.type ? this.type : "mouseover";
	this.load();
}

ChangeDiv.prototype = {
	constructor : this,
	load : function(){
		var _this = this;
		this.btns.each(function(num){
			if(_this.type == "click"){
				$(this).click(function(){
					_this.change(num)	
				});		
			}else{
				$(this).mouseover(function(){
					_this.change(num)	
				});		
			}			
		});	
	},
	change : function(num){
		var _this = this;
		
		this.btns.each(function(n){
			if(n ==num){
				$(this).addClass("hover");		
			}else{
				$(this).removeClass("hover");		
			}				
		});
		
		this.divs.each(function(n){
			if(n ==num){
				$(this).addClass("show");		
			}else{
				$(this).removeClass("show");		
			}				
		});
	}	
};

window.ChangeDiv = ChangeDiv;
//ChangeDiv切换效果

})();

$(function(){

	new ClearValue($("form"));	//清除默认form
	
	//banner 大轮播图
	if($(".banner").length != 0){
		new FadeAdver({
			btns : $(".banner .btns span"),
			divs : $(".banner .pics li"),
			preBtn : $(".banner .pre"),
			nextBtn : $(".banner .next"),
			speed : 5000	
		});	
	}
	
	//num_ctrl 数量控制
	$(".num_ctrl .pre").click(function(){
		var _par = $(this).parents(".num_ctrl");
		var oldNum = $(".num",_par).val()*1;
		if(oldNum <= 1){
			return;	
		}	
		oldNum--;
		
		$(".num",_par).val(oldNum);
		
	});
	
	$(".num_ctrl .next").click(function(){
		var _par = $(this).parents(".num_ctrl");
		var oldNum = $(".num",_par).val()*1;		
		oldNum++;		
		$(".num",_par).val(oldNum);
		
	});
	
	//pass密码提示文字
	$(".ps1").focus(function(){
		var _par = $(this).parent();
		$(this).hide();
		$(".ps2",_par).show().focus();	
	});
	
	$(".ps2").blur(function(){
		var _par = $(this).parent();
		if($(this).val() == ""){
			$(this).hide();
			$(".ps1",_par).show();		
		}							
	});
	
	//pro_nav 固定住
	if($(".pro_nav").length != 0){
		
		$(".banner_zw").load(function(){
			
				var poTop = $(".pro_cla").offset().top;		
				var pnTop = $(".pro_nav").offset().top;						
				var tH = $(".header").height()+$(".header2").height();
				var tLeft = $(".pro_nav").offset().left;
				
				
				
				function setFixed(){
					
					if($(window).scrollTop() >= poTop){
						$(".pro_cla").addClass("pro_clafixed");	
						$(".proheader").hide();
						$(".header2").hide();
						$(".pro_cla").css({
							"top" : 0
						});
						$(".pro_zw").show();
					}else{
						$(".pro_cla").removeClass("pro_clafixed");	
						$(".proheader").show();
						$(".header2").show();		
						$(".pro_zw").hide();				
					}
					
					if($(window).scrollTop() >= pnTop -110){
						$(".pro_nav").addClass("pro_fixed");	
						$(".pro_nav").css({
							"top" : 110,
							"left" : tLeft
						});
						
					}else{
						$(".pro_nav").removeClass("pro_fixed");		
						$(".pro_nav").css({
							"top" : 0,
							"left" : 0
						});			
					}
						
				}
				
				setFixed();
				
				$(window).scroll(function(){						
					setFixed();						
				});
					
		});					
			
	}

});	