<?php
require( "cmck.php" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="public/css/base.css" rel="stylesheet" type="text/css" />
<link href="public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>管理首页</h3>
    <small><font color="#333">欢迎使用 “流量战舰“ </small></div>
  <div class="tip"><?php
echo $_SESSION['adname'];
?>&nbsp;&nbsp;您等当前系统时间为：<?php
echo date( "Y-m-d H:i:s", time( ) );
?></div>
</div>
<div class="page_main">
  <h3>环境信息</h3>
  <div class="page_table">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="120">操作系统: </td>
        <td width="250">LINUX</td>
        <td width="120">服务器地址: </td>
        <td>HK</td>
      </tr>
      <tr>
        <td>服务器时间: </td>
        <td><?php
echo date( "Y-m-d H:i:s", time( ) );
?> CST</td>
        <td>WEB服务器: </td>
        <td>Apache/2.2.15 (Win32) PHP/5.2.13</td>
      </tr>
      <tr>
        <td>服务器语言: </td>
        <td>zh-CN,zh;q=0.8</td>
        <td>PHP版本: </td>
        <td>5.4.0</td>
      </tr>
      <tr>
        <td>图像处理支持: </td>
        <td><font color=green><b>√</b></font></td>
        <td>Session支持: </td>
        <td><font color=green><b>√</b></font></td>
      </tr>
      <tr>
        <td>脚本运行内存: </td>
        <td>128M</td>
        <td>上传大小限制: </td>
        <td>2M</td>
      </tr>
      <tr>
        <td>POST提交限制: </td>
        <td>8M</td>
        <td>脚本超时时间: </td>
        <td>30 s</td>
      </tr>
      <tr>
        <td>被屏蔽的函数: </td>
        <td colspan="3">无</td>
      </tr>
    </table>
  </div>
  <h3>程序信息</h3>
  <div class="page_table">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="120">程序版本: </td>
        <td width="250">流量战舰2017 - 资源e站（Zye.cc）</td>
        <td width="120">官方主页: </td>
        <td><a href="http://www.zye.cc" target="_blank">www.zye.cc</a></td>
      </tr>
      <tr>
        <td width="120">源码分享: </td>
        <td width="250">资源e站</td>
        <td width="120">QQ: </td>
        <td>10000</td>
      </tr>
      <tr>
        <td width="120"> </td>
        <td width="250" colspan="3"></td>
        
      </tr>
      
     
    </table>
  </div>
</div>
<div class="fn_clear"></div>
</html>