<?php
require( "../cmck.php");
if ( $_GET['type'] == "add"&&$_POST != "")
{
$installs = $db->query( "UPDATE c_config SET fig_website='".$_POST['fig_website']."',fig_qqlist ='".$_POST['fig_qqlist']."', fig_filename='".$_POST['fig_filename']."', fig_filewords='".$_POST['fig_filewords']."', fig_file='".$_POST['fig_file']."', fig_sumnumer='".$_POST['fig_sumnumer']."' WHERE fig_id='".$_POST['id']."'");
if ( $installs )
{
echo tiao( "修改流量战舰成功","figedit.php?id=".$_POST['id'] );
exit( );
}
echo tiao( "添加流量战舰失败","figedit.php?id=".$_POST['id'] );
exit( );
}
$db->query( "SELECT * FROM c_config where fig_id='".$_GET['id']."' order by fig_id desc");
$row = $db->fetch_array( $rs );
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加流量战舰</title>
<link href="../public/css/base.css" rel="stylesheet" type="text/css" />
<link href="../public/css/style.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="../public/js/common.js"></script>
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>修改流量战舰</h3>
   
  </div>
</div>
<div class="tab" id="tab"> <a class="selected" href="#">修改流量战舰</a> <a  href="figlist.php">流量战舰列表</a></div>
<div class="page_form">
<form name="form2" method="post" action="?type=add">
<div class="page_table form_table">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     
      <tr>
        <td width="156" align="right">网址</td>
        <td width="700">
          <input name="fig_website" type="text" class="text_value" value="';
echo $row['fig_website'];
;echo '" />
          </td>
        <td>(必填)</td>
      </tr>
      <tr>
        <td width="156" align="right">QQ邮件列表</td>
        <td width="700">
          <textarea name="fig_qqlist" style="width:700px; height:100px">';
echo $row['fig_qqlist'];
;echo '</textarea>
          </td>
        <td>(必填)一行一个</td>
      </tr>
      <tr>
        <td width="156" align="right">赠品名称</td>
        <td width="700">
          <input name="fig_filename" type="text" class="text_value" value="';
echo $row['fig_filename'];
;echo '" />
          </td>
        <td>(必填)</td>
      </tr>

     <tr>
        <td width="156" align="right">推广词</td>
        <td width="700">
          <textarea name="fig_filewords" style="width:700px; height:100px">';
echo $row['fig_filewords'];
;echo '</textarea>
          </td>
        <td>(必填)</td>
      </tr>
      <tr>
        <td width="156" align="right">下载地址</td>
        <td width="700">
          <textarea name="fig_file" style="width:700px; height:100px">';
echo $row['fig_file'];
;echo '</textarea>
          </td>
        <td>（必填）方式很多 ， 你想怎样就怎么样</td>
      </tr>
      <tr>
        <td width="156" align="right">完成多少次分享</td>
       <td width="700">
          <input name="fig_sumnumer" type="text" class="text_value" value="';
echo $row['fig_sumnumer'];
;echo '" style="width:100px" />
          </td>
        <td>（必填）</td>
      </tr>
      
    </table>
</div>
<!--普通提交-->
<div class="form_submit">
<input type="hidden" name="id" value="';
echo $row['fig_id'];
;echo '" />
<button type="submit" class="button">修改流量战舰</button> 
</div>
</form>
</div>
</div>

<div class="fn_clear"></div>
</body>
</html>';
?>