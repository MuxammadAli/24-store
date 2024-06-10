$(function(){
	LisHead_w = $(".head_wrap").width();
	
	$(".head_slide, .head_bg_wrap").width(LisHead_w);
	$(".head_left").click(function(){
		LisHead(false);
	});
	$(".head_right").click(function(){
		LisHead(true);
	});
	$(".head_text:first").fadeIn(200);
	
    LisHead_len = $(".head_slide").length;
	$(".head_bg").width(LisHead_w * LisHead_len);
	
	LisHead_timer = setInterval(function(){
		LisHead(true);
	}, LisHead_time * 1000);
	
	$(".head_nav").width(21 * LisHead_len);
	
	for(var i = 0;i < LisHead_len;i++){
		$(".head_nav").append('<a class="head_bounce" id="head_b'+i+'"></a>');
	}

	$("#head_b0").addClass('head_active_bounce');
	
    setInterval(function(){
		LisHead_hidden();
	}, 100);
});

var LisHead_slide = 0, LisHead_len = 0, LisHead_w;
var LisHead_timer, LisHead_time = 15; //время показа слайда в секундах

function LisHead(dir){
	clearInterval(LisHead_timer);
	LisHead_timer = setInterval(function(){
		      LisHead(true);
	        }, LisHead_time * 1000);
	$(".head_text").eq(LisHead_slide).hide();
	if(dir){
		LisHead_slide++;
		
		if(LisHead_slide == LisHead_len){
			LisHead_slide = 0;
		}
	}
	else{
		LisHead_slide--;
		
		if(LisHead_slide == -1){
			LisHead_slide = LisHead_len - 1;
		}
	}
	
	var m = -1 * LisHead_slide * LisHead_w;
	$(".head_active_bounce").removeClass("head_active_bounce");
	$("#head_b"+LisHead_slide).addClass("head_active_bounce");
	$(".head_bg").animate({marginLeft: m+"px"}, 300, function(){
		$(".head_text").eq(LisHead_slide).fadeIn(600);
	});
}

function LisHead_hidden(){
	window.LisHead_hid = LisHead_get_hidden();
	
	document.addEventListener(LisHead_hid[1], function(e){
		var h = document[LisHead_hid[0]];
		
		if(!h){
			if(LisHead_timer)return;
			
			LisHead_timer = setInterval(function(){
		      LisHead(true);
	        }, LisHead_time * 1000);
		}
		else{
			clearInterval(LisHead_timer);
			LisHead_timer = false;
		}
	}, false);
}

function LisHead_get_hidden(){
	var hidden, visibilityChange;
	
	if(typeof document.hidden !== "undefined"){
		hidden = "hidden";
		visibilityChange = "visibilitychange";
	}
	else if(typeof document.mozHidden !== "undefined"){
		hidden = "mozHidden";
		visibilityChange = "mozvisibilitychange";
	}
	else if(typeof document.msHidden !== "undefined"){
		hidden = "msHidden";
		visibilityChange = "msvisibilitychange";
	}
	else if(typeof document.webkitHidden !== "undefined"){
		hidden = "webkitHidden";
		visibilityChange = "webkitvisibilitychange";
	}
	
	return [hidden, visibilityChange];
}
