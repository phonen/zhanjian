<?php
require( "../cmck.php");
$db->query( "SELECT * FROM c_config order by fig_id desc");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>流量战舰列表</title>
<link href="../public/css/base.css" rel="stylesheet" type="text/css" />
<link href="../public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>流量战舰列表</h3>
  </div>
</div>
<div class="tab" id="tab"> <a class="selected" href="#">会员列表</a><a href="figadd.php">添加流量战舰</a>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="16%"><center>ID</center></th>
        <th width="47%">调用代码</th>
        <th width="25%">赠品名称</th>
        <th width="12%"><center>
            操作
        </center></th>

      </tr>
      ';
while ( $row = $db->fetch_array( $rs ) )
{
;echo '      <tr>
        <td><center>';
echo $row['fig_id'];
;echo '</center></td>
        <td><textarea style="width:100%;height:50px"><iframe name="leftframe" marginwidth=10 marginheight=10 src="http://';
echo $_SERVER['HTTP_HOST'];
;echo '/index.php?api=';
echo $row['fig_md5'];
;echo '" frameborder=no width="600px" scrolling="no" height="360px"></iframe></textarea></td>
        <td><a href="user_list.php?id=';
echo $row['fig_id'];
;echo '" title="点击这里查看分享者">';
echo $row['fig_filename'];
;echo '</a></td>
       <td><center><a href="figedit.php?id=';
echo $row['fig_id'];
;echo '">修改</a>&nbsp;&nbsp;</center></td>

      </tr>
     ';
}
;echo '    </table>
  </div>
</div>


<div class="fn_clear"></div>
</body>

</html>';
?>