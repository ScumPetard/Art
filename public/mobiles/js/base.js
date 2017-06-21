(function(){
	
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
	
	$(document.body).css("min-height",$(window).height());
	$(window).resize(function(){
		document.getElementsByTagName('html')[0].style.fontSize = Math.min(window.innerWidth*12/320,200)+"px";		
		$(document.body).css("min-height",$(window).height());
	});
	

});	