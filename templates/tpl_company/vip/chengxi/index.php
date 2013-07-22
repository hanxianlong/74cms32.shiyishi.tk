<?php
include_once( "../../common.php" );
include_once(S_ROOT.'./source/function_cp.php');
include_once(S_ROOT."./job/config.inc.php");
include_once(S_ROOT."./job/function.inc.php");
include_once(S_ROOT."./job/common.inc.php");
//echo $_SGLOBAL['timestamp'];
$id = 146; //公司ID

if ($id > 0) {
    $list = sqlforlist("job_company", "id = $id");
    if (!$list) showmessage('对不起,公司不存在！');
}
else {
     showmessage("非法参数!");
}
$list = $list[0];
$joblist = sqlforlist("job_newjobs", "corpid = $id AND isdeleted = 0 ORDER BY dateline DESC");
$isEdit = 1;
if (!ckfounder($uid) && $list['uid'] != $uid) $isEdit = 0;
$corptype = sqlforlist("job_ecoclass", "1 = 1");
$corptypes = array();
foreach ($corptype as $value) {
    $corptypes[$value['e_id']] = $value['e_name'];        
}
$corpsizes = array("1-49人", "50-99人", "100-499人", "500-999人", "1000人以上");
$corpregareas = array("其他", "中国大陆", "中国香港", "中国台湾", "中国澳门", "东南亚", "欧洲", "南美", "非洲", "西亚", "北美", "美国", "英国", "法国", "德国", "日本", "韩国", "新加坡", "加拿大");
$jobtypes = array("无", "全职", "兼职", "临时", "实习");
$emoluments = array("面议", "2000～3000/月", "3000～4000/月", "4000～6000/月", "6000～8000/月", "8000～10000/月", "10000～15000/月", "15000～20000/月", "20000～30000/月", "30000以上/月");
$senioritys = array("不限", "在校学生", "应届毕业生", "一年以上", "二年以上", "三年以上", "五年以上", "八年以上", "十年以上");
?>
<?php $_TPL['titles'] = array($list[corptitle]); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>中船澄西船舶修造有限公司 -- 龙船招聘网</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<META content="龙船招聘网提供船舶招聘求职,海洋工程招聘求职,航运招聘求职等服务" name=description>
<META content="船厂招聘,船舶人才招聘,船舶求职,船舶设计招聘求职,中国船舶人才求职招聘,船舶与海洋工程求职招聘" name=keywords>
<LINK href="index.files/style.css" type=text/css rel=stylesheet>

<META content="MSHTML 6.00.2900.5897" name=GENERATOR></HEAD>
<BODY>
<DIV class=page>
<DIV class=logo><IMG height=81 src="index.files/top.jpg" width=960 align=top 
useMap=#Map border=0> 
  <MAP id=Map name=Map><AREA shape=RECT alt=公司简介 
  coords=365,0,478,65 href="#01">
<AREA 
  shape=RECT alt=招聘职位 coords=514,0,617,65 
  href="#02">
<AREA shape=RECT alt=联系方式 
  coords=666,4,759,60 href="#">
<AREA 
  shape=RECT target=_blank alt=公司网站 coords=805,1,943,66 
  href="http://chengxi.cssc.net.cn/">
  </MAP></DIV>
<DIV class=banner>
  <script language=JavaScript> //js代码               

                            var bannerAD=new Array(); //用于存放图片路径（相对路径）

                            var adNum=0;        

                            bannerAD[0]="index.files/0.jpg";

                            bannerAD[1]="index.files/1.jpg";

                            bannerAD[2]="index.files/2.jpg";  
							bannerAD[2]="index.files/3.jpg"; 



                            function setTransition(){

                                          if (document.all){

                                          bannerADrotator.filters.revealTrans.Transition=Math.floor(Math.random()*23);//设置图片切换

                                                        bannerADrotator.filters.revealTrans.apply(); //应用图片切换

                                          }

                            }            

                            function playTransition(){

                                          if (document.all)

                                                        bannerADrotator.filters.revealTrans.play() //播放图片

                            }            

                            function nextAd(){

                                          if(adNum<bannerAD.length-1)adNum++;

                                          else adNum=0;

                                          setTransition();

                                          document.images.bannerADrotator.src=bannerAD[adNum];

                                          playTransition();

                                          theTimer=setTimeout("nextAd()", 5000); //5秒钟切换一张图片

                            }                          

                            </script>
  <img style="FILTER: revealTrans(duration=2,transition=20)" height=190 width="960" src="index.files/0.jpg"   name=bannerADrotator>
  <SCRIPT language=JavaScript>nextAd()</SCRIPT>
