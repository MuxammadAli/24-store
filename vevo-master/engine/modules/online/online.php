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
require "init.php";

$live = $online_config['time_out']*60;
$whoonline->GetOnUser($live);

$tpl->load_template('online/online.tpl');

$all 				= $whoonline->online_list['all'];
$users_count 		= $whoonline->online_list['users_count'];
$users 				= $whoonline->online_list['users'];
$guests_count 		= $whoonline->online_list['guests_count'];
$guests 			= $whoonline->online_list['guests'];
$robots_count 		= $whoonline->online_list['robots_count'];
$robots 			= $whoonline->online_list['robots'];
$twenty_users_count = $whoonline->online_list['twenty_users_count'];
$twenty_users		= $whoonline->online_list['twenty_users'];

/*
====================================
 Убираем при необходимости последний сепаратор
====================================
*/
$len_sep = strlen($whoonline->online_config['separator'])+6;
$len_sep_col = strlen($whoonline->online_config['separator_col'])+6;

if ($whoonline->online_config['num_col_user'] > 1 ) { //Значит столбиками и сепаратор другой
	$users_t = substr($users, 0, -$len_sep_col)."</div>";
} else { 
	$users_t = substr($users, 0, -$len_sep)."</div>";
}
if ($whoonline->online_config['num_col_guest'] > 1 ) { //Значит столбиками и сепаратор другой
	$guests_t = substr($guests, 0, -$len_sep_col)."</div>";
} else { 
	$guests_t = substr($guests, 0, -$len_sep)."</div>";
}
if ($whoonline->online_config['num_col_robot'] > 1 ) { //Значит столбиками и сепаратор другой
	$robots_t = substr($robots, 0, -$len_sep_col)."</div>";
} else { 
	$robots_t = substr($robots, 0, -$len_sep)."</div>";
}
if ($whoonline->online_config['num_col_last'] > 1 ) { //Значит столбиками и сепаратор другой
	$twenty_users_t = substr($twenty_users, 0, -$len_sep_col)."</div>";
} else { 
	$twenty_users_t = substr($twenty_users, 0, -$len_sep)."</div>";
}


if($guests_count == 0) { $guests = "- отсутствуют"; } else { $guests = $guests_t; }
if($users_count == 0) { $users = "- отсутствуют"; } else { $users = $users_t; } 
if($robots_count == 0) { $robots = "- отсутствуют"; } else { $robots = $robots_t; }
if($twenty_users_count == 0) { $twenty_users = "- отсутствуют"; } else { $twenty_users = $twenty_users_t; }

$name = "twenty_users";
$name2 = "robots";

$text_y = "\\1";
$text_n = "";
if ( $online_config['show_twenty_users'] == "yes" ){
	$tpl->set_block( "'\\[".$name."\\](.*?)\\[/".$name."\\]'si", $text_y );
}else{
	$tpl->set_block( "'\\[".$name."\\](.*?)\\[/".$name."\\]'si", $text_n );
}
if ( $online_config['show_robots'] == "yes" ){
	$tpl->set_block( "'\\[".$name2."\\](.*?)\\[/".$name2."\\]'si", $text_y );
}else{
	$tpl->set_block( "'\\[".$name2."\\](.*?)\\[/".$name2."\\]'si", $text_n );
}


$tpl->set('{guests}', $guests);
$tpl->set('{guests_count}', $guests_count);
$tpl->set('{users}', $users);
$tpl->set('{robots}', $robots);
$tpl->set('{twenty_users}', $twenty_users);
$tpl->set('{users_count}', $users_count);
$tpl->set('{robots_count}', $robots_count);
$tpl->set('{twenty_users_count}', $twenty_users_count);
$tpl->set('{all}', $all);
$tpl->compile('online');
$tpl->clear();

echo $tpl->result['online'];

unset($live, $template, $whoonline);

?>