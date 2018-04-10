<?php
require( "cmck.php" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>流量战舰管理后台</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

$("#firstpane p.menu_head").click(function()
    {


$(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(0).siblings("div.menu_body").hide();

});
});
</script>
</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="194"  height="100%" valign="top">
    <div class="left">
        <div class="tit"></div>
        <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->

        
<p class="menu_head">流量战舰</p>
          <div class="menu_body"  style="display:block">
          <a href="user/editpass.php" target="right">后台密码修改</a>
          <a href="user/figlist.php" target="right">流量战舰列表</a>
          <a href="user/user_list.php" target="right">会员管理</a>

          </div>
        </div>
        <!--Code for menu ends here--> 
      </div>
      </td>
    <td align="left" height="100%" valign="top">
    <iframe class="right" id="right" name="right" height="100%"  frameborder="0" scrolling="auto"  src="info.php" ></iframe>
    </td>
  </tr>
</table>
</body>
</html>