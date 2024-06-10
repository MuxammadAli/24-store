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
if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}
if($member_id['user_group']!= round(0+0.5+0.5)){
	msg(error,$lang['addnews_denied'],$lang['db_denied']);
}

require_once ( ROOT_DIR.'/engine/data/online_config.php' );

extract($_REQUEST,EXTR_SKIP);

/**
* Функции html #######################################################################################################################################################################################
*/

function opentable() {
echo <<<HTML
<table width="100%">
<tr>
<td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
<td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
<td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
</tr>
<tr>
<td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
<td style="padding:5px;" bgcolor="#FFFFFF">
HTML;
}
function closetable() {
echo <<<HTML
</td>
<td background="engine/skins/images/tl_rb.gif"><img src="engine/skins/images/tl_rb.gif" width="6" height="1" border="0"></td>
</tr>
<tr>
<td><img src="engine/skins/images/tl_lu.gif" width="4" height="6" border="0"></td>
<td background="engine/skins/images/tl_ub.gif"><img src="engine/skins/images/tl_ub.gif" width="1" height="6" border="0"></td>
<td><img src="engine/skins/images/tl_ru.gif" width="6" height="6" border="0"></td>
</tr>
</table>
HTML;
}
function unterline() {
	echo '<div class="unterline"></div>';
}
function l__3(){
echo <<<HTML
<table width="100%">
	<tr>
		<td bgcolor="#efefef" height="29" style="padding-left: 10px;"><div class="navigation">Модуль "Online"</div></td>
	</tr>
</table>
HTML;
unterline();
}
function l__4(){
	global $lang_p;
	opentable();
	l__3();
echo <<<HTML
<table width="99%">
<tr>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=options"><img src="engine/skins/online/settings.gif" border="0" align="left"><h3>Общие настройки</h3>Настройки модуля, управление функциями.</a></div></td>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=hint"><img src="engine/skins/online/hint.gif" border="0" align="left"><h3>Настройки хинта</h3>Настройки всплывающего окна.</a></div></td>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=about"><img src="engine/skins/online/info.png" border="0" align="left"><h3>Информация</h3>Версия, авторы, помощь, техническая поддержка.</a></div></td>
</tr>
</table>
HTML;
	closetable();
	opentable();

echo <<<HTML
<div style="padding: 5px;">
<b>Информация:</b><br />
- Данный модуль предназначен для вывода информации о посетителях сайта.<br />
- Количество запросов к MySQL: от 1 и более.
</div>
HTML;
	closetable();
	echofooter();
}
function panel(){
	global $lang_p;
	opentable();
	l__3();
echo <<<HTML
<table width="99%">
<tr>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=options"><img src="engine/skins/online/settings.gif" border="0" align="left"><h3>Общие настройки</h3>Настройки модуля, управление функциями.</a></div></td>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=hint"><img src="engine/skins/online/hint.gif" border="0" align="left"><h3>Настройки хинта</h3>Настройки всплывающего окна.</a></div></td>
<td width="33%"><div class="quick"><a href="$PHP_SELF?mod=online&amp;action=about"><img src="engine/skins/online/info.png" border="0" align="left"><h3>Информация</h3>Версия, авторы, помощь, техническая поддержка.</a></div></td>
</tr>
</table>
HTML;
	closetable();
}
if($_REQUEST['action']== 'dle'|| $_REQUEST['action']== ''){
	echoheader('','');
	l__4();
}

