<div class="full-story"> 
<h1 class="post-title">Пользователь: {usertitle}</h1>
<img src="{foto}" border="0" alt=""/>
<table class="uitable">
 <tr>
  <td class="pline"><b>Полное имя:</b></td>
  <td>{fullname}</td>
 </tr>
 <tr>
  <td class="pline"><b>Дата регистрации:</b></td>
  <td>{registration}</td>
 </tr>
 <tr>
  <td class="pline"><b>Последнее посещение:</b></td>
  <td>{lastdate}
      [online]<img src="{THEME}/images/online.png" style="vertical-align: middle;" title="Пользователь Онлайн" alt="Пользователь Онлайн" />[/online][offline]<img src="{THEME}/images/offline.png" style="vertical-align: middle;" title="Пользователь offline" alt="Пользователь offline" />[/offline]
  </td>
 </tr>
 <tr>
  <td class="pline"><b>Группа:</b></td>
  <td>{status}[time_limit] в группе до: {time_limit}[/time_limit]</td>
 </tr>
 <tr>
  <td class="pline"><b>Место жительства:</b></td>
  <td>{land}</td>
 </tr>
 <tr>
  <td class="pline"><b>Немного о себе:</b></td>
  <td><div style="font-style:italic;color:#505050;">{info}</div></td> 
 </tr>
 <tr>
  <td class="pline"><b>Количество публикаций</b> ({news}):</td>
  <td>{news-num} [rss]RSS[/rss]</td>
 </tr>
 <tr>
  <td class="pline"><b>Количество комментариев</b> ({comments}):</td>
  <td>{comm-num}</td>
 </tr>
 <tr>
  <td class="pline"><b>E-mail адрес:</b></td>
  <td>{email}</td>
 </tr>
 <tr>
  <td colspan="2">
  {pm}
  <br />[not-logged][{edituser}][/not-logged]
  </td>
 </tr>
</table>
[not-logged]
<div id="options" style="display:none;">
<br/>
<b>Редактирование информации</b>
<table class="uitable">
 <tr>
  <td class="sline"><b>Ваш e-mail:</b></td>
  <td><input type="text" name="email" value="{editmail}" class="input3"/>{hidemail}</td>
 </tr>
 <tr>
  <td class="sline"><b>Ваше имя:</b></td>
  <td><input type="text" name="fullname" value="{fullname}" class="input3"/></td>
 </tr> 
 <tr>
  <td class="sline"><b>Проживание:</b></td>
  <td><input type="text" name="land" value="{land}" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Старый пароль:</b></td>
  <td><input type="password" name="altpass" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Новый пароль:</b></td>
  <td><input type="password" name="password1" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Повторите:</b></td>
  <td><input type="password" name="password2" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Блокировка по IP:</b></td>
  <td><textarea name="allowed_ip" style="width:320px; height:70px; font-family:verdana; font-size:11px;" class="f_textarea" rows="" cols="" >{allowed-ip}</textarea><br />Ваш текущий IP: <strong>{ip}</strong><br /><br /><font style="color:#000;font-size:10px;">* Внимание! Будьте бдительны при изменении данной настройки. Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете. Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.<br />Пример: 192.48.25.71 или 129.42.*.*</font></td>
 </tr>
 <tr>
  <td class="sline"><b>Аватар:</b></td>
  <td>Загрузить с комьютера:<input type="file" name="image" class="input3"/>
  <br /><br />Сервис <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>: <input type="text" name="gravatar" value="{gravatar}" class="f_input" /> (Укажите E-mail на данном сервисе)
<br /><br /><div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить аватар</label></div>
  </td>
 </tr>
 <tr>
	<td class="sline"><b>Часовой пояс:</b></td>
	<td>{timezones}</td>
</tr>
 <tr>
  <td class="sline"><b>О себе:</b></td>
  <td><textarea name="info" class="input4" cols="" rows="">{editinfo}</textarea></td>
 </tr>
 <tr>
  <td class="sline"><b>Подпись:</b></td>
  <td><textarea name="signature" class="input4" cols="" rows="">{editsignature}</textarea></td>
 </tr>
 {xfields}
 			<tr>
				<td class="sline"></td>
				<td>{news-subscribe}</td>
			</tr>
			<tr>
				<td class="sline"></td>
				<td>{comments-reply-subscribe}</td>
			</tr>
			<tr>
				<td class="sline"></td>
				<td>{unsubscribe}</td>
			</tr> 
</table>
</div>
[/not-logged]
<input name="submit" type="submit" id="submit" value="Сохранить" class="vbutton"/>
<div class="clear"></div>
</div>