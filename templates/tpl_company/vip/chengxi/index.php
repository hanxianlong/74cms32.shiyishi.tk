<?php
include_once( "../../common.php" );
include_once(S_ROOT.'./source/function_cp.php');
include_once(S_ROOT."./job/config.inc.php");
include_once(S_ROOT."./job/function.inc.php");
include_once(S_ROOT."./job/common.inc.php");
//echo $_SGLOBAL['timestamp'];
$id = 146; //��˾ID

if ($id > 0) {
    $list = sqlforlist("job_company", "id = $id");
    if (!$list) showmessage('�Բ���,��˾�����ڣ�');
}
else {
     showmessage("�Ƿ�����!");
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
$corpsizes = array("1-49��", "50-99��", "100-499��", "500-999��", "1000������");
$corpregareas = array("����", "�й���½", "�й����", "�й�̨��", "�й�����", "������", "ŷ��", "����", "����", "����", "����", "����", "Ӣ��", "����", "�¹�", "�ձ�", "����", "�¼���", "���ô�");
$jobtypes = array("��", "ȫְ", "��ְ", "��ʱ", "ʵϰ");
$emoluments = array("����", "2000��3000/��", "3000��4000/��", "4000��6000/��", "6000��8000/��", "8000��10000/��", "10000��15000/��", "15000��20000/��", "20000��30000/��", "30000����/��");
$senioritys = array("����", "��Уѧ��", "Ӧ���ҵ��", "һ������", "��������", "��������", "��������", "��������", "ʮ������");
?>
<?php $_TPL['titles'] = array($list[corptitle]); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>�д����������������޹�˾ -- ������Ƹ��</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<META content="������Ƹ���ṩ������Ƹ��ְ,���󹤳���Ƹ��ְ,������Ƹ��ְ�ȷ���" name=description>
<META content="������Ƹ,�����˲���Ƹ,������ְ,���������Ƹ��ְ,�й������˲���ְ��Ƹ,�����뺣�󹤳���ְ��Ƹ" name=keywords>
<LINK href="index.files/style.css" type=text/css rel=stylesheet>

<META content="MSHTML 6.00.2900.5897" name=GENERATOR></HEAD>
<BODY>
<DIV class=page>
<DIV class=logo><IMG height=81 src="index.files/top.jpg" width=960 align=top 
useMap=#Map border=0> 
  <MAP id=Map name=Map><AREA shape=RECT alt=��˾��� 
  coords=365,0,478,65 href="#01">
<AREA 
  shape=RECT alt=��Ƹְλ coords=514,0,617,65 
  href="#02">
<AREA shape=RECT alt=��ϵ��ʽ 
  coords=666,4,759,60 href="#">
<AREA 
  shape=RECT target=_blank alt=��˾��վ coords=805,1,943,66 
  href="http://chengxi.cssc.net.cn/">
  </MAP></DIV>
<DIV class=banner>
  <script language=JavaScript> //js����               

                            var bannerAD=new Array(); //���ڴ��ͼƬ·�������·����

                            var adNum=0;        

                            bannerAD[0]="index.files/0.jpg";

                            bannerAD[1]="index.files/1.jpg";

                            bannerAD[2]="index.files/2.jpg";  
							bannerAD[2]="index.files/3.jpg"; 



                            function setTransition(){

                                          if (document.all){

                                          bannerADrotator.filters.revealTrans.Transition=Math.floor(Math.random()*23);//����ͼƬ�л�

                                                        bannerADrotator.filters.revealTrans.apply(); //Ӧ��ͼƬ�л�

                                          }

                            }            

                            function playTransition(){

                                          if (document.all)

                                                        bannerADrotator.filters.revealTrans.play() //����ͼƬ

                            }            

                            function nextAd(){

                                          if(adNum<bannerAD.length-1)adNum++;

                                          else adNum=0;

                                          setTransition();

                                          document.images.bannerADrotator.src=bannerAD[adNum];

                                          playTransition();

                                          theTimer=setTimeout("nextAd()", 5000); //5�����л�һ��ͼƬ

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
      <TH align="center" noWrap bgcolor="#D0E7BC">ְλ����</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">�����ص�</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">��������</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">��Ƹ����</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">��н</TH>
      <TH align="center" noWrap bgcolor="#D0E7BC">�򷢲�������</TH>
    </TR>
<?php if(is_array($joblist)) { foreach($joblist as $key => $job) { if($job[dateline]+$job[days]*24*3600 > $_SGLOBAL['timestamp']) { ?>
    <TR>
      <TD align="left"><a title="<?=$list['corptitle']?>��Ƹ<?=$job['title']?>" target="_blank" class="b large" href="../../job.php?ac=jobs&id=<?=$job['id']?>"><?=$job['title']?></a></TD>
      <TD align="center"><?=GetAddressByIds($job['jobprovince'], 0, 1)?></TD>
      <TD align="center">		<?php
		if ($job['seniority']==0){
		echo '����';
		}
		else{
		echo $job['seniority'] . ' ��';
		}
		?></TD>
      <TD align="center"><?php
		if ($job['pcount']==0){
		echo '����';
		}
		else{
		echo $job['pcount'] . ' ��';
		}
		?></TD>
      <TD align="center"><?=$emoluments[$job['emolument']]?></TD>
      <TD align="center"><?php if($job['replynum']) { ?>
                <a href="../../job.php?ac=jobs&id=<?=$job['id']?>#jobcomment" class="t-center block wideHigh wideHighed" target="_blank"><span><?=$job['replynum']?></span>������</a>
                <?php } else { ?>
                <a href="../../job.php?ac=jobs&id=<?=$job['id']?>#jobcomment" class="green t-center block wideHigh" target="_blank">��������</a>
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
style="FONT-SIZE: 12px; LINE-HEIGHT: 20px; FONT-FAMILY: '����'; TEXT-ALIGN: center"><span class="bottomTitMemu" style="FONT-SIZE: 12px; LINE-HEIGHT: 20px; FONT-FAMILY: '����'; TEXT-ALIGN: center"><a href="http://www.imarine.cn" target="_blank">��de����</a>������վ ��<a href="http://www.shiphr.com" target="_blank">������Ƹ��</a>�� ��Ȩ����(<a href="http://www.shiphr.com" target="_blank">http://www.shiphr.com</a>)
  <script language="javascript" type="text/javascript" src="http://js.users.51.la/3954073.js"></script>
  <noscript>
  <a href="http://www.51.la/?3954073" target="_blank"><img  src="http://img.users.51.la/3954073.asp" style="border:none" /></a></DIV>
</DIV></BODY></HTML>
