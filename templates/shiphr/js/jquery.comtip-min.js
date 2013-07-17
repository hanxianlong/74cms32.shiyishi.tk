/**
Vertigo Tip by www.vertigo-project.com
Requires jQuery
*/
jQuery.joblisttip= function(ajaxurl,loading,css) {
    $(".comtip").unbind().hover(
        function(event)
		{
			event.stopPropagation(); // do something
			var domtitle = this.title;
			var uid = this.id;
            this.title = ''; 
			if (domtitle=='')
			{
				$(this).append( '<div class="'+ css +'"><div class="tit"></div><div class="txt"><div class="tits">ÕÐÆ¸¸ÚÎ»</div><ul>' + loading + '</ul></div></div>' );
				$(this).css("position","relative").css("position","relative").fadeIn(10);	
					var insertobj=$(this);
					$.get(ajaxurl, {"uid":uid},
						function (data,textStatus)
						{
						insertobj.find("ul").html(data);
						domtitle=data;
						}
				);				
			}
			else
			{
				$(this).append( '<div class="'+ css +'"><div class="tit"></div><div class="txt"><div class="tits">ÕÐÆ¸¸ÚÎ»</div><ul>' + domtitle+ '</ul></div></div>' );
				$(this).css("position","relative").css("position","relative").fadeIn(10); 
			} 			           
        },
        function()
		{
					if ($("."+css).find("ul").html()==loading)
					{
						this.title = '';
					}
					else
					{
						this.title = $("."+css).find("ul").html();
					}
					$(this).css("position","");
					$("."+css).fadeOut("slow").remove();
        }
    );
};
