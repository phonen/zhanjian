<?php
require( "../cmck.php");
if ( $_GET['mytype'] != "list")
{
include( "../../lib/pager.class.php");
$CurrentPage = isset( $_GET['page'] ) ?$_GET['page'] : 1;
if ( $_GET['type'] == ""&&$_GET['id'] != "")
{
$db->query( "SELECT * FROM c_words where fig_id='".$_GET['id']."' order by id desc");
}
else if ( $_GET['type'] == "s"&&$_GET['id'] == "")
{
$db->query( "SELECT * FROM c_words where uemail like '%".$_POST['key']."%' order by id desc");
}
else
{
$db->query( "SELECT * FROM c_words order by id desc");
}
$mypagesnum = $db->db_num_rows( );
$p_pageSize = 20;
$myPage = new pager( $mypagesnum,intval( $CurrentPage ),$p_pageSize );
$min_page = ( $CurrentPage -1 ) * $p_pageSize;
if ( $_GET['type'] == ""&&$_GET['id'] != "")
{
$db->query( "SELECT * FROM c_words where fig_id='".$_GET['id']."' order by id desc LIMIT ".$min_page.",".$p_pageSize );
}
else if ( $_GET['type'] == "s"&&$_GET['id'] == "")
{
$db->query( "SELECT * FROM c_words where uemail like '%".$_POST['key']."%' order by id desc LIMIT ".$min_page.",".$p_pageSize );
}
else
{
$db->query( "SELECT * FROM c_words order by id desc LIMIT ".$min_page.",".$p_pageSize );
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员列表</title>
<link href="../public/css/base.css" rel="stylesheet" type="text/css" />
<link href="../public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>会员列表</h3>
    <small>显示所有会员</small> 
  </div>
</div>
<div class="tab" id="tab"> <a class="selected" href="#">会员列表</a>&nbsp;&nbsp;<a href="?mytype=list">导出会员邮箱</a>

<form name="forms1" method="post" action="?type=s" style="float:right">

会员QQ：<input type="text" name="key" value="" class="text_value" style="height:20px; width:120px" />
    <button type="submit" class="button" style="height:20px; line-height:20px">搜索</button> 
</form>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="15%"><center>ID</center></th>
        <th width="17%">会员称呼</th>
        <th width="27%">会员email</th>
        <th width="22%"><center>
            注册时间
        </center></th>
        <th width="19%"><center>
            分享次数
        </center></th>

      </tr>
      ';
while ( $row = $db->fetch_array( $rs ) )
{
;echo '      <tr>
        <td><center>';
echo $row['id'];
;echo '</center></td>
        <td>';
echo $row['uname'];
;echo '</td>
        <td>';
echo $row['uemail'];
;echo '</td>
        <td>';
echo date( "Y-m-d H:i:s",$row['utime'] );
;echo '</td>
       <td><center>';
echo $row['numrs'];
;echo '</center></td>

      </tr>
     ';
}
;echo '    </table>
  </div>
</div>

<div class="page_tool">
  <div class="page">';
$pageStr = $myPage->getpagercontent( );
echo $pageStr;
;echo '</div>
</div>
<div class="fn_clear"></div>
</body>

</html>
';
}
else
{
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导出会员邮箱列表</title>
<link href="../public/css/base.css" rel="stylesheet" type="text/css" />
<link href="../public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page_function">
  <div class="info">
    <h3>会员列表</h3>
    <small>显示所有会员</small> 
  </div>
</div>
<div class="tab" id="tab"> <a class="selected" href="">导出会员邮箱</a>&nbsp;&nbsp;<a href="user_list.php">会员列表</a>
</div>
<div class="page_main">
  <div class="page_table table_list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
        <td>
        ==============报以下邮箱复制到你的记事本中=============== <br />
      ';
$db->query( "SELECT * FROM c_words order by id desc");
while ( $row = $db->fetch_array( $rs ) )
{
;echo '    ';
echo $row['uemail'];
;echo '<br />
     ';
}
;echo '</td>

      </tr>
    </table>
  </div>
</div>

<div class="page_tool">
  <div class="page">';
$pageStr = $myPage->getpagercontent( );
echo $pageStr;
;echo '</div>
</div>
<div class="fn_clear"></div>
</body>

</html>
';
}
?>