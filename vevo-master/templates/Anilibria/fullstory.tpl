<article>
<div class="torrent_content">
    <div class="detail_torrent_info">
        <h1 class="tor_rel_name">{title} </h1>
        <hr class="poloska-detail">
        <!-- Таблица дополнительных кнопочек --->
        <table border="0" cellpadding="0" cellspacing="0" height="21" width="221">
            <tbody>
                <tr>
                    <td>
				[not-group=5]
				<div class="film-user-info clearfix">
					<div class="full-info-item" style="float: left; height: 30px;line-height: 30px;margin-right: 20px;color: #fff;font-size: 16px;">
						[add-favorites]<i class="fa fa-heart-o"></i> Добавить в закладки[/add-favorites]
						[del-favorites]<i class="fa fa-heart"></i> Убрать из закладок[/del-favorites] 
					</div>
				</div>
				[/not-group]
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="poloska-detail">
        <!-- ЖАНРЫ ТЭГАМИ -->
		[xfgiven_janre]<b>Жанры:</b> [xfvalue_janre]<br>[/xfgiven_janre]
        <!-- ЖАНРЫ ТЭГАМИ END -->
        <!-- озвучка -->
        [xfgiven_rolax]<b>Озвучка:</b> [xfvalue_rolax]<br>[/xfgiven_rolax]
        <!-- озвучка -->
		[xfgiven_anime-sezon]<b>Аниме-сезон:</b> [xfvalue_anime-sezon]<br>[/xfgiven_anime-sezon]
        [xfgiven_time]<b>Тип:</b>&nbsp;[xfvalue_time]		<br>[/xfgiven_time]
        [xfgiven_tayming]<b>Тайминг:</b>&nbsp;[xfvalue_tayming]		<br>[/xfgiven_tayming]
        [xfgiven_sostoyanie-reliza]<b>Состояние релиза:</b>&nbsp;[xfvalue_sostoyanie-reliza]		<br>[/xfgiven_sostoyanie-reliza]
        <hr class="poloska-detail">
        <p class="detail-description">
            <span><b>Описание:</b></span>
            {full-story}
            <br>
            <br>
            © Ice Shower		
            <br>
            <br>
        </p>
    </div>
	<div class="detail_torrent_side">
		<div class="detail_pic_corner">
			<img class="detail_torrent_pic" border="0" src="[xfvalue_image]" width="352" height="513" alt="Days / Дни" title="Days / Дни">
				</div>
	</div>
	<div class="block_fix"></div><!-- Предотвращает налезание блоков друг на друга -->
    <!-- Vivod spiska torrentov END -->
    <hr class="poloska-detail">
    <div class="players-section">
        <ul class="tabs">
            <li class="current">Просмотр онлайн</li>
            <li>Трейлер</li>
            <li>Запасной плеер</li>
        </ul>
        <div class="bos full-text visible">
        <iframe width="853" height="480" src="https://www.youtube.com/embed/-_kGE9jHonU" frameborder="0" allowfullscreen></iframe>
		<!-- это трейлер, заменяем своим полем. this is trailer, replace this youtube frame by your xfield or code. -->   </div>
        <div class="bos full-text">
        <iframe width="853" height="480" src="https://www.youtube.com/embed/-_kGE9jHonU" frameborder="0" allowfullscreen></iframe>
		<!-- это трейлер, заменяем своим полем. this is trailer, replace this youtube frame by your xfield or code. -->
		</div>
        <div class="bos full-text">
            3-я вкладка
        </div>
    </div>   
    <script>
        $(function() {
            $('ul.tabs').delegate('li:not(.current)', 'click', function() {
                $(this).addClass('current').siblings().removeClass('current')
                .parents('div.players-section').find('div.box').hide().eq($(this).index()).fadeIn(400);
            })
        });
    </script>
    <hr class="poloska-detail">
    
    <div class="comments ignore-select">
	<div class="bot">
		[comments]<h4 class="heading">Комментарии <span class="grey hnum">{comments-num}</span></h4>[/comments]
		<div class="com_list">
			{comments}
		</div>
	</div>
	{navigation}
	<div class="box">
		{addcomments}
	</div>
