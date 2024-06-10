[searchposts]
[fullresult] 
<div class="shortstory">
    <div class="over200">
        <a href="{full-link}" title="{title}"><img src="{image-1}" alt="" />        
        <span class="playicon"></span>
        [xfgiven_time]<span class="time">[xfvalue_time]</span>[/xfgiven_time]
        </a>
    </div>
    <h2 class="shorttitle"><a href="{full-link}" title="{title}">{title}</a></h2>    
    <div class="short-info">
        [xfgiven_quality]<div class="quality">[xfvalue_quality]</div>[/xfgiven_quality]
        <div class="views">Просмотров: {views}</div>
        <div class="clear"></div>
        <div class="date">{date}</div>
    </div>               
</div>
[/fullresult]
[shortresult]
<div class="full-story">
<div class="line">	
<b> #{news-id}</b> <a href="{full-link}" title="{title}">{title}</a>
</div>
</div>
[/shortresult]
[/searchposts]
[searchcomments]
[fullresult]
<div class="comment">
    <div class="comment-block">
        <table  width="100%" cellspacing="0" border="0">
            <tr>
                <td>
                    <div class="comment-left">
                        <img src="{foto}" border="0" alt=""/>
                    </div>
                    <div class="comment-right">
                        <div class="comm-data">
                            [online]
                            <img src="{THEME}/images/online.png" style="vertical-align: middle;" title="Пользователь Онлайн" alt="Пользователь Онлайн" />[/online]
                            [offline]<img src="{THEME}/images/offline.png" style="vertical-align: middle;" title="Пользователь offline" alt="Пользователь offline" />[/offline]
                            <b>{author}</b> 
                            {date}
                        </div>
                        {comment}
                        [signature]<font style="font-size:11px;">--------------------<br>{signature}</font>[/signature]
                        <div class="comment-news">{news_title}</div>                               
                        <div class="comment-control">                        
                                [fast]Цитировать[/fast]
                                [spam]Спам[/spam]
                                [complaint]Жалоба[/complaint]
                                [com-edit]Редакт.[/com-edit]
                                [com-del]Удалить[/com-del]
                                <span class="mass-action">{mass-action}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
        </table>
    </div>  
</div>
[/fullresult]
[shortresult]
<div class="full-story">
<div class="line">
<font style="color:#000;font-weight:bold;" > #{comment-id}</font> | написал: {author} | {news_title} 
</div>
</div><br>
[/shortresult]
[/searchcomments]