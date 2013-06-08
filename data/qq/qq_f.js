var online = new Array();
var qq = new Array();
qq[0] = new Array(); //个人服务
qq[0][0] = "个人会员服务:";
qq[0][1] = new Array();
qq[0][1][0] = "高朋_陆";
qq[0][1][1] = "8498345";

qq[1] = new Array(); //企业服务
qq[1][0] = "企业会员服务:";
qq[1][1] = new Array();
qq[1][1][0] = "高朋_吕";
qq[1][1][1] = "5399152";

qq[2] = new Array(); //意见反馈/投诉
qq[2][0] = "意见反馈/投诉:";
qq[2][1] = new Array();
qq[2][1][0] = "高朋_滕";
qq[2][1][1] = "893362";



var script_src = "http:\/\/webpresence.qq.com\/getonline?Type=1&"
// dynamic generate script src
for(i=0;i<qq.length;i++){
	for(j=1;j<qq[i].length;j++){
		script_src += qq[i][j][1];
		script_src += ":";
	}
}

document.write( "<script language=\"javascript\" src=\"" + script_src + "\"> <\/script>");

var suspendcode;
var contactHandler1;
contactHandler1 = setInterval("checkqq()", 1000); //刷新速度，原来2000

function checkqq(){
	if(definedData(online[0])){
		clearInterval(contactHandler1);
		suspendcode="";
		var onlineP = 0;
		for(i=0;i<qq.length;i++){
			suspendcode += "<span class='contact'>\n";
			suspendcode += "<span>" + qq[i][0] + "</span>\n";
			for(j=1;j<qq[i].length;j++){
				suspendcode += "<a href='http://wpa.qq.com/msgrd?v=3&amp;uin=" + qq[i][j][1] + "&amp;site=www.jhrcw.com&amp;menu=yes' target='_blank' class='qq'><img border='0' align='absmiddle' src='/data/qq/qqs_" + online[onlineP++] + ".gif' title='点击QQ与我们交流' />" + qq[i][j][0] + "</a>\n";
			}
			suspendcode += "</span>&nbsp;&nbsp;&nbsp;&nbsp;\n";
		}
		document.getElementById("qq").innerHTML = suspendcode;
		//document.write(suspendcode);
	}
}

function definedData(varData){
	if(varData == null && varData == undefined){
		return false;
	}
	return true;
}