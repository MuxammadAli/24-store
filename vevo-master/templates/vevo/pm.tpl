<div class="box-out">
    [pmlist]<div class="block-head">Список сообщений</div>[/pmlist]
    [newpm]<div class="block-head">Новое сообщение</div>[/newpm]
    [readpm]<div class="block-head">Ваши сообщения</div>[/readpm]

    <ul class="pm-menu">
            <li>[inbox]Входящие сообщения[/inbox]</li>
            <li>[outbox]Отправленные сообщения[/outbox]</li>
            <li>[new_pm]Отправить сообщение[/new_pm]</li>
        </ul>
    
    <div class="info-block">
        <h1>Состояние папок</h1>
        Папки персональных сообщений заполнены на:
    	{pm-progress-bar}
    	{proc-pm-limit}% от лимита ({pm-limit} сообщений)
	</div>
[pmlist]
{pmlist}
[/pmlist]
[newpm]
	<table class="tableform">
		<tr>
			<td class="label">
				Кому:
			</td>
			<td><input type="text" name="name" value="{author}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				Тема:<span class="impot">*</span>
			</td>
			<td><input type="text" name="subj" value="{subj}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				Сообщение:<span class="impot">*</span>
			</td>
			<td class="editorcomm">
			{editor}<br />
			<div class="checkbox"><input type="checkbox" id="outboxcopy" name="outboxcopy" value="1" /> <label for="outboxcopy">Сохранить сообщение в папке "Отправленные"</label></div>
			</td>
		</tr>
		[sec_code]
		<tr>
			<td class="label">
				Код:<span class="impot">*</span>
			</td>
			<td>
				<div>{sec_code}</div>
				<div><input type="text" name="sec_code" id="sec_code" style="width:115px" class="f_input" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				Введите два слова, показанных на изображении:<span class="impot">*</span>
			</td>
			<td>
				<div>{recaptcha}</div>
			</td>
		</tr>
		[/recaptcha]
		[question]
			<tr>
				<td class="label">
					Вопрос:
				</td>
				<td>
					<div>{question}</div>
				</td>
			</tr>
			<tr>
				<td class="label">
					Ответ:<span class="impot">*</span>
				</td>
				<td>
					<div><input type="text" name="question_answer" id="question_answer" class="f_input" /></div>
				</td>
			</tr>
		[/question]
	</table>
    <div align="center"><hr />
		<button type="submit" name="add" class="fbutton"><span>Отправить</span></button>
		<input type="button" class="fbutton" onclick="dlePMPreview()" title="Просмотр" value="Просмотр" />
	</div>	
[/newpm]
[readpm]
    <div class="avatar"><img src="{foto}" alt=""/></div>

    <ul class="ulist">
        <li><span class="grey">Отправитель:</span> {author}</li>
        <li><span class="grey">Дата отправки:</span> {date}</li>
		<li><span class="grey">Группа:</span> {group-name}</li>
        <li><span class="grey">Регистрация:</span> {registration}</li>
        <li><span class="grey">Тема:</span> {subj}</li>
    </ul>
    
    <div class="clr"></div><hr />
    <p>{text}</p>
    <ul class="pm-menu">
        <li>[reply]<b>Ответить</b>[/reply]</li>
		<li>[complaint]Пожаловаться[/complaint]</li>
		<li>[ignore]Игнорировать[/ignore]</li>
		<li>[del]Удалить[/del]</li>
    </ul>
    [signature]<br />{signature}[/signature]
[/readpm]
</div>