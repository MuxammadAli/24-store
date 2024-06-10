<link rel="stylesheet" type="text/css" href="engine/skins/chosen/chosen.css"/> 
<script type="text/javascript" src="engine/skins/chosen/chosen.js"></script>
<script type="text/javascript"> 
$(function(){
	$('#category').chosen({allow_single_deselect:true, no_results_text: 'Ничего не найдено'});
});
</script>
<div class="full-story"> 
	<div class="post-title"><h1>Добавление новой публикации на сайте</h1></div>
	<table class="fulltable">
		<tr>
			<td class="sline"><b>Заголовок:</b> <span class="import">*</span></td>
			<td><input type="text" name="title" value="{title}" class="input1" id="title"/>&nbsp;<input class="bbcodes" style="height: 22px; font-size: 11px;" title="Найти похожие новости" onclick="find_relates(); return false;" type="button" value="Найти похожие" /><span id="related_news"></span></td>
		</tr>
		[urltag]
		<tr>
			<td class="sline"><b>URL статьи:</b></td>
			<td><input type="text" name="alt_name" value="{alt-name}" class="input1"/></td>
		</tr>
		[/urltag]
		<tr>
			<td class="sline"><b>Категория:</b> <span class="import">*</span></td>
			<td>{category}</td>
		</tr>
		<tr>
			<td class="sline">&nbsp;</td>
			<td><a href="#" onclick="$('.addvote').toggle();return false;" class="bbcodes">Добавить опрос</a></td>
		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="sline"><b>Заголовок опроса:</b></td>
			<td><input type="text" name="vote_title" value="{votetitle}" maxlength="150" class="input1" /></td>
		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="sline"><b>Вопрос:</b></td>
			<td><input type="text" name="frage" value="{frage}" maxlength="150" class="input1" /></td>
  		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="sline"><b>Варианты ответов:</b><br /><br />Каждая новая строка является новым вариантом ответа</td>
			<td><textarea name="vote_body" rows="10" class="f_textarea" >{votebody}</textarea><br /><input type="checkbox" name="allow_m_vote" value="1" {allowmvote}> Разрешить выбор нескольких вариантов
            </td>
   		</tr>
   		<tr>
    		<td class="sline"><b>Краткая новость:</b> <span class="import">*</span></td>
    		<td>
    		[not-wysywyg]
    			<div class="bb-editor">
    				{bbcode}
    				<textarea name="short_story" id="short_story" onfocus="setFieldName(this.name)" rows="15" cols="" class="f_textarea" >{short-story}</textarea>
    			</div>
    		[/not-wysywyg]
    		{shortarea}
    		</td>
   		</tr>
   		<tr>
    		<td class="sline"><b>Полная новость:</b> (необязательно)</td>
    		<td>
    		[not-wysywyg]
   				 <div class="bb-editor">
    				{bbcode}
    					<textarea name="full_story" id="full_story" onfocus="setFieldName(this.name)" rows="20" colls="" class="f_textarea" >{full-story}</textarea>
   				</div>
    		[/not-wysywyg]
    			{fullarea}
    		</td>
   		</tr>
   		<tr>
    		<td class="sline"><b>Теги:</b></td>
    		<td><input class="input1" type="text" id="tags"  name="tags" value="{tags}" maxlength="150"  /></td>
   		</tr>
   			{xfields}
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
   		[sec_code]
   		<tr>
    		<td class="sline"><b>Код:</b></td>
    		<td>{sec_code}</td>
   		</tr>
   		<tr>
    		<td class="sline"><b>Введите код:</b></td>
    		<td><input class="input3" maxlength="45" name="sec_code" colls="" size="14"/></td>
   		</tr>
   		[/sec_code]
   		[recaptcha]
   		<tr>
    		<td colspan="2">
     		Введите два слова, показанных на изображении:<br/>
     		{recaptcha}
    		</td>
   		</tr>
   		[/recaptcha]
   		<tr>
    		<td colspan="2">
    		{admintag}
    		</td>
   		</tr>
   		<tr>
    		<td colspan="2">
    			<input class="vbutton" type="submit" name="add" value="Добавить"/>
    			<input class="vbutton" type="button" name="nview" onClick="preview()" value="Просмотр"/>
    		</td>
   		</tr>
	</table>
</div>