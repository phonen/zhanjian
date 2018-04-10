<?php
class ct
{
private $db_host = NULL;
private $db_user = NULL;
private $db_pwd = NULL;
private $db_database = NULL;
private $conn = NULL;
private $result = NULL;
private $sql = NULL;
private $row = NULL;
private $coding = NULL;
private $bulletin = FALSE;
private $show_error = TRUE;
private $is_error = FALSE;
public function __construct( $db_host,$db_user,$db_pwd,$db_database,$conn,$coding )
{
$this->db_host = $db_host;
$this->db_user = $db_user;
$this->db_pwd = $db_pwd;
$this->db_database = $db_database;
$this->conn = $conn;
$this->coding = $coding;
$this->connect( );
}
public function connect( )
{
if ( $this->conn == "pconn")
{
$this->conn = mysql_pconnect( $this->db_host,$this->db_user,$this->db_pwd );
}
else
{
$this->conn = mysql_connect( $this->db_host,$this->db_user,$this->db_pwd );
}
if ( !mysql_select_db( $this->db_database,$this->conn ) ||$this->show_error )
{
$this->conn = mysql_connect( $this->db_host,$this->db_user,$this->db_pwd );
}
mysql_query( "SET NAMES ".$this->coding );
}
public function query( $rts )
{
if ( $rts == "")
{
$this->show_error( "sql语句错误：","sql查询语句为空");
}
$this->sql = $rts;
$quer = mysql_query( $this->sql,$this->conn );
if ( !$quer )
{
if ( $this->show_error )
{
$this->show_error( "错误sql语句：",$this->sql );
}
}
else
{
$this->result = $quer;
}
return $this->result;
}
public function create_database( $database )
{
$db = $database;
$rtdb = "create database ".$db;
$this->query( $rtdb );
}
public function show_databases( )
{
$this->query( "show databases");
echo "现有数据库：".( $dbrow = $this->db_num_rows( $rows ) );
echo "<br />";
$i = 1;
while ( $value = $this->fetch_array( $rows ) )
{
echo $i;
echo " ";
echo $value['Database'];
echo "<br />";
++$i;
}
}
public function databases( )
{
$rs = mysql_list_dbs( $this->conn );
$i = 0;
$dbrst = mysql_num_rows( $rs );
while ( $i <$dbrst )
{
$rows[] = mysql_db_name( $rs,$i );
++$i;
}
return $rows;
}
public function show_tables( $database )
{
$this->query( "show tables");
echo "现有数据库：".( $dbrow = $this->db_num_rows( $rows ) );
echo "<br />";
$i = 1;
while ( $value = $this->fetch_array( $rows ) )
{
$dbtb = "Tables_in_".$database;
echo $i;
echo " ";
echo $value[$dbtb];
echo "<br />";
++$i;
}
}
public function mysql_result_li( )
{
return mysql_result( $mysqlresult );
}
public function fetch_array( $rows )
{
if ( $rows == "")
{
$rows = $this->result;
}
return mysql_fetch_array( $rows );
}
public function fetch_assoc( )
{
return mysql_fetch_assoc( $this->result );
}
public function fetch_row( )
{
return mysql_fetch_row( $this->result );
}
public function fetch_Object( )
{
return mysql_fetch_object( $this->result );
}
public function findall( $table )
{
$this->query( "SELECT * FROM ".$table );
}
public function select( $table,$dbtb,$where )
{
if ( $dbtb == "")
{
$dbtb = "*";
}
$this->query( "SELECT ".$dbtb." FROM {$table} {$where}");
}
public function delete( $table,$where )
{
$this->query( "DELETE FROM ".$table." WHERE {$where}");
}
public function insert( $table,$dbtb,$myt )
{
$this->query( "INSERT INTO ".$table." ({$dbtb}) VALUES ({$myt})");
}
public function update( $table,$change,$where )
{
$this->query( "UPDATE ".$table." SET {$change} WHERE {$where}");
}
public function insert_id( )
{
return mysql_insert_id( );
}
public function db_data_seek( $sk )
{
if ( 0 <$sk )
{
$sk -= 1;
}
if ( !@mysql_data_seek( $this->result,$sk ) )
{
$this->show_error( "sql语句有误：","指定的数据为空");
}
return $this->result;
}
public function db_num_rows( )
{
if ( $this->result == NULL )
{
if ( $this->show_error )
{
$this->show_error( "sql语句错误","暂时为空，没有任何内容！");
}
}
else
{
return mysql_num_rows( $this->result );
}
}
public function db_affected_rows( )
{
return mysql_affected_rows( );
}
public function show_error( $error = "",$rts = "")
{
if ( !$rts )
{
echo "<font color='red'>".$error."</font>";
echo "<br />";
}
else
{
echo "<fieldset><legend>错误信息提示:</legend><br /><div style='font-size:14px; clear:both; font-family:Verdana, Arial, Helvetica, sans-serif;'><div style='height:20px; background:#000000; border:1px #000000 solid'><font color='white'>错误号：12142</font></div><br />";
echo "错误原因：".mysql_error( )."<br /><br />";
echo "<div style='height:20px; background:#FF0000; border:1px #FF0000 solid'>";
echo "<font color='white'>".$error."</font>";
echo "</div>";
echo "<font color='red'><pre>".$rts."</pre></font>";
$ipaddr = $this->getip( );
if ( $this->bulletin )
{
$ntime = date( "Y-m-d H:i:s");
$error = $error.( "\r\n".$this->sql ).( "\r\n客户IP:".$ipaddr ).( "\r\n时间 :".$ntime )."\r\n\r\n";
$endtime = date( "Y-m-d");
$text = $endtime.".txt";
$logs = "error/".$text;
$erlo = $error;
$ermsg = "error";
if ( !file_exists( $ermsg ) ||!mkdir( $ermsg,511 ) )
{
exit( "upload files directory does not exist and creation failed");
}
if ( !file_exists( $logs ) )
{
fopen( $logs,"w+");
if ( is_writable( $logs ) )
{
if ( !( $memo = fopen( $logs,"a") ) )
{
echo "不能打开文件 ";
echo $text;
exit( );
}
if ( !fwrite( $memo,$erlo ) )
{
echo "不能写入到文件 ";
echo $text;
exit( );
}
echo "——错误记录被保存!";
fclose( $memo );
}
else
{
echo "文件 ";
echo $text;
echo " 不可写";
}
}
else if ( is_writable( $logs ) )
{
if ( !( $memo = fopen( $logs,"a") ) )
{
echo "不能打开文件 ";
echo $text;
exit( );
}
if ( !fwrite( $memo,$erlo ) )
{
echo "不能写入到文件 ";
echo $text;
exit( );
}
echo "——错误记录被保存!";
fclose( $memo );
}
else
{
echo "文件 ";
echo $text;
echo " 不可写";
}
}
echo "<br />";
if ( $this->is_error )
{
exit( );
}
}
echo "</div></fieldset><br />";
}
public function free( )
{
@mysql_free_result( $this->result );
}
public function select_db( $db_database )
{
return mysql_select_db( $db_database );
}
public function num_fields( $field )
{
$this->query( "select * from ".$field );
echo "<br />";
echo "字段数：".( $numfields = mysql_num_fields( $this->result ) );
echo "<pre>";
$i = 0;
for ( ;$i <$numfields;++$i	)
{
print_r( mysql_fetch_field( $this->result,$i ) );
}
echo "</pre><br />";
}
public function mysql_server( $myserver = "")
{
switch ( $myserver )
{
case 1 :
return mysql_get_server_info( );
case 2 :
return mysql_get_host_info( );
case 3 :
return mysql_get_client_info( );
case 4 :
return mysql_get_proto_info( );
}
return mysql_get_client_info( );
}
public function __destruct( )
{
if ( !empty( $this->result ) )
{
$this->free( );
}
mysql_close( $this->conn );
}
public function getip( )
{
if ( getenv( "HTTP_CLIENT_IP") &&strcasecmp( getenv( "HTTP_CLIENT_IP"),"unknown") )
{
$ipaddr = getenv( "HTTP_CLIENT_IP");
return $ipaddr;
}
if ( getenv( "HTTP_X_FORWARDED_FOR") &&strcasecmp( getenv( "HTTP_X_FORWARDED_FOR"),"unknown") )
{
$ipaddr = getenv( "HTTP_X_FORWARDED_FOR");
return $ipaddr;
}
if ( getenv( "REMOTE_ADDR") &&strcasecmp( getenv( "REMOTE_ADDR"),"unknown") )
{
$ipaddr = getenv( "REMOTE_ADDR");
return $ipaddr;
}
if ( isset( $_SERVER['REMOTE_ADDR'] ) &&$_SERVER['REMOTE_ADDR'] &&strcasecmp( $_SERVER['REMOTE_ADDR'],"unknown") )
{
$ipaddr = $_SERVER['REMOTE_ADDR'];
return $ipaddr;
}
$ipaddr = "unknown";
return $ipaddr;
}
}
function tiao( $tiaoa,$tiaob )
{
$tiaojs = "<script type='text/javascript'>alert('".$tiaoa."');location.replace('".$tiaob."');</script>";
return $tiaojs;
}
function tiaos( $tiaob )
{
$tiaojs = "<script type='text/javascript'>location.replace('".$tiaob."');</script>";
return $tiaojs;
}
function egetip_joy( )
{
if ( getenv( "HTTP_CLIENT_IP") &&strcasecmp( getenv( "HTTP_CLIENT_IP"),"unknown") )
{
$ipaddr = getenv( "HTTP_CLIENT_IP");
}
else if ( getenv( "HTTP_X_FORWARDED_FOR") &&strcasecmp( getenv( "HTTP_X_FORWARDED_FOR"),"unknown") )
{
$ipaddr = getenv( "HTTP_X_FORWARDED_FOR");
}
else if ( getenv( "REMOTE_ADDR") &&strcasecmp( getenv( "REMOTE_ADDR"),"unknown") )
{
$ipaddr = getenv( "REMOTE_ADDR");
}
else if ( isset( $_SERVER['REMOTE_ADDR'] ) &&$_SERVER['REMOTE_ADDR'] &&strcasecmp( $_SERVER['REMOTE_ADDR'],"unknown") )
{
$ipaddr = $_SERVER['REMOTE_ADDR'];
}
$ipaddr = preg_replace( "/^([d.]+).*/","1",$ipaddr );
return $ipaddr;
}
error_reporting( 0 );
session_start( );
$db = new ct( $db_host,$db_user,$db_pass,$db_name,"conn","utf8");
$myserver = $_SERVER['SERVER_NAME'];
$mydms=md5( $myserver."32kkslonsda+012bg");
?>