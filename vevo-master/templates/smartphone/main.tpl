<!DOCTYPE html>
<html>
<head>
{headers}
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{THEME}/css/engine.css" rel="stylesheet">
<link href="{THEME}/css/style.css" rel="stylesheet">
<script src="{THEME}/js/libs.js" type="text/javascript"></script>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<script src="{THEME}/js/jquery.film_roll.js"></script>
<script src="{THEME}/js/jquery.touchSwipe.min.js"></script>
    
    
    
    <link href="http://vevo.uz/video-js.css" rel="stylesheet">
        <script src="http://vevo.uz/videojs-ie8.min.js"></script>

    
    
<script type="text/javascript">
var id_menu = new Array('sub_menu_1','sub_menu_2','sub_menu_3','sub_menu_4','sub_menu_5');
startList = function allclose() {
	for (i=0; i < id_menu.length; i++){
		document.getElementById(id_menu[i]).style.display = "none";
	}
}
function openMenu(id){
	for (i=0; i < id_menu.length; i++){
		if (id != id_menu[i]){
			document.getElementById(id_menu[i]).style.display = "none";
		}
	}
	if (document.getElementById(id).style.display == "block"){
		document.getElementById(id).style.display = "none";
	}else{
		document.getElementById(id).style.display = "block"; 
	}
}
window.onload=startList;
</script>
    
</head>
<body>
	{AJAX}
	
   
    <div id="toolbar">
       <center>
        <a href="/"><img src="/templates/vevo/images/logo.png"> </a>
       </center>
		<div id="in-toolbar">
			{login}  
			<a id="menu-btn">
				<span id="hamburger"></span>
			</a>
		</div> 
		<!-- Head Menu -->
		<nav id="menu-head">
            
            
            
            <div id="menu_body">
	<ul>
		<li><a href="#" onclick="openMenu('sub_menu_1');return(false)"> <img src="{THEME}/images/menupas.png"> Фильмы</a>
			<ul id="sub_menu_1">
			<li><a href="/films/uzfilms">Узбекские фильмы</a></li>
            <li><a href="/films/zarfilms">Зарубежные фильмы</a></li>
            <li><a href="/films/rusfilms">Русские Фильмы</a></li>
            <li><a href="/films/tarjima-kino-teledasturlar">Таржима кинолар</a></li>                
            <li><a href="/films/multfilm">Мультфильмы</a></li>
            <li><a href="/konsert">Концерты</a></li>
            <li><a href="/tarjima-kino-teledasturlar">ТВ дастурлар</a></li>
			</ul>
		</li>
		<li><a href="#" onclick="openMenu('sub_menu_2');return(false)"><img src="{THEME}/images/menupas.png"> Сериалы</a>
			<ul id="sub_menu_2">
				<li><a href="/serial/uzserial">Узбекские сериалы</a></li>
            <li><a href="/serial/russerial">Русские сериалы</a></li>
            <li><a href="/serial/turkserial">Турецкие сериалы</a></li>
            <li><a href="/serial/zarserial">Зарубежные сериалы</a></li>
            <li><a href="/serial/koreaserial">Корейские сериалы</a></li>
			</ul>
		</li>
		<li><a href="#" onclick="openMenu('sub_menu_3');return(false)"><img src="{THEME}/images/menupas.png"> Клипы</a>
			<ul id="sub_menu_3">
				 <li><a href="/clips/uzclips">Узбекские клипы </a></li>   
		<li><a href="/clips/rusclips">Русские клипы   </a></li>
		<li><a href="/clips/zarclips">Зарубежные клипы  </a></li>
		<li><a href="/clips/turkclips">Турецкие клипы </a></li>
			</ul>
		</li>
		<li><a href="#" onclick="openMenu('sub_menu_4');return(false)"><img src="{THEME}/images/menupas.png"> Песни</a>
			<ul id="sub_menu_4">
				<li><a href="/music/uzmp3">Узбекские песни</a></li> 
            <li><a href="/music/rusmp3">Русские песни</a></li>
            <li><a href="/music/zarmp3">Зарубежные песни</a></li>
            <li><a href="/music/turkmp3">Турецкие песни</a></li>
			</ul>
		</li>
		<li><a href="#" onclick="openMenu('sub_menu_5');return(false)"><img src="{THEME}/images/menupas.png"> Новости</a>
			<ul id="sub_menu_5">
				<li><a href="/news/newsmir">Новости мира</a></li>
            <li><a href="/news/shoubiznes">Шоу-бизнес</a></li> 
            <li><a href="/news/sport">Спорт</a></li> 
            <li><a href="/news/techno">Технология</a></li>
            <li><a href="/news/videonews">Интересные видео</a></li>
            <li><a href="/news/obzor-match">Обзор матчей</a></li>
			</ul>
		</li>
	</ul>
