lastScrollY=0;

function heartBeat()
{ 
	var diffY;
	var ioc = document.getElementById("full");
	if(ioc == null || ioc == undefined)
			return;
	
	if (document.documentElement && document.documentElement.scrollTop)
			diffY = document.documentElement.scrollTop;
	else if (document.body)
	    diffY = document.body.scrollTop
	else
	    {/*Netscape stuff*/}

	percent = .1 * (diffY - lastScrollY); 
	if(percent>0){
		percent=Math.ceil(percent); 
	}
	else{
		percent=Math.floor(percent); 
	}
	ioc.style.top = ((isNaN(parseInt(ioc.style.top)) ? 0 :parseInt(ioc.style.top))  + percent).toString() + "px";
	lastScrollY = lastScrollY+percent; 
}

var suspendcode;
var contactHandler;
contactHandler = setInterval("checkData()", 1000); //ˢ���ٶȣ�ԭ��2000

function checkData(){
		clearInterval(contactHandler);
		suspendcode="<div id=\"full\" style='right:3px; top:130px; position:absolute;z-index:1000;text-align:center;'>\n"  //top �붥�˾���
		+ "<div id='con'>\n"
		+ "<div class='list'>\n"
		+ " <div class='contact'>\n"
		+ "   <a href='/weixin/' target='_blank'><img  border='0' width='110' height='160' align='absmiddle' src='/data/weixin/2wm.gif' /></a>\n"
		+ " </div>\n"
		+ "</div>\n"
		+ "<a href='javascript:void(0)' title='�ص�����' id='toTop' onclick='toTop.set();' onfocus='this.blur()'><img src='/data/weixin/con_bom.png' width='128' height='22' style='border:0px' /></a>\n"
		+ "</div>\n"
		+ "</div>\n";
		document.getElementById("contactContanier").innerHTML = suspendcode;
}



document.write("<div id=\"contactContanier\"></div>"); 
window.setInterval("heartBeat()", 1);