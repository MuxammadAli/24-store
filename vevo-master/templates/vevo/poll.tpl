<div class="box-out margin">
        <div class="vinfo"><b>{question}</b></div>   
        {list}
        [voted]<div align="center"><hr>����� �������������: {votes}</div>[/voted]
	[not-voted]
    <div align="center"><hr />
		<button class="fbutton" type="submit" onclick="doPoll('vote'); return false;" ><span>����������</span></button>
		<button class="fbutton" type="submit" onclick="doPoll('results'); return false;"><span>����������</span></button>
	</div>
	[/not-voted]
</div>