</div>
        
		</nav>
		<!-- Head Menu [E] -->
	</div>

	<header id="header">
		
        
     
        
        
		<form id="quicksearch" method="post" action=''>
			<input type="hidden" name="do" value="search">
			<input type="hidden" name="subaction" value="search">
			<div class="quicksearch">
				<input class="f_input" placeholder="Поиск по сайту..." name="story" value="" type="search">
				<button type="submit" title="Search" class="thd">Найти</button>
			</div>
		</form>
		</header>
    
    
	<section id="content">
		 [aviable=main]
        
       <script>
$(function() {
  fr = new FilmRoll({
    container: '#film_roll',
    height: 200
  });
});
</script>
        
        <br>
         <table width="100%">
            <tr>
            <td width="2%" valign="top">
       <img src="/templates/vevo/images/film.png" width="20" align="absmiddle"> 
            </td>
                
                
            <td width="48%" valign="top">
                 <b>Фильмы</b>
                </td>
                
            <td width="50%" valign="top" align="right">
    
    <a href="/films">показать все »</a>
            </td></tr> </table>
        
        <div id="film_roll">
 
        {custom category="1" template="film" aviable="main" from="0" limit="30" cache="no"}
             
</div>
        
        
          <script>
$(function() {
  fr = new FilmRoll({
    container: '#serial_roll',
    height: 200
  });
});
</script>
        
            <br>
         <table width="100%">
            <tr>
            <td width="50%" valign="top">
       <img src="/templates/vevo/images/film.png" width="20" align="absmiddle">  <b>Сериалы</b>
            </td>
            <td width="50%" valign="top" align="right">
    
    <a href="/serial">показать все »</a>
            </td></tr> </table>
        
        <div id="serial_roll">
 
        {custom category="122,124,125,277,289,293" template="serial" aviable="main" from="0" limit="30" cache="no"}
             
</div>
        
           <script>
$(function() {
  fr = new FilmRoll({
    container: '#tar_roll',
    height: 200
  });
});
</script>
        
        <br>
         <table width="100%">
            <tr>
            <td width="2%" valign="top">
       <img src="/templates/vevo/images/film.png" width="20" align="absmiddle"> 
            </td>
                
                
            <td width="48%" valign="top">
                 <b>Таржима кино ва ТВ дастурлар</b>
                </td>
                
            <td width="50%" valign="top" align="right">
    
    <a href="/films/tarjima-kino-teledasturlar">показать все »</a>
            </td></tr> </table>
        
        <div id="tar_roll">
 
        {custom category="297" template="film" aviable="main" from="0" limit="30" cache="no"}
             
</div>
        
          <script>
$(function() {
  fr = new FilmRoll({
    container: '#clip_roll',
    height: 140
  });
});
</script>
        
            <br>
         <table width="100%">
            <tr>
            <td width="50%" valign="top">
       <img src="/templates/vevo/images/clip.png" width="20" align="absmiddle">  <b>Клипы</b>
            </td>
            <td width="50%" valign="top" align="right">
    
    <a href="/clips">показать все »</a>
            </td></tr> </table>
        
        <div id="clip_roll">
 
        {custom category="34-40" template="clip" aviable="main" from="0" limit="30" cache="no"}
             
</div>
        
        
        <br>
        
           <table width="100%">
            <tr>
            <td width="50%" valign="top">
       <img src="{THEME}/images/music.png" width="20" align="absmiddle">  <b>Новые песни</b>
            </td>
            <td width="50%" valign="top" align="right">
    
    <a href="/music">показать все »</a>
            </td></tr> </table>
      
       
          {custom category="2,42,278,279,43" template="mp3" aviable="main" from="0" limit="15" cache="no"}  
       
        <br>
     
        
        
        
        
      <script>
$(function() {
  fr = new FilmRoll({
    container: '#day_roll',
    height: 140
  });
});
</script>
     
         <table width="100%">
            <tr>
            <td width="2%" valign="top">
       <img src="/templates/vevo/images/film.png" width="20" align="absmiddle"> 
            </td>
                
                
            <td width="48%" valign="top">
                 <b>Обзор матчей</b>
                </td>
                
            <td width="50%" valign="top" align="right">
    
    <a href="/news/obzor-match/">показать все »</a>
            </td></tr> </table>
        
        <div id="day_roll">
 
        {custom category="283" template="clip" aviable="main" from="0" limit="30" cache="no"}
             
</div>
        
        
        
        
        <table width="100%">
            <tr>
            <td width="50%" valign="top">
       <img src="/templates/vevo/images/news.png" width="20" align="absmiddle">  <b>Новости</b>
            </td>
            <td width="50%" valign="top" align="right">
    
    <a href="/news">показать все »</a>
            </td></tr> </table>
        
          {custom category="264,266,268,280,281" template="news" aviable="main" from="0" limit="5" cache="no"}
        
        
        
        
       [/aviable]  
        
        [category=1,74,76,100,116,117,102-106,108,113,291]
         [not-aviable=showfull]
           <script>
