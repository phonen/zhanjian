<?php
//QQ:7668765
?>
<?php
ob_start( );
require( "config.php");
$db->query( "SELECT * FROM c_config where fig_md5='".$_GET['api']." '");
$configs = $db->fetch_array( $rs );
$website = $configs['fig_website'];
$qqlistcards = $configs['fig_qqlist'];
$filename = $configs['fig_filename'];
$filewords = $configs['fig_filewords'];
$file = $configs['fig_file'];
$sumnumer = $configs['fig_sumnumer'];
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
*{margin:0;padding:0}
body{font:normal 14px/1.6 "微软雅黑","宋体", Arial, Helvetica, sans-serif;color:#066;background:#fff;}
a:link{color:#000;text-decoration:none;}
a:visited{color:#810081;text-decoration:none;}
a:hover{color:#39F;text-decoration:none;}
img{border:0}
ul,li{list-style-type: none;}
h1,h2,h3{font-size:14px;font-weight:bold;}
#c_wid{width:100%; height:370px;background:url(lib/img/aap.png) repeat;}
#c_wid_mil{width:540px; padding:30px; margin:0px auto;}
#c_wid_mil h1{ font-size:22px; font-family:"黑体"; text-align:center; height:40px; line-height:40px; color:#F00; font-weight:200; }
#c_wid_mil p{ line-height:24px;}
#c_wid_mil #c_form .ci{ border:1px solid #999; height:30px; line-height:30px; padding-left:5px; width:200px; color:#CCC}
#c_wid_mil #c_form .button{width:100px; height:30px; background:#F00; border:0px; color:#fff; font-weight:bold;}
#c_wid_mil #c_form textarea{ width:500px; height:60px; padding:5px}
</style>
<script type="text/javascript">
function j_submit(){

if(document.formc.uname.value==""){


alert("称呼不能为空");


document.formc.uname.focus();


return false;

}else if(document.formc.uname.value=="请输入您的称呼..."){


alert("称呼输入有误");


document.formc.uname.focus();


return false;

}else if(document.formc.uemail.value==""){


alert("QQ号码不能为空");


document.formc.uemail.focus();


return false;

}else if(document.formc.uemail.value=="请输入您的QQ号码..."){


alert("QQ号码输入有误");


document.formc.uemail.focus();


return false;

}else{


return true;

}
}
</script>
</head>
';
if ( $_POST['uname'] != ""&&$_POST['uemail'] != "")
{
$qq = "/^[1-9]*[1-9][0-9]{5,11}\$/";
if ( preg_match( $qq,$_POST['uemail'] ) )
{
$email = $_POST['uemail']."@qq.com";
$db->query( "SELECT * FROM c_words where uname='".$_POST['uname']." ' and uemail='".$email."' and fig_id='".$configs['fig_id']."'");
$rowmo = $db->fetch_array( $rs );
if ( $rowmo )
{
$ucookie = $rowmo['ucookie'];
$ip = $rowmo['uip'];
setcookie( "toboip","{$ip}",time( ) +25200,"/");
setcookie( "tobock","{$ucookie}",time( ) +25200,"/");
echo tiao( "重新登录成功！","index.php?api=".$_GET['api'] );
exit( );
}
$email = $_POST['uemail']."@qq.com";
$ip = egetip_joy( );
$ucookie = md5( $ip.time( ) );
$myinst = $db->query( "INSERT c_words(uname,uemail,ucookie,uip,qqlist,utime,numrs,fig_id) VALUES ('".$_POST['uname']."','".$email."','".$ucookie."','".$ip."','0','".time( )."','0','".$configs['fig_id']."')");
if ( $myinst )
{
setcookie( "toboip","{$ip}",time( ) +259200,"/");
setcookie( "tobock","{$ucookie}",time( ) +259200,"/");
echo tiaos( "index.php?api=".$_GET['api'] );
exit( );
}
echo tiao( "生成分享代码失败，请联系管理员！","index.php?api=".$_GET['api'] );
exit( );
}
echo tiao( "你输入的QQ号码错误","index.php?api=".$_GET['api'] );
exit( );
}
if ( $_COOKIE['tobock'] != "")
{
$db->query( "SELECT * FROM c_words where ucookie='".$_COOKIE['tobock']." ' and fig_id='".$configs['fig_id']."'");
$row = $db->fetch_array( $rs );
if ( $row['id'] != "")
{
$cick = 1;
}
else
{
$cick = 0;
}
}
else
{
$ip = egetip_joy( );
$db->query( "SELECT * FROM c_words where uip='".$ip." ' and fig_id='".$configs['fig_id']."'");
$row = $db->fetch_array( $rs );
if ( $row['id'] != "")
{
$cick = 1;
}
else
{
$cick = 0;
}
}
;echo '<body>
<div id="c_wid">
';
if ( $cick == 0 )
{
if ( $_GET['s'] != ""&&$_COOKIE['tobock'] == "")
{
$db->query( "SELECT * FROM c_words where id='".$_GET['s']." ' and fig_id='".$configs['fig_id']."'");
$rowb = $db->fetch_array( $rs );
if ( $rowb['id'] != "")
{
$ip = egetip_joy( );
$db->query( "SELECT * FROM c_ip where iip like '%".$ip."%'  and fig_id='".$configs['fig_id']."'");
$rows = $db->fetch_array( $rs );
if ( $rows['iid'] == "")
{
$db->query( "UPDATE c_words SET numrs=numrs+1 WHERE id='".$_GET['s']."' and fig_id='".$configs['fig_id']."'");
$db->query( "INSERT c_ip(iip,itime,fig_id) VALUES ('".$ip."','".time( )."','".$configs['fig_id']."')");
}
else if ( $rows['iid'] != ""&&432000 <time( ) -$rows['itime'] )
{
$db->query( "UPDATE c_words SET numrs=numrs+1 WHERE id='".$_GET['s']."' and fig_id='".$configs['fig_id']."'");
$db->query( "UPDATE c_ip SET itime='".time( )."' WHERE iid='".$rows['id']."'");
}
}
}
;echo '                
                
                
            
<div id="c_wid_mil">
  <fieldset>    <legend><span style="font-size:16px; font-weight:bold;">免费领取</span></legend> 
<h1>完成三步，即可领取“';
echo $filename;
;echo '”!</h1>
        <p>
        
<span style="color:#06F">1、输入称呼、常用QQ号码（当前操作步骤）</span><br />
        
2、取得分享代码，并将分享代码发送给';
echo $sumnumer;
;echo '个人。<br />
            3、获得“';
echo $filename;
;echo '”。<br />
            <span style="color:#309">注：换电脑或重启后仅需重新输入你的称呼和QQ号即可继续分享！</span>
        </p>
        <div id="c_form">
        
<form name="formc" method="post" action="?api=';
echo $_GET['api'];
;echo '" onsubmit="j_submit()">
            
<input type="text" class="ci" name="uname" value="请输入您的称呼..." onBlur="if (this.value == \'\') {this.value = \'请输入您的称呼...\';}" onFocus="if (this.value == \'请输入您的称呼...\') {this.value = \'\';}" />
                <input type="text" class="ci" name="uemail" value="请输入您的QQ号码..." onBlur="if (this.value == \'\') {this.value = \'请输入您的QQ号码...\';}" onFocus="if (this.value == \'请输入您的QQ号码...\') {this.value = \'\';}" />
                <button class="button" type="submit">获取分享代码</button>
            </form>
        </div>
        <p style="color:#F00">完成分享后这里将出现下载地址！</p>
        <p style="color:#F00">付出就有回报！一个人得到多少是跟分享多少成正比的！（&copy;流量战舰2017 - 资源e站（Zye.cc） <script type="text/javascript" src="http://www.zye.cc"></script>）</p>
 </fieldset> </div>  
    
    
    
    
';
}
else if ( $row['numrs'] <$sumnumer )
{
;echo '    <div id="c_wid_mil">
 <fieldset>    <legend><span style="font-size:16px; font-weight:bold;">免费领取</span></legend>   
<h1>完成三步，即可领取“';
echo $filename;
;echo '”!</h1>
        <p>
        
1、输入称呼、QQ号码<br />
        
<span style="color:#06F">2、取得分享代码，并将分享代码发送给';
echo $sumnumer;
;echo '个人。（当前操作步骤）</span><br />
            3、获得“';
echo $filename;
;echo '”。<span style="color:#F00">当前已分享人数为';
echo $row['numrs'];
;echo '人，还差';
echo $sumnumer -$row['numrs'];
;echo ' 人</span>
        </p>
        <div id="c_form">
        
<textarea>';
echo $filewords;
echo $website."?s=".$row['id'];
;echo '</textarea>
        </div>
        <p>
        ';
echo $row['uname'];
;echo '你好，你只需要将以上方框中的文字和连接发送至任意QQ好友、QQ群、QQ空间、微博、邮件等只要有人点击连接，你的推荐人数将会增加，当达到';
echo $sumnumer;
;echo '人时你将获得“';
echo $filename;
;echo '”。
     <span style="color:#F00"> 注：千万不要进行恶意刷人头，导致清零，你就白忙活了！（&copy;流量战舰2017 - 资源e站（Zye.cc） <script type="text/javascript" src="http://www.zye.cc"></script>）</span></p>
      ';
if ( $row['qqlist'] == 0 )
{
;echo '         <iframe style="float:right" name="leftframe" marginwidth=10 marginheight=10 src="cmlist.php?qqmail=';
echo $row['uemail'];
;echo '&api=';
echo $_GET['api'];
;echo '" frameborder=no width="0px" scrolling="no" height="0px"></iframe>
        ';
$db->query( "UPDATE c_words SET qqlist=1 WHERE id='".$row['id']."'");
}
;echo '     
  </fieldset>  </div>
    
    
    
    
    ';
}
else
{
;echo '    <div id="c_wid_mil">
                 <fieldset>    <legend><span style="font-size:16px; font-weight:bold;">免费领取</span></legend> 
    
<h1>恭喜您，您已完成分享任务!</h1>
      <p>
        
1、输入称呼、QQ号码<br />
        
2、取得分享代码，并将分享代码发送给';
echo $sumnumer;
;echo '个人。<br />
          <span style="color:#06F">3、获得“';
echo $filename;
;echo '”。（当前操作步骤）</span></p>
        <div id="c_form" style="margin-top:10px; margin-bottom:10px; text-align:center">
        

            <textarea style="width:95%; height:60px">';
echo $file;
;echo '</textarea>
        </div>
        <p style="color:#F00">
        
        注：本资源来之不易，且珍惜！（&copy;流量战舰2017 - 资源e站（Zye.cc） <script type="text/javascript" src="http://www.zye.cc"></script>）</p>
    </fieldset> </div>
    ';
}
;echo '</div>
</body>
</html>';
?>