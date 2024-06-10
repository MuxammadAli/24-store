<div class="sideblock vote">  
	<h3>ОПРОС <a href="#" class="resbutton" onclick="ShowAllVotes(); return false;" title="Показать все опросы">Все опросы</a></h3>
	[votelist]
	<div class="vote_block"> 
		<div id="question">{title}</div>
			<form method="post" name="vote" action="">
			{list}
		  <input type="hidden" name="vote_action" value="vote"/>
          <input type="hidden" name="vote_id" id="vote_id" value="{vote_id}"/>
          <button class="votebutton" type="submit" onclick="doVote('vote'); return false;" >Голосовать</button>
		  </form>
          <form method="post" name="vote_result" action=''>
          <input type="hidden" name="vote_action" value="results"/>
          <input type="hidden" name="vote_id" value="{vote_id}"/>
          <button class="vbutton" type="button" onclick="doVote('results'); return false;" >Результаты</button>
          </form>	
		  <div class="clear"></div>
	</div>
[/votelist]
[voteresult]
	<div class="vote_block">
		<div id="question">{title}</div>
        <br>
		<div class="vote">
		  {list}
		  <br>
		  Всего проголосовало: {votes}
		</div>
	</div>
[/voteresult]
</div>