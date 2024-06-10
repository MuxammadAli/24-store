<article class="bof story">
	<div class="box_in">
		<h1 class="title h1">Личные сообщения</h1>
		<div class="pm-box">
			<nav id="pm-menu">
				[inbox]<span>Входящие</span>[/inbox]
				[outbox]<span>Отправленые</span>[/outbox]
				[new_pm]<span>Создать сообщение</span>[/new_pm]
			</nav>
			<div class="pm_status">
				{pm-progress-bar}
				{proc-pm-limit} % / ({pm-limit} сообщений)
			</div>
		</div>
		[pmlist]
		<div class="pmlist">
			{pmlist}
		</div>
		[/pmlist]
		[newpm]
		<h4 class="heading">Создать сообщение</h4>
		<div class="addform addpm">
			<ul class="ui-form">
				<li class="form-group combo">
					<div class="combo_field">
						<input placeholder="Имя адресата" type="text" name="name" value="{author}" class="wide" required>
					</div>
					<div class="combo_field">
						<input placeholder="Тема сообщения" type="text" name="subj" value="{subj}" class="wide" required>
					</div>
				</li>
				<li id="comment-editor">{editor}</li>    
			[recaptcha]
				<li>{recaptcha}</li>
			[/recaptcha]
			[question]
				<li class="form-group">
					<label for="question_answer">Вопрос: {question}</label>
					<input placeholder="Ответ" type="text" name="question_answer" id="question_answer" class="wide" required>
				</li>
			[/question]
			</ul>
			<div class="form_submit">
				[sec_code]
					<div class="c-captcha">
						{sec_code}
						<input placeholder="Повторите код" title="Введите код указанный на картинке" type="text" name="sec_code" id="sec_code" required>
					</div>
				[/sec_code]
				<button class="btn btn-big" type="submit" name="add"><b>Отправить</b></button>
				<button class="btn-border btn-big" type="button" onclick="dlePMPreview()">Предпросмотр</button>
			</div>
		</div>
		[/newpm]
	</div>
	[readpm]
	<div class="comment" id="{comment-id}">
		<div class="com_info">
			<div class="avatar">
				<span class="cover" style="background-image: url({foto});">{login}</span>
				[online]<span class="com_online" title="{login} - онлайн">Онлайн</span>[/online]
			</div>
			<div class="com_user">
				<b class="name">{author}</b>
				<span class="grey">
					от {date}
				</span>
			</div>
			<div class="meta">
				<ul class="left">
					<li class="reply grey" title="Ответить">[reply]<svg class="icon icon-reply"><use xlink:href="#icon-reply"></use></svg><span>Ответить</span>[/reply]</li>
					<li class="reply grey" title="Игнорировать">[ignore]<svg class="icon icon-reply"><use xlink:href="#icon-dislike"></use></svg><span>Игнорировать</span>[/ignore]</li>
					<li class="complaint" title="Жалоба">[complaint]<svg class="icon icon-bad"><use xlink:href="#icon-bad"></use></svg><span class="title_hide">Жалоба</span>[/complaint]</li>
					<li class="del" title="Удалить">[del]<svg class="icon icon-cross"><use xlink:href="#icon-cross"></use></svg><span class="title_hide">Удалить</span>[/del]</li>
				</ul>
			</div>
		</div>
		<div class="com_content">
			<h4 class="title">{subj}</h4>
			<div class="text">{text}</div>
			[signature]<div class="signature">--------------------<br />{signature}</div>[/signature]
		</div>
	</div>
	[/readpm]
</article>
<style>
   .bof, .comment {
    background-color: #fff;
    margin-bottom: 25px;
    border-radius: 2px;
    position: relative;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
} 
    .box_in {
    padding: 4% 8%;
}
    .story .title {
    margin: -.1em 0 1em 0;
    font-size: 20px;
}
    /* --- PM --- */
@media only screen and (min-width: 601px) {
#pm-menu:after { content: ""; clear: both; display: block; }
	#pm-menu { margin-bottom: 25px; }
	#pm-menu a { color: inherit; padding: 10px 16px; border-radius: 2px; border: 2px solid transparent; float: left; text-decoration: none !important; }
	#pm-menu a:hover { border-color: #3394e6; color: #3394e6; }
}

	.pm-box { margin-bottom: 25px; }
		.pm_status { padding: 25px; background-color: #f7f7f7; border-radius: 2px; }
		.pm_progress_bar { background-color: #e5dbcc; margin-bottom: 10px; border-radius: 2px; }
		.pm_progress_bar span { background: #e85319; font-size: 0; height: 20px; border-radius: 2px; display: block; overflow: hidden }
         h4, .h4 { font-size: 18px;}
    ul.ui-form {
    list-style: none;
    padding: 0;
    margin: 0;
}
    ul.ui-form > li { margin-bottom: 20px; }
		ul.ui-form > li:last-child { margin-bottom: 0; }
		.form-group { margin-bottom: 20px; }
		.form-group > label { display: block; margin-bottom: .4em; }
		.imp:after { content: "*"; margin: 0 0 0 10px; color: #e85319; }

		@media only screen and (min-width: 601px) {
			.form-group.combo:after { clear: both; display: table; content: ""; }
			.form-group.combo > .combo_field { width: 50%; float: left;
				-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
			}
			.form-group.combo > .combo_field:last-child { padding-left: 10px; }
			.form-group.combo > .combo_field:first-child { padding-right: 10px; }
		}
		.form_submit { margin-top: 20px; }
		.form-sep { border-top: 1px solid #efefef; }
select, textarea, input[type="text"], input[type="password"], input[type="file"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"] {
    display: inline-block;
    width: 302px;
    height: 46px;
    line-height: 22px;
    padding: 10px;
    vertical-align: middle;
    border-radius: 2px;
    background: #fff;
    border: 2px solid #e8e8e8;
    -webkit-transition: border 0.2s linear 0s;
    transition: border 0.2s linear 0s;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
    .bb-pane {
        display: none;
}
    .btn, .bbcodes, .ui-button, .btn-border {
    border: 0 none;
    display: inline-block;
    vertical-align: middle;
    cursor: pointer;
    height: 36px;
    border-radius: 18px;
    line-height: 22px;
    outline: none;
    background-color: #3394e6;
    color: #fff;
    border: 0 none;
    padding: 7px 22px;
    text-decoration: none !important;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all ease .1s;
    transition: all ease .1s;
}
    .btn-big {
    height: 46px;
    padding: 12px 27px;
    border-radius: 23px;
}
    .btn:hover, .bbcodes:hover, .ui-button:hover {
    background-color: #46a6f6;
}
    .btn-border {
    display: none;
}
    /*--- Таблица Персональных сообщений и лучших пользователей ---*/
.userstop td, .pm td.pm_list, .pm td.pm_head { border-bottom: 1px solid #efefef; padding: 12px 2px; }
	table.pm, table.userstop { width: 100%; margin-bottom: 0; }
	table.pm select { width: 100px; }
	.userstop thead td, .pm td.pm_head { border-bottom: 1px solid #efefef; font-weight: bold; }
	table.pm .navigation { border-top-width: 0; margin: 0; }
</style>