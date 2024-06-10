<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{headers}
<link rel="icon" href="{THEME}/images/favicon.ico" type="image/x-icon" /> 
<link rel="shortcut icon" href="{THEME}/images/favicon.ico" type="image/x-icon" />
<link media="screen" href="{THEME}/css/style.css" type="text/css" rel="stylesheet" />
<link media="screen" href="{THEME}/css/engine.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/jquery.ttabs.js"></script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
</head>

<body>
{AJAX}
<div id="container">    
    <div class="rek970x90">
        <img src="{THEME}/images/rek970x90.jpg" alt="Реклама" />
    </div>
    <div class="header">
            <div class="logo">
                <h1><a href="/" title="Главная"><img src="{THEME}/images/logo.png" alt="" /></a></h1>
            </div>        
            <div class="searchblock">
                        <form method="post" action="">
                        <input type="hidden" name="do" value="search" />
                        <input type="hidden" name="subaction" value="search" />
                        <ul>
                        <li><input id="story" name="story" type="text" value="Поиск" onfocus='if (this.value == "Поиск") { this.value=""; }' onblur='if (this.value == "") { this.value="Поиск"; }' class="searchform" /></li>
                        </ul><input class="searchbt" title="Найти" alt="Найти" type="image" src="{THEME}/images/spacer.gif" />
                        </form>
            </div>
            <div class="addbutton">
                <a href="/addnews.html">Добавить видео</a>
            </div>                        
            {login}
            <div class="clear"></div>        
    </div> 
    <div class="nav">
        <ul>
            <li class="drop"><a href="#" class="link1" >КАНАЛЫ</a>
                <ul>
                    <li><a href="#">Категория</a></li>
                    <li><a href="#">Категория</a></li>
                    <li><a href="#">Категория</a></li>
                    <li><a href="#">Категория</a></li>
                </ul>
            </li>
            <li><a href="#" >ЭКСКЛЮЗИВ</a></li>
            <li><a href="#" >АВТО</a></li>
            <li><a href="#" >ПРИКОЛЫ</a></li>
            <li><a href="#" >АНИМЕ</a></li>
            <li><a href="#" >СПОРТ</a></li>
            <li><a href="#" >ТЕХНОЛОГИИ</a></li>
            <li><a href="#" >НАУКА</a></li>
            <li><a href="#" >ЖИВОТНЫЕ</a></li>
            <!-- для добавления ссылки меню скопируйте <li><a href="ссылка">название</a></li> и добавьте выше -->
        </ul>
    </div>          
    <div id="content">
        <div id="left">
            [not-aviable=main]
            {speedbar}
            [sort]<div class="sort">{sort}</div>[/sort]
            [/not-aviable]
            {info}
            [not-aviable=main]{content}[/not-aviable]
            [aviable=main]
            <div class="hblock">
                <div class="htitle">
                    <h3><a href="/lastnews/">Новое</a></h3>
                </div>
                {custom category="30" template="shortstory" aviable="global" from="0" limit="6" cache="no" order="date"}
                <div class="clear"></div>
                <div class="allnews"><a href="/lastnews/">Показать еще</a></div>
            </div>
            <div class="hblock">
                <div class="htitle">
                    <h3>Популярное</h3>
                    <span>за день</span>
                    <span>за неделю</span>                    
                    <span>за месяц</span>   
                </div>
                <div class="index-panel">
                    <div class="tt-panel">
                        {custom category="1-200" template="shortstory" aviable="global" from="0" limit="6" cache="no" days="1" order="date"}
                    </div>
                    <div class="tt-panel">
                        {custom category="1-200" template="shortstory" aviable="global" from="0" limit="6" cache="no" days="7" order="date"}
                    </div>
                    <div class="tt-panel">
                        {custom category="1-200" template="shortstory" aviable="global" from="0" limit="6" cache="no" days="30" order="date"}
                    </div>
                    <div class="clear"></div>
                </div>               
                <div class="clear"></div>
            </div>
            <div class="hblock">
                <div class="htitle">
                    <h3><a href="#">Спорт</a></h3>
                </div>
                {custom category="102" template="shortstory" aviable="global" from="0" limit="3" cache="no" order="date"}
                <div class="clear"></div>
            </div>
            <div class="hblock">
                <div class="htitle">
                    <h3><a href="#">Кулинария</a></h3>
                </div>
                {custom category="78" template="shortstory" aviable="global" from="0" limit="3" cache="no" order="date"}
                <div class="clear"></div>
            </div>
            <div class="hblock">
                <div class="htitle">
                    <h3><a href="#">Авто</a></h3>
                </div>
                {custom category="84" template="shortstory" aviable="global" from="0" limit="3" cache="no" order="date"}
                <div class="clear"></div>
            </div>
            <div class="hblock">
                <div class="htitle">
                    <h3><a href="#">Технологии</a></h3>
                </div>
                {custom category="10" template="shortstory" aviable="global" from="0" limit="3" cache="no" order="date"}
                <div class="clear"></div>
            </div>
            [/aviable]            
        </div>
        <div id="right">
            <div class="sideblock">
                <img src="{THEME}/images/rek300x250.jpg" alt="Реклама" />
            </div>
            [not-aviable=showfull]
            <div class="sideblock">
                <h4>Рекомендуем</h4>
                {custom category="30" template="custom-1" aviable="global" from="0" limit="10" cache="no" order="comments"}
            </div>
            [/not-aviable]
            [related-news]
            <div class="sideblock">
                <h4>Похожее</h4>
                {related-news}
            </div>
            [/related-news]
            <div class="sideblock">
                <h4>Популярные теги</h4>
                {tags}
            </div>
            <div class="sideblock">
                <!-- FaceBook Widget -->
                <div class="fb-like-box" data-href="https://www.facebook.com/facebookdevelopers" data-width="300" data-height="280" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
            </div>
            <div class="sideblock">    
                    <!-- VKontakte Widget -->                
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "250", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 20003922);
                    </script>
            </div>
        </div>
        <div class="clear"></div>                   
        <div class="rekbott">
            <img src="{THEME}/images/rek970x90.jpg" alt="Реклама" />
        </div>
        [aviable=main]            
        <div class="about">
            {include file="about.tpl"}
        </div>
        [/aviable]
    </div>
    <div class="footer">
        <div class="footer-left">
            <div class="logo">
                <img src="{THEME}/images/logo.png" alt="" />
            </div>
            {include file="social.tpl"}
        </div>
        <div class="footerblock">
            <div  class="ftmenu">
                <ul>
                    <li><a href="/index.php?do=feedback" title="Контакты">Написать нам</a></li>
                    <li><a href="#">Вакансии</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Реклама</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="ftext">
            Copyrights © 2013. Videochannel.ua - лучшие видео в интернете на любой вкус.<br />
            Электронная почта: <a href="mailto:email@videochannel.ua">email@videochannel.ua</a><br />
            Дизайн - <a href="http://sanderart.com/" title="Дизайн - SanderArt.com">SanderArt.com</a><!-- Не удалять эту строчку, если рассчитываете на поддержку -->
            </div>
        </div>                  
        <div class="clear"></div>
        <div class="counters">
                  <span><img src="{THEME}/images/88x31.png" alt="счетчик" /><!-- Просто картинка --></span>
                  <span><img src="{THEME}/images/88x31.png" alt="счетчик" /><!-- Просто картинка --></span>
                  <span><img src="{THEME}/images/88x31.png" alt="счетчик" /><!-- Просто картинка --></span>	
        </div>
    </div>
</div>

<!--[if IE 6]>
<a href="http://www.microsoft.com/rus/windows/internet-explorer/worldwide-sites.aspx" class="alert"></a>
<![endif]-->
<script>
    $(document).ready(function() {
    $('.hblock').ttabs();
    });
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>