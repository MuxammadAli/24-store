<div class="box-out margin">
    <div class="news-head">
        <div class="news-title">[full-link]{title}[/full-link]</div>
        <div style="margin-top:4px">

            [not-group=5]
            <ul class="news-det">
                <li>{favorites}</li>
                <li>[edit]<img src="{THEME}/dleimages/editstore.png" title="�������������" alt="�������������" />[/edit]</li>
            </ul>
            [/not-group]

            <ul class="news-info">
                <li>�����������: {author}</li>
                <li>����: [day-news]{date}[/day-news]</li>
                <li>����������: {views}</li>
            </ul>
        
        </div>
        <div class="clr"></div>
    </div>

    <div class="news-text">{short-story}</div>
    [edit-date]
    <div class="info-block">
        ������� ��������������: <b>{editor}</b> - {edit-date}
			<br />[edit-reason]�������: {edit-reason}[/edit-reason]
    </div>
    [/edit-date]
    
    <div style="margin-top:7px;">
        <span class="argmore"><a href="{full-link}">���������</a></span>
        <div class="news-bot">
        [rating]<div class="ratebox">{rating}</div>[/rating]
        ���������: {link-category}
        </div>
    </div>
</div>