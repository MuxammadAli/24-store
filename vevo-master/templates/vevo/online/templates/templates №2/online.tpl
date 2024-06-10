<div class="ionline">
<div id="ionline_vis"></div>
<div class="online_user">
Сейчас на сайте: <b>{all}</b>&nbsp;<a href="javascript://" onClick="$('#online_user').slideToggle('slow');"><b>(Смотреть)</b></a><br />
Юзеров: <b>{users_count}</b> Гостей: <b>{guests_count}</b> Роботов: <b>{robots_count}</b></div>
<div id="online_user" style="display: none;">
<br />
<div class="online_user">
<u>Юзеры:</u><br /><b>{users}</b></div>
<br />
<div class="online_user">
<u>Гости:</u><br /><b>{guests}</b></div>
<br />	
<div class="online_user">
<u>Роботы:</u><br /><b>{robots}</b></div>
<br />
<div class="online_user">
<a href="javascript://" onClick="$('#online_users').slideToggle('slow');"><b>Последние 20 посетителей...</b></a>
<div id="online_users" style="display:none;"><br /><b>{twenty_users}</b></div></div></div></div>