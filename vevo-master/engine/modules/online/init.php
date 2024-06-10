<?php
/*
=====================================================
Автор: SX2
-----------------------------------------------------
Decoded & Modifed: Qnut 
-----------------------------------------------------
Web: http://coderlaba.com/
-----------------------------------------------------
Version: 2.5
=====================================================
*/
if(!defined('DATALIFEENGINE'))  die("Hacking attempt!");
if(!defined('SNIPPETS_DIR')) define(SNIPPETS_DIR, preg_replace("/(.+)\/core(.*)/i", "\$1", dirname(__FILE__)));

global $_IP;			#ip адрес пользователя
global $_TIME;			#время сайта (сервера) с учетом часового пояса
global $cat_info;		#массив содержащий информацию обовсех новостных категориях
global $config;			#массив с конфигурационными данными
global $db;				#класс реализующий работу с БД
global $dle_module;		#содержит информацию о разделе сайта, который просматривает пользователь, либо информацию переменной do из URL браузера.
global $is_logged;		#= 1 если пользователь прошел авторизацию иначе = 0
global $member_id;		#массив с полной информацией о пользователе если гость то определено только $member_id['user_group']=5
global $news_name;		#псевдоним активной новости через ajax всегда неопределена
global $newsid;			#id активной новости через ajax всегда = 0
global $PHP_SELF;		#домен сайта на конце с index.php
global $prefix;			#префикс базы данных
global $static_result;	#массив с полной информацией об активной статической странице через ajax всегда неопределена
global $titl_e;		#???????????????????????????????????????????????????????????????????
global $tpl;			#класс реализующий работу с шаблонами DLE
global $user;			#???????????????????????????????????????????????????????????????????
global $user_group;		#массив содержащий информацию обовсех группах пользователей

$prefix = PREFIX;

require_once "online.class.php";

if ( $online_config['show_country_flag'] == "yes" || $online_config['show_country'] == "yes" || $online_config['show_city'] == "yes" )
{
    include( ROOT_DIR."/engine/classes/geoip/geoipcity.inc" );
}

echo <<<HTML
	<link rel="stylesheet" type="text/css" href="{THEME}/online/online.css" media="screen" />
	<script language="javascript" type="text/javascript" src="{$config['http_home_url']}engine/modules/online/hint.js"></script>
HTML;

?>