$(function() {
  fr = new FilmRoll({
    container: '#f_roll',
    height: 50
  });
});
</script>
        
     
        <div id="f_roll" >
 
      <a href="/films/uzfilms" class="catf"><center>Узбекские фильмы</center></a>
            <a href="/films/zarfilms" class="catf"><center>Зарубежные фильмы</center></a>
            <a href="/films/rusfilms" class="catf"><center>Русские Фильмы</center></a>
            <a href="/films/multfilm" class="catf"><center>Мультфильмы</center></a>
            <a href="/films/drama" class="catf"><center>Драма</center></a>
            <a href="/films/melodrama" class="catf"><center>Мелодрама</center></a>                
            <a href="/films/comedy" class="catf"><center>Комедии</center></a>
            <a href="/films/ujas" class="catf"><center>Ужасы</center></a>           
            <a href="/films/boevik" class="catf"><center>Боевики</center></a>
            <a href="/films/biografiya" class="catf"><center>Биография</center></a>                
            <a href="/films/triller"class="catf"><center>Триллеры</center></a>
            <a href="/films/prik"class="catf"><center>Приключения</center></a>
            <a href="/films/kriminal"class="catf"><center>Криминал</center></a>
            <a href="/films/detektiv"class="catf"><center>Детектив</center></a>
            <a href="/films/dokumentalniy"class="catf"><center>Документальный</center></a>
            <a href="/films/fantastika"class="catf"><center>Фантастика</center></a>
            <a href="/films/voennie"class="catf"><center>Военные</center></a>
            <a href="/films/semeynie"class="catf"><center>Семейные</center></a>
            <a href="/films/sportivniye"class="catf"><center>Спортивные</center></a> 
</div><br>
          <div class="clr">
        [/not-aviable]
        [/category] 
              
              
              
              
              
               [category=122,124,125,277,289]
         [not-aviable=showfull]
           <script>
$(function() {
  fr = new FilmRoll({
    container: '#s_roll',
    height: 50
  });
});
</script>
        
     
        <div id="s_roll">
 
    	    <a href="/serial/uzserial/" class="catf"><center>Узбекские сериалы</center></a>
            <a href="/serial/zarserial/" class="catf"><center>Зарубежные сериалы</center></a>
            <a href="/serial/turkserial/" class="catf"><center>Турецкие сериалы</center></a>
            <a href="/serial/russerial/" class="catf"><center>Русские сериалы</center></a>
            <a href="/serial/koreaserial/" class="catf"><center>Корейские сериалы</center></a>
    
</div><br>
          <div class="clr">
        [/not-aviable]
        [/category] 
              
              
              
              
              
              [category=2,278,279,42,43,4-33]
         [not-aviable=showfull]
           <script>
$(function() {
  fr = new FilmRoll({
    container: '#m_roll',
    height: 50
  });
});
</script>
        
     
        <div id="m_roll" >
 
          <a href="/music/0-9" class="alfabit"><center>0-9</center></a>
            <a href="/music/a" class="alfabit"><center>A</center></a>
            <a href="/music/b" class="alfabit"><center>B</center></a>
            <a href="/music/c" class="alfabit"><center>C</center></a>
            <a href="/music/d" class="alfabit"><center>D</center></a>
            <a href="/music/e" class="alfabit"><center>E</center></a>
            <a href="/music/f" class="alfabit"><center>F</center></a>
            <a href="/music/g" class="alfabit"><center>G</center></a>
            <a href="/music/h" class="alfabit"><center>H</center></a>
            <a href="/music/i" class="alfabit"><center>I</center></a>
            <a href="/music/j" class="alfabit"><center>J</center></a>
            <a href="/music/k" class="alfabit"><center>K</center></a>
            <a href="/music/l" class="alfabit"><center>L</center></a>
            <a href="/music/m" class="alfabit"><center>M</center></a>
            <a href="/music/n" class="alfabit"><center>N</center></a>
            <a href="/music/o" class="alfabit"><center>O</center></a>
            <a href="/music/p" class="alfabit"><center>P</center></a>
            <a href="/music/q" class="alfabit"><center>Q</center></a>
            <a href="/music/r" class="alfabit"><center>R</center></a>
            <a href="/music/s" class="alfabit"><center>S</center></a>
            <a href="/music/t" class="alfabit"><center>T</center></a>
            <a href="/music/u" class="alfabit"><center>U</center></a>
            <a href="/music/v" class="alfabit"><center>V</center></a>
            <a href="/music/w" class="alfabit"><center>W</center></a>
            <a href="/music/x" class="alfabit"><center>X</center></a>
            <a href="/music/y" class="alfabit"><center>Y</center></a>
            <a href="/music/z" class="alfabit"><center>Z</center></a>
            <a href="/music/o_" class="alfabit"><center>O'</center></a>
            <a href="/music/g_" class="alfabit"><center>G'</center></a>
            <a href="/music/sh" class="alfabit"><center>SH</center></a>
            <a href="/music/ch" class="alfabit"><center>CH</center></a>
