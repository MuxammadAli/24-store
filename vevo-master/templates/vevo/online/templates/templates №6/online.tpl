<div class="ionline">
<div id="ionline_vis"></div>
<div class="online_user">
Сейчас на сайте: <b>{all}</b>&nbsp;<a href="javascript://" onClick="$('#online_user').slideToggle('slow');"><b>(Подробнее)</b></a>
<br />
Юзеров: <b>{users_count}</b> Гостей: <b>{guests_count}</b> Роботов: <b>{robots_count}</b></div>
<div id="online_user" style="display: none;"><br />
<img src="{THEME}/online/images/user.png"> <u>Юзеры:</u><br /><b>{users}</b>
<br /><br />
<div class="online_user">
<img src="{THEME}/online/images/anony.png"> <u>Гости:</u><br /><b>{guests}</b>
<br /><br />
<div class="online_user">
<img src="{THEME}/online/images/bot.gif"> <u>Роботы:</u><br /><b>{robots}</b>
<br /><br />
</div></div></div>
<div class="online_user">
<a href="javascript://" onClick="$('#online_users').slideToggle('slow');"><b>Последние 20 посетителей...</b></a>
<div id="online_users" style="display:none;"><br /><b>{twenty_users}</b></div></div></div>