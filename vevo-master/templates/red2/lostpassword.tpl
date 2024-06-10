<div class="full-story"> 
	<h2 class="post-title">Восстановление забытого пароля</h2>
 	<table class="fulltable">
  		<tr>
   			<td class="sline"><b>Ваш логин (e-mail):</b></td>
			<td><input type="text" class="input3" name="lostname"/></td>
		</tr>
  		[sec_code]
  		<tr>
   			<td class="sline"><b>Код:</b></td>
   			<td>{code}</td>
  		</tr>
  		<tr>
   			<td class="sline"><b>Введите код:</b></td>
   			<td><input class="input3" maxlength="45" name="sec_code" size="14"/></td>
  		</tr>
  		[/sec_code]
  		[recaptcha] 
  		<tr>
   			<td class="sline"><b>Введите два слова, показанных на изображении:</b></td>
   			<td>{recaptcha}</td>
  		</tr>
  		[/recaptcha]
  		<tr>
   			<td colspan="2"><input type="submit" class="votebutton" name="submit" value="Восстановить" alt="Восстановить пароль"/></td>
  		</tr>
 	</table>
</div>