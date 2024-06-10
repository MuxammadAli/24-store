<style type="text/css" media="all"> 
@import url({THEME}/css/style.css);
@import url({THEME}/css/engine.css);
body, html{
	background:#fff;
}
fieldset{
	border:1px solid #ccc !important;
	padding:10px;
	margin:10px;
}
legend{
	font-weight:bold;
}
</style>
<div style="background:#fff;">
[short-preview]
<div class="shortstory">
 	<h2 class="shorttitle"><a href="{full-link}" title="{title}">{title}</a></h2>
	{short-story}
 	<div class="clear"></div>
 	<div class="short-info">
   		<div class="sdate">{date}</div> 
 	</div>   
</div>
[/short-preview]


[full-preview]
<div class="full-story">
    <table width="100%" cellspacing="0" border="0">
        <tr>
            <td>
                <h1 class="post-title"><span id="news-title">{title}</span></h1>
                    <div class="fstory">
                        {full-story}
                        <div class="clear"></div> 
                        {poll}                    
                        [edit-date] 
                        <br/>
					<i>Новость отредактировал <b>{editor}</b> - {edit-date} [edit-reason]<br>Причина: {edit-reason}[/edit-reason]</i>[/edit-date] 
				</div>
					[tags]<div class="tags"><b>Теги:</b> {tags}</div>[/tags]

				<div class="full-info">
                                        
				<div class="plusobut">
					<div class='pluso pluso-theme-color pluso-small'><div class='pluso-more-container'><a class='pluso-more' href=''></a><ul class='pluso-counter-container'><li></li><li class='pluso-counter'></li><li></li></ul></div><a class='pluso-facebook'></a><a class='pluso-twitter'></a><a class='pluso-vkontakte'></a><a class='pluso-odnoklassniki'></a><a class='pluso-google'></a><a class='pluso-moimir'></a></div>
<script type='text/javascript'>if(!window.pluso){pluso={version:'0.9.1',url:'http://share.pluso.ru/'};h=document.getElementsByTagName('head')[0];l=document.createElement('link');l.href=pluso.url+'pluso.css';l.type='text/css';l.rel='stylesheet';s=document.createElement('script');s.src=pluso.url+'pluso.js';s.charset='UTF-8';h.appendChild(l);h.appendChild(s)}</script>
				</div>
					<span class="views">{views}</span>
					[print-link]<span class="print">&nbsp;</span>[/print-link]
					[complaint]Нашли ошибку?[/complaint]
					&nbsp;&nbsp;[edit]Редактировать[/edit]
                                        <div class="clear"></div>
				</div>
			</td>
		</tr>  
	</table>
    <div align="center">{pages}</div>
</div>
[/full-preview]

[static-preview]
<div class="full-story">
<div class="post-title">{description}</div>

<table cellspacing="0" padding="0" border="0">
<tr>
<td>
{static}
</td>
</tr>
</table>
{pages}
<br>
[print-link]Напечатать[/print-link]

</div>
[/static-preview]
</div>