</div><br>
          <div class="clr">
        [/not-aviable]
        [/category] 
              
        
              
              
              
              
                 [category=34.292,35-40]
         [not-aviable=showfull]
           <script>
$(function() {
  fr = new FilmRoll({
    container: '#c_roll',
    height: 50
  });
});
</script>
        
     
        <div id="c_roll">
 
            <a href="/konsert" class="catf"><center>Концерты</center></a>
    	    <a href="/clips/uzclips/" class="catf"><center>Узбекские клипы</center></a>
            <a href="/clips/zarclips/" class="catf"><center>Зарубежные клипы</center></a>
            <a href="/clips/turkclips/" class="catf"><center>Турецкие клипы</center></a>
            <a href="/clips/rusclips/" class="catf"><center>Русские клипы</center></a>
            <a href="/clips/hindclips/" class="catf"><center>Индийские клипы</center></a>
            <a href="/clips/arabclips/" class="catf"><center>Арабские клипы</center></a>
    
</div><br>
          <div class="clr">
        [/not-aviable]
        [/category] 
              
              
        
        [not-aviable=main]
        {info}
		{content}
        [/not-aviable]
	</section>
    
    <div class="clr" >
        
	<div id="footmenu">
		<h3>© VEVO.UZ — NEW AND HIGH QUALITY</h3>
		<nav class="main-nav">
			
			<span class="nav-sep"></span>
		
			
			<a href="/">Главная страница</a>  
            <a href="http://vevo.uz/svyaz-s-nami.html">Обратная связь</a>    
            <a href="http://vevo.uz/sayt-yaratib-beramiz.html">Сайт яратамиз</a>
			<a href="/index.php?action=mobiledisable">Полная версия сайта</a>
		</nav>
        
        <br>
        <center>
        <!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t21.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: son 24 saat iзin gцzden"+
" geзirmelerin, son 24 saat ve bugьn iзinziyaretзilerin sayэsэ' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet-->

          
            <!-- START WWW.UZ TOP-RATING --><SCRIPT language="javascript" type="text/javascript">
<!--
top_js="1.0";top_r="id=38601&r="+escape(document.referrer)+"&pg="+escape(window.location.href);document.cookie="smart_top=1; path=/"; top_r+="&c="+(document.cookie?"Y":"N")
//-->
</SCRIPT>
<SCRIPT language="javascript1.1" type="text/javascript">
<!--
top_js="1.1";top_r+="&j="+(navigator.javaEnabled()?"Y":"N")
//-->
</SCRIPT>
<SCRIPT language="javascript1.2" type="text/javascript">
<!--
top_js="1.2";top_r+="&wh="+screen.width+'x'+screen.height+"&px="+
(((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth)
//-->
</SCRIPT>
<SCRIPT language="javascript1.3" type="text/javascript">
<!--
top_js="1.3";
//-->
</SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript">
<!--
top_rat="&col=F7AE00&t=ffffff&p=0E418F";top_r+="&js="+top_js+"";document.write('<a href="http://www.uz/ru/res/visitor/index?id=38601" target=_top><img src="http://cnt0.www.uz/counter/collect?'+top_r+top_rat+'" width=88 height=31 border=0 alt="Топ рейтинг www.uz"></a>')//-->
</SCRIPT><NOSCRIPT><A href="http://www.uz/ru/res/visitor/index?id=38601" target=_top><IMG height=31 src="http://cnt0.www.uz/counter/collect?id=38601&pg=http%3A//uzinfocom.uz&&col=F7AE00&amp;t=ffffff&amp;p=0E418F" width=88 border=0 alt="Топ рейтинг www.uz"></A></NOSCRIPT><!-- FINISH WWW.UZ TOP-RATING -->         
            
        <a href="http://vevo.uz/sayt-yaratib-beramiz.html"><img src="/templates/vevo/images/mzed.png"></a>
        </center>
        
	</div>
	
	<script type="text/javascript">
	// <![CDATA[
		(function(doc) {

		var addEvent = 'addEventListener',
		type = 'gesturestart',
		qsa = 'querySelectorAll',
		scales = [1, 1],
		meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

		function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
		}

		if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
		}

		}(document));
	// ]]>
	</script>
</body>
</html>