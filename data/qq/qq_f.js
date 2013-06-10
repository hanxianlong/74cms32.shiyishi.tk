var online = new Array();
var qq = new Array();
qq[0] = new Array(); //个人服务
qq[0][0] = "企业咨询:";
qq[0][1] = new Array();
qq[0][1][0] = "QQ咨询";
qq[0][1][1] = "408343893";

qq[1] = new Array(); //企业服务
qq[1][0] = "技术支持:";
qq[1][1] = new Array();
qq[1][1][0] = "QQ咨询";
qq[1][1][1] = "2250273226";

qq[2] = new Array(); //意见反馈/投诉
qq[2][0] = "售后服务:";
qq[2][1] = new Array();
qq[2][1][0] = "QQ咨询";
qq[2][1][1] = "1694797205";

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
contactHandler1 = setInterval("checkqq()", 5000); //刷新速度，原来2000

function checkqq(){
	if(definedData(online[0])){
		clearInterval(contactHandler1);
		suspendcode="";
		var onlineP = 0;
		for(i=0;i<qq.length;i++){
			suspendcode += "<span class='contact'>\n";
			suspendcode += "<span>" + qq[i][0] + "</span>\n";
			for(j=1;j<qq[i].length;j++){
				suspendcode += "<a href='http://wpa.qq.com/msgrd?v=3&amp;uin=" + qq[i][j][1] + "&amp;site=www.shiphr.com&amp;menu=yes' target='_blank' class='qq'><img border='0' align='absmiddle' src='/data/qq/qqs_" + online[onlineP++] + ".gif' title='点击QQ与我们交流' />" + qq[i][j][0] + "</a>\n";
			}
			suspendcode += "</span>&nbsp;&nbsp;&nbsp;&nbsp;\n";
		}
		document.getElementById("qq").innerHTML = suspendcode;
	}
}

function definedData(varData){
	if(varData == null && varData == undefined){
		return false;
	}
	return true;
}