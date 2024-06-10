<div class="poll"> 
	<b>{title}</b>
    <br />
	<i>{question}</i>
	{list}
	Всего проголосовало: {votes}
	[not-voted]
	<br />
	<div class="buttonholder">
		<button type="button" onclick="doPoll('vote', '{news-id}'); return false;" class="vbutton" value="Голосовать" />Голосовать</button>
		<button type="button" onclick="doPoll('results', '{news-id}'); return false;" class="vbutton" value="Результаты" />Результаты</button>[/not-voted]
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>