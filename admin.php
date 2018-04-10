<?php
require_once( "./config.php");
if ( $_GET['type'] == "loginout")
{
$_SESSION['adid'] = "";
$_SESSION['adname'] = "";
$_SESSION['adkey'] = "";
echo tiao( "您已成功退出","index.php");
exit( );
}
if ( $_SESSION['adkey'] == "cm2014")
{
echo tiaos( "admin/index.php");
exit( );
}
if ( $_GET['type'] == "login"&&$_POST['user_name'] != ""&&$_POST['user_pass'] != "")
{
$emails = "/^[a-zA-Z0-9_]{2,10}\$/";
$passwords = "/^[a-zA-Z0-9_]{3,16}\$/";
if ( preg_match( $emails,$_POST['user_name'] ) &&preg_match( $passwords,$_POST['user_pass'] ) )
{
$db->query( "SELECT * FROM c_admin where admin_name='".$_POST['user_name']." ' and admin_pass='".md5( $_POST['user_pass'] )."'");
if ( $db->db_num_rows( $rs ) == 1 )
{
$row = $db->fetch_array( $rs );
$_SESSION['adid'] = $row['admin_id'];
$_SESSION['adname'] = $row['admin_name'];
$_SESSION['adkey'] = $row['admin_key'];
echo tiaos( "admin/index.php");
}
else
{
echo tiao( "账号或密码错误","admin.php");
exit( );
}
}
else
{
echo tiao( "账号或密码错误","admin.php");
exit( );
}
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\'>
<title>流量战舰管理后台</title>
<link href=\'style/css/login.css\' rel=\'stylesheet\' type=\'text/css\'>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>

<div class="con">
        <div class="login">
          <div class="b_left" id="divLink1"></div>
          <div class="input">
<br>



<form name="form1" action="?type=login" method="post">



<table width="100%" border="0" cellspacing="0" cellpadding="0" class="logTb">
              <tr>
                <th>管理员帐号</th>
                <td>
                <input type="text" name="user_name" class="input-border" onFocus="this.style.borderColor=\'#F93\'" onBlur="this.style.borderColor=\'#226499\'"/>
                </td>
              </tr>
              <tr>
                <th>管理员密码</th>
                <td><input type="password" name="user_pass" class="input-border" onFocus="this.style.borderColor=\'#F93\'" onBlur="this.style.borderColor=\'#226499\'"></td>
              </tr>
                            <tr>
                <th>&nbsp;</th>
                <td  colspan="2" style="line-height:22px; padding-top:0px; padding-left:6px; padding-bottom:10px;"><button type="submit">&nbsp;&nbsp;进入管理中心&nbsp;&nbsp;</button>
                  </td>
              </tr>
            </table>



</form>
          </div>
        </div>
      </div>

</td>
  </tr>
</table>
</body>
</html>';
?>