if($_REQUEST['action']== 'options'){
	echoheader('','');
	panel();
	if($member_id['user_group']!= round(0+0.2+0.2+0.2+0.2+0.2)){
		msg('error',$lang['addnews_denied'],$lang['db_denied']);
	}
function l__5($title="",$description="",$field=""){
echo"<tr>
		<td style=\"padding: 4px;\" class=\"option\">
		<b>$title</b><br /><span class=\"small\">$description</span>
		<td style=\"width: 344px;\">
		$field
		</tr><tr><td style=\"height: 1px;\" class=\"mline\" colspan=\"2\"></td></tr>";
		$bg= '';
		$i ++;
	}
	function l__6($options,$name,$selected){
		$output="<select style=\"width: 344px;\" name=\"$name\">\r\n";
		foreach($options as $value => $description){
			$output .="<option value=\"$value\"";
			if($selected == $value){
				$output .= 'selected';}
				$output .=">$description</option>\n";
			}
			$output .= '</select>';
			return $output;
		}
		foreach($user_group as $group)$sys_group_arr[$group['id']]=$group['group_name'];
		opentable();
		echo <<<HTML
<form action="" method="post">
<table width="100%">
<tr style='' id="global"><td>
<table width="100%">
	<tr>
		<td bgcolor="#efefef" height="29" style="padding-left: 10px;"><div class="navigation">Модуль "Online" - Общие Настройки:</div></td>
	</tr>
</table>
<div class="unterline"></div>
<table width="100%">
HTML;
l__5('Сколько времени в минутах считать пользователя Онлайн.','Время сесии пользователя на сайте (в минутах).',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[time_out]\" value=\"{$online_config['time_out']}\" size=55 />");
l__5('Во сколько столбцов выводить текущих активных пользователей.','Если 1 - то в список с разделителем',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[num_col_user]\" value=\"{$online_config['num_col_user']}\" size=55 />");
l__5('Во сколько столбцов выводить текущих активных гостей.','Если 1 - то в список с разделителем',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[num_col_guest]\" value=\"{$online_config['num_col_guest']}\" size=55 />");
l__5('Во сколько столбцов выводить текущих активных роботов.','Если 1 - то в список с разделителем',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[num_col_robot]\" value=\"{$online_config['num_col_robot']}\" size=55 />");
l__5('Во сколько столбцов выводить последних посетителей.','Если 1 - то в список с разделителем',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[num_col_last]\" value=\"{$online_config['num_col_last']}\" size=55 />");
l__5('Разделитель в списке пользователей.','По умолчанию запятую, или что то на свой вкус.',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[separator]\" value=\"{$online_config['separator']}\" size=55 />");
l__5('Разделитель в столбце пользователей.','По умолчанию НЕТ.',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[separator_col]\" value=\"{$online_config['separator_col']}\" size=55 />");
l__5('Сколько гостей отображать в последних.','Сюда вводим количество гостей в списке последних.',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[limit_guests]\" value=\"{$online_config['limit_guests']}\" size=55 />");
l__5('Сколько пользователей отображать в последних.','Сюда вводим количество последних посетителей, редактируем <b>online.tpl</b> под нужное нам количество.',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[limit_users]\" value=\"{$online_config['limit_users']}\" size=55 />");
l__5('Сколько роботов отображать в последних.','Сюда вводим количество роботов в списке последних.',"<input class=edit type=text style=\"text-align: center;\" name=\"save_con[limit_robots]\" value=\"{$online_config['limit_robots']}\" size=55 />");
l__5('Показывать блок последних посетителей?','Отключение данной опции позволяет сэкономить 1 запрос к базе данных, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_twenty_users]',"{$online_config['show_twenty_users']}"));
l__5('Показывать роботов?','Отключение данной опции позволяет сэкономить 1 запрос к базе данных, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_user_agent]',"{$online_config['show_user_agent']}"));
l__5('Показывать цвета групп?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_user_group_color]',"{$online_config['show_user_group_color']}"));
echo <<<HTML
</table></td></tr>
	<tr>
		<td align="center" style="padding-top: 20px; padding-bottom: 15px;">
		<input type="hidden" name="action" value="save" /><input type="submit" class="btn btn-success" value=" Сохранить настройки модуля " /></td>
	</tr>
</table>
</form>
HTML;
closetable();
echofooter();
}

