<div class="side-block nomargin">
    <div class="block-head">
        
        �����
    </div>
    <div class="block-inner">
        <form method="post" name="vote_result" action=''>
            <input type="hidden" name="vote_action" value="results" />
			<input type="hidden" name="vote_id" value="{vote_id}" />
		</form>
        <div class="vinfo"><b>{title}</b></div>
        [votelist]<form method="post" name="vote" action=''>[/votelist]
        {list}

        [voteresult]<div align="center"><hr />����� �������������: {votes}</div>[/voteresult]

        [votelist]
        <input type="hidden" name="vote_action" value="vote" />
        <input type="hidden" name="vote_id" id="vote_id" value="{vote_id}" />
        <div align="center"><hr />
            <button class="fbutton" type="submit" onclick="doVote('vote'); return false;" ><span>����������</span></button>
        	<button class="fbutton" type="button" onclick="doVote('results'); return false;" ><span>����������</span></button>
        </div>
        </form>
        [/votelist]
    </div>
</div>