</div>
 </div>   
<style>
.torrent_content {
    background-color: #fff;
    width: 886px;
    border-top: 2px solid #E3E3E3;
    border-left: 2px solid #E3E3E3;
    border-right: 2px solid #E3E3E3;
}  
.detail_torrent_info {
    float: left;
    width: 480px;
    padding: 10px 0px 0px 20px;
    font-family: 'PT Sans', sans-serif;
}
h1.tor_rel_name {
    padding: 0px;
    margin: 0px;
    color: #d83541;
    font-weight: 400;
    font-size: 18pt;
}
hr.poloska-detail {
    border: none;
    color: #e7e7e7;
    background-color: #e7e7e7;
    height: 1px;
}
 .torrent_content .detail_torrent_info a, .torrent_content .detail_torrent_info a:visited, .download-torrent .torrent-first-col a, .download-torrent .torrent-first-col a:visited {
    color: #b32121;
    text-decoration: none;
    outline: none;
}
.torrent_content .detail_torrent_info a:hover, .download-torrent .torrent-first-col a:hover {
    color: #b82525;
    text-decoration: none;
    font-weight: bold;
}
p.detail-description {
    color: #7f7f7f;
    font-family: 'PT Sans', sans-serif;
    font-weight: 400;
    font-size: 12pt;
}
p.detail-description span {
    color: #000;
}
.detail_torrent_side {
    float: right;
}    
.detail_pic_corner {
    margin: 5px 5px 0px 0px;
    background-color: #d9d9d9;
    width: 352px;
    height: 513px;
    padding: 5px;
}
img.detail_torrent_pic {
    margin: 0px;
    padding: 0px;
}
.block_fix {
    clear: both;
    height: 0px;
}
p.content_head_text {
    font-family: 'PT Sans', sans-serif;
    font-weight: 400;
    font-size: 16pt;
    text-align: center;
    margin: 0px;
}
.box_in {
    padding: 4% 8%;
}
.addcomment h3 {
    margin: .3em 0 .6em 0;
        font-size: 20px;
}
    textarea {
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
 textarea {
    font: normal 14px/1.5 Arial, Helvetica, sans-serif;
    color: #353535;
    outline: none;
} 
.bb-editor textarea {
    padding: 7px;
    width: 100%;
    margin-top: -1px;
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
.bb-editor textarea, .ui-dialog textarea, select#category, .timezoneselect, .quick-edit-text {
    width: 100% !important;
}
#comment-editor .bb-editor textarea {
    padding: 7px;
    padding-bottom: 45px;
    height: 140px;
}
label {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
.form_submit {
    margin-top: 20px;
}
.btn-big {
    height: 46px;
    padding: 12px 27px;
    border-radius: 23px;
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
    background-color: #d52c43;
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
  .btn b {
    font-weight: bold;
}
.btn:hover, .bbcodes:hover, .ui-button:hover {
        background-color: #282829;
}
.bot, .comment {
    background-color: #fff;
    margin-bottom: 25px;
    border-radius: 2px;
    position: relative;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
}
.showfull #dle-content .bot {
    float: left;
    width: 100%;
}
.bot > .heading {
    padding: 4% 8%;
    margin: 0;
    text-transform: uppercase;
    font-size: 18px;
    letter-spacing: -0.01em;
    line-height: normal;
    font-weight: bold;
    text-rendering: optimizeLegibility;
}
.bot > .heading .hnum {
    font-size: .6em;
    display: inline-block;
    vertical-align: top;
    margin: 0 0 0 .4em;
    color: #919191;
}

.grey {
    color: #919191;
}
.bb-pane {
    display: none;
}
</style>
</article>