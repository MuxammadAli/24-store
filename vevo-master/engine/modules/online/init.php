<?php
/*
=====================================================
�����: SX2
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

global $_IP;			#ip ����� ������������
global $_TIME;			#����� ����� (�������) � ������ �������� �����
global $cat_info;		#������ ���������� ���������� ������� ��������� ����������
global $config;			#������ � ����������������� �������
global $db;				#����� ����������� ������ � ��
global $dle_module;		#�������� ���������� � ������� �����, ������� ������������� ������������, ���� ���������� ���������� do �� URL ��������.
global $is_logged;		#= 1 ���� ������������ ������ ����������� ����� = 0
global $member_id;		#������ � ������ ����������� � ������������ ���� ����� �� ���������� ������ $member_id['user_group']=5
global $news_name;		#��������� �������� ������� ����� ajax ������ ������������
global $newsid;			#id �������� ������� ����� ajax ������ = 0
global $PHP_SELF;		#����� ����� �� ����� � index.php
global $prefix;			#������� ���� ������
global $static_result;	#������ � ������ ����������� �� �������� ����������� �������� ����� ajax ������ ������������
global $titl_e;		#???????????????????????????????????????????????????????????????????
global $tpl;			#����� ����������� ������ � ��������� DLE
global $user;			#???????????????????????????????????????????????????????????????????
global $user_group;		#������ ���������� ���������� ������� ������� �������������

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