</DIV>
<DIV class=title><A id=01 name=01></A><IMG height=30 src="index.files/t1.gif" 
width=960></DIV>
<DIV class=main_content style="padding-top:10px; padding-bottom:20px">
<P>
  <?=$list['corpdescription']?>
</P>
</DIV>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="pics/1.jpg" target="_blank"><img src="pics/1_1.jpg" width="150" border="0"></a></td>
    <td align="center"><a href="pics/2.jpg" target="_blank"><img src="pics/2_2.jpg" width="150" border="0"></a></td>
    <td align="center"><a href="pics/3.jpg" target="_blank"><img src="pics/3_3.jpg" width="150" height="100" border="0"></a></td>
    <td align="center"><a href="pics/4.jpg" target="_blank"><img src="pics/4_4.jpg" width="150" border="0"></a></td>
    <td align="center"><a href="pics/5.jpg" target="_blank"><img src="pics/5_5.jpg" width="150" border="0"></a></td>
  </tr>
</table>
<br>
&nbsp;
<DIV class=title><A id=02 name=02></A><IMG height=30 src="index.files/t2.gif" 
width=960></DIV>
<DIV class=main_content>
  <TABLE width="930" border=0 cellPadding=0 cellSpacing=1 id=job_list name="job_list">
  <TBODY>
    <TR id=job_title name="job_title">
      <TH align="center" noWrap bgcolor="#D0E7BC">职位名称</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">工作地点</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">工作经验</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">招聘人数</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">月薪</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">向发布者提问</TH>
    </TR>
<?php if(is_array($joblist)) { foreach($joblist as $key => $job) { if($job[dateline]+$job[days]*24*3600 > $_SGLOBAL['timestamp']) { ?>
    <TR>
      <TD align="left"><a title="<?=$list['corptitle']?>招聘<?=$job['title']?>" target="_blank" class="b large" href="../../job.php?ac=jobs&id=<?=$job['id']?>"><?=$job['title']?></a></TD>
      <TD align="center"><?=GetAddressByIds($job['jobprovince'], 0, 1)?></TD>
      <TD align="center">		<?php
		if ($job['seniority']==0){
		echo '不限';
		}
		else{
		echo $job['seniority'] . ' 年';
		}
		?></TD>
      <TD align="center"><?php
		if ($job['pcount']==0){
		echo '若干';
		}
		else{
		echo $job['pcount'] . ' 人';
		}
		?></TD>
      <TD align="center"><?=$emoluments[$job['emolument']]?></TD>
      <TD align="center"><?php if($job['replynum']) { ?>
                <a href="../../job.php?ac=jobs&id=<?=$job['id']?>#jobcomment" class="t-center block wideHigh wideHighed" target="_blank"><span><?=$job['replynum']?></span>条提问</a>
                <?php } else { ?>
                <a href="../../job.php?ac=jobs&id=<?=$job['id']?>#jobcomment" class="green t-center block wideHigh" target="_blank">率先提问</a>
                <?php } ?>
          </TD>
    </TR>
 <?php } } } ?>
  </TBODY>
</TABLE>
</DIV>
<DIV class=title><BR>
</DIV>
</DIV>
<DIV class=footer>
<DIV class=bottomTitMemu 
style="FONT-SIZE: 12px; LINE-HEIGHT: 20px; FONT-FAMILY: '宋体'; TEXT-ALIGN: center"><span class="bottomTitMemu" style="FONT-SIZE: 12px; LINE-HEIGHT: 20px; FONT-FAMILY: '宋体'; TEXT-ALIGN: center"><a href="http://www.imarine.cn" target="_blank">龙de船人</a>旗下网站 《<a href="http://www.shiphr.com" target="_blank">龙船招聘网</a>》 版权所有(<a href="http://www.shiphr.com" target="_blank">http://www.shiphr.com</a>)
  <script language="javascript" type="text/javascript" src="http://js.users.51.la/3954073.js"></script>
  <noscript>
  <a href="http://www.51.la/?3954073" target="_blank"><img  src="http://img.users.51.la/3954073.asp" style="border:none" /></a></DIV>
</DIV></BODY></HTML>
