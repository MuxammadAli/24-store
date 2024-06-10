<div class="box-out margin">
    <div class="block-head">Статистика сайта</div>
    <ul class="stats reset">
        <li><h1>Новости:</h1></li>
		<li>Общее кол-во новостей: <b class="blue">{news_num}</b></li>
		<li>Из них опубликовано: <b class="blue">{news_allow}</b></li>
		<li>Опубликовано на главной: <b class="blue">{news_main}</b></li>
		<li>Ожидает модерации: <b class="blue">{news_moder}</b></li>
	</ul>

	<ul class="stats reset">
		<li><h1>Пользователи:</h1></li>
		<li>Общее кол-во пользователей: <b class="blue">{user_num}</b></li>
		<li>Из них забанено: <b class="blue">{user_banned}</b></li>
	</ul>

	<ul class="stats reset">
		<li><h1>Комментарии:</h1></li>
		<li>Кол-во комментариев: <b class="blue">{comm_num}</b></li>
		<li><a href="/?do=lastcomments">Посмотреть последние</a></li>
	</ul>

    <ul class="clr reset info-block">
        <li><b>За сутки:</b> Добавлено {news_day} новостей и {comm_day} комментариев, зарегистрировано {user_day} пользователей</li>
        <li><b>За неделю:</b> Добавлено {news_week} новостей и {comm_week} комментариев, зарегистрировано {user_week} пользователей</li>
         <li><b>За месяц:</b> Добавлено {news_month} новостей и {comm_month} комментариев, зарегистрировано {user_month} пользователей</li>
    </ul>

    <b>Общий размер базы данных: {datenbank}</b>
</div>

<div class="box-out">
		<h1>Лучшие пользователи</h1>
    <table width="100%" class="userstop">{topusers}</table>
</div>