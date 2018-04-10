<?php
require( dirname( dirname( __FILE__ ) )."/config.php" );
if ( empty( $_SESSION['adid'] ) || empty( $_SESSION['adname'] ) || empty( $_SESSION['adkey'] ) )
{
				echo tiao( "已超时，请重新登陆。", "/index.php" );
				exit( );
}
?>
