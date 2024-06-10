<div class="box-out margin">
    <div class="news-head">
        <div class="news-title">[full-link]{title}[/full-link]</div>
        <div style="margin-top:4px">

            [not-group=5]
            <ul class="news-det">
                <li>{favorites}</li>
                <li>[edit]<img src="{THEME}/dleimages/editstore.png" title="Редактировать" alt="Редактировать" />[/edit]</li>
            </ul>
            [/not-group]

            <ul class="news-info">
                <li>Опубликовал: {author}</li>
                <li>Дата: [day-news]{date}[/day-news]</li>
                <li>Просмотров: {views}</li>
            </ul>
        
        </div>
        <div class="clr"></div>
    </div>

    <div class="news-text">{short-story}</div>
    [edit-date]
    <div class="info-block">
        Новость отредактировал: <b>{editor}</b> - {edit-date}
			<br />[edit-reason]Причина: {edit-reason}[/edit-reason]
    </div>
    [/edit-date]
    
    <div style="margin-top:7px;">
        <span class="argmore"><a href="{full-link}">Подробнее</a></span>
        <div class="news-bot">
        [rating]<div class="ratebox">{rating}</div>[/rating]
        Категория: {link-category}
        </div>
    </div>
</div>