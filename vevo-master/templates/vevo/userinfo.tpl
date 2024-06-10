<div class="box-out margin">
		<div class="block-head">Пользователь: {usertitle}</div>
    <div class="ratebox" style="float:right;">{rate}</div>

			<div class="uavatar"><img src="{foto}">

                <div class="user-status">
                    [online]<img src="{THEME}/images/online.png" title="Пользователь в сети">[/online]
            [offline]<img src="{THEME}/images/offline.png" title="Пользователь не в сети">[/offline]
                     </div>           
			</div>

			<ul class="ulist">
				<li><span class="grey">Полное имя:</span> <b>{fullname}</b></li>
				<li><span class="grey">Группа:</span> {status} [time_limit]&nbsp;В группе до: {time_limit}[/time_limit]</li>
        		<li><span class="grey">Дата регистрации:</span> <b>{registration}</b></li>
				<li><span class="grey">Последнее посещение:</span> <b>{lastdate}</b></li>
				<li><span class="grey">Немного о себе:</span> {info}</li>
            </ul>

    <div class="clr"></div><hr />
    <div class="info-block" style="overflow:hidden;">
    <ul class="uinfo">
        <li><h1>Активность</h1></li>
        <li><span class="grey">Количество публикаций:</span> <b>{news-num}</b><br /> [ {news} ][rss]<img src="{THEME}/images/rss.png" alt="rss" style="vertical-align: middle; margin-left: 5px;" />[/rss]</li>
        <li><span class="grey">Количество комментариев:</span> <b>{comm-num}</b><br /> [ {comments} ]</li>
    </ul>
    
    <ul class="uinfo">
        <li><h1>Дополнительно</h1></li>
		<li><span class="grey">ICQ:</span> {icq}</li>
        <li><span class="grey">Место жительства:</span> {land}</li>
        <li>{email}</li>
        [not-group=5]
        <li>{pm}</li>
        [/not-group]
    </ul>
    </div>
    <div class="clr"></div>
			<span class="small">[not-logged] [ {edituser} ] [/not-logged]</span>
</div>

{include file="engine/modules/ulogin/ulogin_tpl_profile.php?my_profile={my_profile}"}

    [not-logged]
<div id="options" class="box-out margin" style="display:none;">
     {include file="engine/modules/ulogin/ulogin_tpl_profile.php?my_profile={my_profile}"} 
    
    
		<div class="block-head">Редактирование профиля</div>
		<table class="tableform">
			<tr>
				<td class="label">Ваше Имя:</td>
				<td><input type="text" name="fullname" value="{fullname}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Ваш E-Mail:</td>
				<td><input type="text" name="email" value="{editmail}" class="f_input" /><br />
				<div class="checkbox">{hidemail}</div>
				<div class="checkbox"><input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">Отписаться от подписанных новостей</label></div></td>
			</tr>
			<tr>
				<td class="label">Место жительства:</td>
				<td><input type="text" name="land" value="{land}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Список игнорируемых:</td>
				<td>{ignore-list}</td>
			</tr>
			<tr>
				<td class="label">Номер ICQ:</td>
				<td><input type="text" name="icq" value="{icq}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Старый пароль:</td>
				<td><input type="password" name="altpass" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Новый пароль:</td>
				<td><input type="password" name="password1" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Повторите:</td>
				<td><input type="password" name="password2" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">Блокировка по IP:<br />Ваш IP: {ip}</td>
				<td>
				<div><textarea name="allowed_ip" style="width:98%;" rows="5" class="f_textarea">{allowed-ip}</textarea></div>
				<div>
					<span class="small" style="color:red;">
					* Внимание! Будьте бдительны при изменении данной настройки.
					Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете.
					Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.
					<br />
					Пример: 192.48.25.71 или 129.42.*.*</span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="label">Аватар:</td>
				<td>Загрузить с компьютера: <input type="file" name="image" class="f_input" /><br /><br />
				Сервис <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>: <input type="text" name="gravatar" value="{gravatar}" class="f_input" /> (Укажите E-mail на данном сервисе)
				<br /><br /><div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить аватар</label></div>
				</td>
			</tr>
			<tr>
				<td class="label">О себе:</td>
				<td><textarea name="info" style="width:98%;" rows="5" class="f_textarea">{editinfo}</textarea></td>
			</tr>
			<tr>
				<td class="label">Подпись:</td>
				<td><textarea name="signature" style="width:98%;" rows="5" class="f_textarea">{editsignature}</textarea></td>
			</tr>
			{xfields}
		</table>
    <div align="center"><hr />
			<input class="fbutton" type="submit" name="submit" value="Отправить" />
		</div>
</div>
[/not-logged]