/**
* Сохраненние настроек в конфиг #######################################################################################################################################################################################
*/
if($_REQUEST['action']== 'save'){
	if($member_id['user_group']!= round(0+1)){
		msg('error',$lang['addnews_denied'],$lang['db_denied']);
	}
	$find[]     = "'\r'";
    $replace[]  = "";
    $find[]     = "'\n'";
    $replace[]  = "<br/>";
	$save_con['version']='2.5';
	$save_con=$save_con+$online_config;
	$handler=fopen(ENGINE_DIR .'/data/online_config.php',"wb");
	fwrite($handler,'<?php

$online_config = array (

');
	foreach($save_con as $name => $value){
		trim(stripslashes($value));
		htmlspecialchars($value,ENT_QUOTES);
		preg_replace($find,$replace,$value);
		fwrite($handler,"'{$name}' => \"{$value}\",\n\n");
	}
	fwrite($handler,');

?>');
	fclose($handler);
	clear_cache();
	msg('Info!','Модуль "Online"',"Настройки успешно сохранены!<br /><br /><a href=\"$PHP_SELF?mod=online\">Вернуться на главную страницу модуля</a> или <a href=\"$PHP_SELF?mod=online&action=options\">Вернутся назад</a>");
};
if($_REQUEST['action']== 'about'){
	echoheader('','');
	panel();
	if($member_id['user_group']!= round(0+0.333333333333+0.333333333333+0.333333333333)){
		msg('error',$lang['addnews_denied'],$lang['db_denied']);
	}
	opentable();
	echo <<<HTML
<table width="100%">
	<tr>
	 <td bgcolor="#efefef" height="29" style="padding-left: 10px;"><div class="navigation">Модуль "Online" - Общая информация:</div></td>
	</tr>
</table>
<div class="unterline"></div>
<div style="padding: 5px;">
<b>Информация:</b><br />
- Название модуля: Online<br />
- Версия модуля: v.2.5<br />
- Автор адаптации: Qnut<br />
- Web: <a href="http://coderlaba.com/">CoderLaba.com</a> <br />
- Версия движка DLE: 9.5 - 10.x<br />
- Автор предыдущих версий: SX2<br />
<br />
<b>Возможности:</b><br />
- Подсчет количества посетителей, гостей, роботов и суммарное количество посетителей.<br />
- Отображение местоположения посетителя на сайте.<br />
- Определение его страны и города, если у него реальный IP.<br />
- Определение его операционной системы.<br />
- Определение браузера (отображает версию Оперы нормально)<br />
- Составление списка пользователей, вошедших на сайт, в онлайн.<br />
- Составление списка роботов в онлайн.<br />
- Позволяет выводить аватар пользователя.<br />
- Используется стандартный шаблонизатор DataLife Engine.<br />
- Составление списка пользователей, вошедших на сайт, в оффлайн.<br />
- Возможность вывода списка пользователей как в строку с разделителем, так и в виде таблицы с 2, 3, 4 или 5 столбцами.<br />
- Установка без редактирования файлов движка (интегрируется через Include)<br /><br />
<b>Для использования GeoIP базы:</b><br />
- <noindex><a href="http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz">Cкачать</a></noindex> последнюю бесплатную версию базы. <br />
- Распаковать содержимое архива в папку <b>\engine\data\GeoLiteCity.dat</b><br />
- Включить функции определения местонахождения.<br /><br />
<b>Изменения:</b><br />
- Обновлен до версии DLE 9.5 - 10.x<br />
- Почищен от "мусора"<br />
- Декодирована и исправлена Админпанель<br />
- Определение ОС Windows 8 и Windows 8.1 Blue<br />
- Вывод тегов [online] и [offline]<br />
- Добавлены теги [group_color][/group_color] для подсветки ника и группы.<br />
- Добавлен вывод флага возле имени<br />
- Добавлено более 10 <a href="?mod=templates" target="_blank">шаблонов</a> (в папке <b>online</b>)<br />
- Новый установщик<br /><br />
</div>
HTML;
	closetable();
	echofooter();
}
if($_REQUEST['action']== 'hint'){
	echoheader("", "");
	panel();
	if($member_id['user_group']!= round(0+1)){
		msg('error',$lang['addnews_denied'],$lang['db_denied']);
	}
	opentable();
	function l__5($title="",$description="",$field=""){
		echo"<tr>
			<td style=\"padding: 4px;\" class=\"option\">
			<b>$title</b><br /><span class=\"small\">$description</span>
			<td style=\"width: 344px;\">
			$field
		</tr><tr><td style=\"height: 1px;\" class=\"mline\" colspan=\"2\"></td></tr>";
		$bg='';
		$i ++;
	}
	function l__6($options,$name,$selected){
		$output="<select style=\"width: 344px;\" name=\"$name\">\r\n";
		foreach($options as $value => $description){
			$output .="<option value=\"$value\"";
			if($selected == $value){
				$output .= 'selected';
			}
			$output .=">$description</option>\n";
		}
		$output .= '</select>';
		return $output;
	}
	foreach($user_group as $group)$sys_group_arr[$group['id']]=$group['group_name'];
	echo <<<HTML
<form action="" method="post">
<table width="100%">
<tr style='' id="global"><td>
<table width="100%">
	<tr>
		<td bgcolor="#efefef" height="29" style="padding-left: 10px;"><div class="navigation">Модуль "Online" - Настройки Хинта:</div></td>
	</tr>
</table>
<div class="unterline"></div><table width="100%">
HTML;
l__5('Показывать местонахождение?','Добавляет 1 запрос к базе если отключён вывод последнего визита пользователя, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_location]',"{$online_config['show_location']}"));
l__5('Показывать флаг страны?','Требует наличие GeoIP базы, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'), 'save_con[show_country_flag]',"{$online_config['show_country_flag']}"));
l__5('Показывать Страну пользователя?','Требует наличие GeoIP базы, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_country]',"{$online_config['show_country']}"));
l__5('Показывать Город пользователя?','Требует наличие GeoIP базы, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_city]',"{$online_config['show_city']}"));
l__5('Показывать дату последнего визита?','Добавляет 1 запрос к базе если отключён вывод местонахождения пользователя, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_last_visit]',"{$online_config['show_last_visit']}"));
l__5('Показывать название группы пользователя?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_user_group]',"{$online_config['show_user_group']}"));
l__5('Показывать IP  адрес?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_ip]',"{$online_config['show_ip']}"));
l__5('Показывать прокси?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_proxy]',"{$online_config['show_proxy']}"));
l__5('Показывать пользователям ОС?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_user_OS]',"{$online_config['show_user_OS']}"));
l__5('Показывать пользователям браузер?','По умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_browser_icon]',"{$online_config['show_browser_icon']}"));
l__5('Показывать дефолтную аватару пользователя?','Добавляет 1 запрос к базе, по умолчанию включено.',l__6(array('yes'=> 'Показывать','no'=> 'Не показывать'),'save_con[show_avatar_def]',"{$online_config['show_avatar_def']}"));
echo <<<HTML
</table></td></tr>
	<tr>
		<td align="center" style="padding-top: 20px; padding-bottom: 15px;"><input type="hidden" name="mod" value="online" />
		<input type="hidden" name="action" value="save" /><input type="submit" class="btn btn-success" value=" Сохранить настройки модуля " /></td>
	</tr>
</table>
</form>
HTML;
closetable();
echofooter();
}
?>