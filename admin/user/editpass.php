<?php
require( "../cmck.php");
if ( $_GET['type'] == "add"&&$_POST != "")
{
if ( md5( $_POST['mypass'] ) == md5( $_POST['mypasss'] ) )
{
$installs = $db->query( "UPDATE c_admin SET admin_pass='".md5( $_POST['mypass'] )."' WHERE admin_id='1'");
if ( $installs )
{
echo tiao( "修改密码成功","editpass.php");
exit( );
}
echo tiao( "修改密码失败","editpass.php");
exit( );
}
echo tiao( "两次密码不一至！","editpass.php");
exit( );
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台密码修改</title>
<link href="../public/css/base.css" rel="stylesheet" type="text/css" />
<link href="../public/css/style.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="../public/js/common.js"></script>
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>后台密码修改</h3>
  
  </div>
</div>
<div class="tab" id="tab"> <a class="selected" href="#">后台密码修改</a></div>
<div class="page_form">
<form name="form2" method="post" action="?type=add">
<div class="page_table form_table">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
     
      <tr>
        <td width="156" align="right">新密码</td>
        <td width="700">
          <input name="mypass" type="text" class="text_value" value="" />
          </td>
        <td>(必填)不能含有字符</td>
      </tr>
      <tr>
        <td width="156" align="right">重复新密码</td>
        <td width="700">
          <input name="mypasss" type="text" class="text_value" value="" />
          </td>
        <td>(必填)不能含有字符</td>
      </tr>
     
      
    </table>
</div>
<!--普通提交-->
<div class="form_submit">
<input type="hidden" name="id" value="" />
<button type="submit" class="button">修改管理员密码</button> 
</div>
</form>
</div>
</div>

<div class="fn_clear"></div>
</body>
</html>';
?>