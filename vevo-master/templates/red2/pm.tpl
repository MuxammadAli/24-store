<div class="full-story">  
	<div class="post-title"><h1>Персональные сообщения</h1></div>
	<div class="row">
		<div class="dpad">
			<div class="pm_status">
				<div class="pm_status_head">Состояние папок</div>
				<div class="pm_status_content">Папки персональных сообщений заполнены на:
				{pm-progress-bar}
				{proc-pm-limit}% от лимита ({pm-limit} сообщений)
				</div>
			</div>
			<div class="pmlinks">
                [inbox]Входящие[/inbox]
                [outbox]Отправленные[/outbox]
                [new_pm]Отправить[/new_pm]
            </div>
        </div>
        <div class="clear"></div>
    </div>
	<br />
	[pmlist]
    <div align="center"><b>Список сообщений</b></div>
    {pmlist}
    <br/>
	[/pmlist]

    <!-- Новое сообщение -->
    [newpm]
    <div align="center"><b>Отправка персонального сообщения</b></div>
		<table class="fulltable">
			<tr>
				<td class="sline"><b>Получатель:</b> <span class="import">*</span></td>
  				<td><input class="input3" type="text" name="name" value="{author}" /></td>
 			</tr>
 			<tr>
                <td class="sline"><b>Тема:</b> <span class="import">*</span></td>
                <td><input class="input3" type="text" name="subj" value="{subj}"  /></td>
 			</tr>
 			<tr>
  				<td colspan="2">
  				{editor}
  				<br/><input type="checkbox" name="outboxcopy" value="1"/> Сохранить сообщение в папке "Отправленные"
  				</td>
 			</tr>
 			[sec_code]
 			<tr>
  				<td class="sline"><b>Код безопасности:</b></td>
  				<td>{sec_code}</td>
 			<tr>
 			<tr>
  				<td class="sline"><b>Введите код:</b></td>
  				<td><input class="txsh" style="width:50px; font-family:tahoma; font-size:12px;" maxlength="45" name="sec_code" size="14"/></td>
 			<tr>
 			[/sec_code]
 				[recaptcha]
 			<tr>
  				<td class="sline"><b>Введите два слова, показанных на изображении:</b></td>
  				<td>{recaptcha}</td>
 			</tr>
 			[/recaptcha]
 			[question]
 			<tr>
  				<td class="sline"><b>Вопрос:</b></td>
  				<td>{question}</td>
 			</tr>
 			<tr>
  				<td class="sline"><b>Ответ:</b></td>
  				<td><input type="text" name="question_answer" id="question_answer" class="f_input" /></td>
 			</tr>
 			[/question]
 			<tr>
  				<td colspan="2">
  				<input class="vbutton" type="submit" name="add" value="Отправить" />&nbsp;&nbsp;<input class="vbutton" type="button" onclick="dlePMPreview()" value="Просмотр" />
  			</td>
 			</tr>
 		</table>
[/newpm]
[readpm]
	<div class="line">
		{text}
		<div class="pm_sub">
			<b>Отправил:</b> {author}
			<br />
			<div style="margin-top:5px;">
                [reply]Ответить[/reply]
                [del]Удалить[/del]
                [complaint]Пожаловаться[/complaint]
            </div>
        </div>
    </div>	
[/readpm]
</div>