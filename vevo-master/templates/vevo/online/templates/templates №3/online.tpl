<div class="ionline">
<div id="ionline_vis"></div>
<div class="online_user">
<b>(<img src="{THEME}/online/images/group.png" title="������ �� �����"> {all})</b>
<b>(<img src="{THEME}/online/images/user.png" title="������"> {users_count})</b> 
<b>(<img src="{THEME}/online/images/anony.png" title="������"> {guests_count})</b> 
<b>(<img src="{THEME}/online/images/bot.gif" title="�������"> {robots_count})</b> 
<a href="javascript://" onClick="$('#online_user').slideToggle('slow');"><b>(���������)</b></a>
<br />
<div id="online_user" style="display: none;"><br />
<img src="{THEME}/online/images/user.png"> <u>�����:</u><br /><b>{users}</b>
<br /><br />
<div class="online_user">
<img src="{THEME}/online/images/anony.png"> <u>�����:</u><br /><b>{guests}</b>
<br /><br />
<div class="online_user">
<img src="{THEME}/online/images/bot.gif"> <u>������:</u><br /><b>{robots}</b>
<br /><br />
<div class="online_user">
<img src="{THEME}/online/images/group.png">&nbsp;<a href="javascript://" onClick="$('#online_users').slideToggle('slow');"><b>��������� 20 �����������...</b></a>
<div id="online_users" style="display:none;"><br /><b>{twenty_users}</b></div></div></div></div></div></div></div>