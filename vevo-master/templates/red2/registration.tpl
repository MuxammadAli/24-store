<div class="full-story">  
<h1 class="post-title">[registration]Регистрация нового пользователя[/registration][validation]Обновление профиля пользователя[/validation]</h1>
<div class="info">
[registration]Добрый день, уважаемый посетитель нашего сайта. Регистрация позволит Вам стать полноценным участником данного проекта. Вы сможете оставлять комментарии, просматривать скрытый текст, добавлять новости и многое другое. В случае возникновения проблем с регистрацией, напишите администратору сайта.[/registration]
[validation]Уважаемый посетитель Ваш аккаунт был зарегистрирован на нашем сайте, однако информация о вас является неполной, поэтому заполните дополнительные поля в вашем профиле.[/validation]
</div>
<table class="fulltable">
 [registration] 
 <tr>
  <td class="sline"><b>Логин:</b> <span class="import">*</span></td>
  <td><input type="text" name="name" id='name' class="input3"/> <input class="bbcodes" title="Проверить доступность логина для регистрации" onclick="CheckLogin(); return false;" type="button" value="Проверить имя"/><div id='result-registration'></div></td>
 </tr>
 <tr>
  <td class="sline"><b>Пароль:</b> <span class="import">*</span></td>
  <td><input type="password" name="password1" class="input3"/> Не менее 6 символов </td>
 </tr>
 <tr>
  <td class="sline"><b>Повторите:</b> <span class="import">*</span></td>
  <td><input type="password" name="password2" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Ваш e-mail: <span class="import">*</span></b></td>
  <td><input type="text" name="email" class="input3"/></td>
 </tr>
 [question]
 <tr>
  <td class="sline"><b>Вопрос:</b></td>
  <td>{question}</td>
 </tr>
 <tr>
  <td><b>Ответ:</b></td>
  <td><input type="text" name="question_answer" id="question_answer" class="f_input" /></td>
 </tr>
 [/question]
 [sec_code]
 <tr>
  <td class="sline"><b>Код безопасности:</b></td>
  <td>{reg_code}</td>
 </tr>
 <tr>
  <td class="sline"><b>Введите код:</b></td>
  <td><input class="input3"  maxlength="45" name="sec_code" size="14"/></td>
 </tr>
 [/sec_code]
 [recaptcha]
 <tr>
  <td class="sline"><b>Введите два слова, показанных на изображении:</b></td>
  <td>{recaptcha}</td>
 </tr>
 [/recaptcha]
 [/registration]
 [validation]
 <tr>
  <td class="sline"><b>Ваше имя:</b></td>
  <td><input type="text" name="fullname" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Место жительства:</b></td>
  <td><input type="text" name="land" class="input3"/></td>
 </tr>
 <tr>
  <td class="sline"><b>Фото:</b></td>
  <td><input type="file" name="image" style="width:278px; height:20px; font-family:tahoma; font-size:11px; border:1px solid #E0E0E0 "/></td>
 </tr>
 <tr>
  <td class="sline"><b>О себе:</b></td>
  <td><textarea name=info style="width:320px; height:70px; font-family:verdana; font-size:11px; border:1px solid #E0E0E0 "></textarea></td>
 </tr>
 {xfields}
 [/validation]
 <tr>
  <td colspan="2">
  <input name="image" class="vbutton" type="submit" value="Отправить" />
  </td>
 </tr>
</table>
</div>