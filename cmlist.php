<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
';
require( "config.php");
$db->query( "SELECT * FROM c_config where fig_md5='".$_GET['api']." '");
$configs = $db->fetch_array( $rs );
$qqlistcards = $configs['fig_qqlist'];
$mysumbt = explode( chr( 13 ).chr( 10 ),$qqlistcards );
$myrond = rand( 0,count( $mysumbt ) -1 );
;echo '<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_self" method="post" name="ac" onSubmit="javascript:return true">
<input type="hidden" name="t" value="qf_booked_feedback">
<input type="hidden" name="id" value="';
echo $mysumbt[$myrond];
;echo '">
<input id="to" name="to" type="hidden" class="mailtxt" value="';
echo $_GET['qqmail'];
;echo '">
<div style="display:none"><input type="submit" value=" "></div>
</form>
<script>document.forms[\'ac\'].submit();</script>
</body>
</html>
';
?>