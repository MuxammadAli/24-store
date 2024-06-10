<?php

	if( ! defined( 'DATALIFEENGINE' ) ) {
		die( "Hacking attempt!" );
	}
	if( $is_logged ) {
		header( "Location: {$_SERVER['PHP_SELF']}" );
	} else {
		$tpl->load_template( 'login_page.tpl' );
		$tpl->set( '{registration-link}', $PHP_SELF . "?do=register" );
		$tpl->set( '{lostpassword-link}', $PHP_SELF . "?do=lostpassword" );
		$tpl->set( '{login-method}', $config['auth_metod'] ? "E-Mail:" : $lang['login_metod'] );
		$tpl->copy_template = "<form  method=\"post\" action=\"\">\n" . $tpl->copy_template . "
<input name=\"login\" type=\"hidden\" id=\"login\" value=\"submit\">
</form>";
		$tpl->compile( 'content' );
		$tpl->clear();
	};

?>