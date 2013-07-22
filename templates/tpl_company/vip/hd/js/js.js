//    ----------------------- 脚本文件 ------------------------------
var i = 3;  //设置每版的图片数量
var page = 1; //设置初始版面
	var pagewidth= $(".product").width();
		$(".goright").click()
	{
	
	var len = $(".productmain li").length;
		var page_count = Math.ceil(len / i);
		if (page == page_count)
		{
			$(".productmain").animate({"margin-left":"0"},"normal");
			page = 1;
		}
		else{
			$(".productmain").animate({"margin-left":"-="+pagewidth},"normal")
			page++;
		}
	};
$(function(){
	$(".pl-1 .project").height($(".pl-2").height()-2);
	$(".pul li").hover(function(){
		$(this).siblings().removeClass("on");
		$(this).addClass("on");
		$(this).parent().parent().next(".auto").find(".list").hide().eq($(this).index()).show();
	});
	$(".nav .nobg").hover(function(){
		$(this).siblings().find("a").removeAttr("id");
		$(".subnav ul").hide();
	});
	$(".nav li:not(.nobg)").hover(function(){
		$(this).siblings().find("a").removeAttr("id");
		$(this).find("a").attr("id","this");
		$(".subnav ul").hide().eq($(this).index()-1).show();
	});
	$(".cate").hover(function(){
		$(this).siblings().removeClass("catebg");
		$(this).addClass("catebg");
	});
	$(".pull li").hover(function(){
		$(this).siblings().removeClass("on");
		$(this).addClass("on");
		$(this).parent().parent().next(".auto").find(".list2").hide().eq($(this).index()).show();
	}); 
	var page = 1; //设置初始版面
	var i = 3;  //设置每版的图片数量
	var pagewidth= $(".product").width();
	$(".goright").click(function(){
		var len = $(".productmain li").length;
		var page_count = Math.ceil(len / i);
		if (page == page_count)
		{
			$(".productmain").animate({"margin-left":"0"},"normal");
			page = 1;
		}
		else{
			$(".productmain").animate({"margin-left":"-="+pagewidth},"normal")
			page++;
		}
	});
	$(".goleft").click(function(){
		var len = $(".productmain li").length;
		var page_count = Math.ceil(len / i);
		if (page == 1)
		{
			$(".productmain").animate({"margin-left":"-="+pagewidth*(page_count-1)},"normal");
			page = page_count;
		}
		else{
			$(".productmain").animate({"margin-left":"+="+pagewidth},"normal");
			page--;
		}
	}); 

window.setInterval("$('.goright').click()", 4000);

})




