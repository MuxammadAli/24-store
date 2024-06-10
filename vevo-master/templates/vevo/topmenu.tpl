<div class="menucat">
   

    <ul class="drop-menu-main">
        
        <li>
            <span class="drop-down">ФИЛЬМЫ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">

                <span class="title"></span>
            <a href="/films/uzfilms">Узбекские фильмы</a>
            <a href="/films/zarfilms">Зарубежные фильмы</a>
            <a href="/films/rusfilms">Русские Фильмы</a>
            <a href="/films/tarjima-kino-teledasturlar">Таржима кинолар</a>
            <a href="/films/multfilm">Мультфильмы</a>
                <!---
            <a href="/films/drama">Драма</a>
            <a href="/films/melodrama">Мелодрама</a>                
            <a href="/films/comedy">Комедии</a>
            <a href="/films/ujas">Ужасы</a>           
            <a href="/films/boevik">Боевики</a>
            <a href="/films/biografiya">Биография</a>                
            <a href="/films/triller">Триллеры</a>
            <a href="/films/prik">Приключения</a>
            <a href="/films/kriminal">Криминал</a>
            <a href="/films/detektiv">Детектив</a>
            <a href="/films/dokumentalniy">Документальный</a>
            <a href="/films/fantastika">Фантастика</a>
            <a href="/films/voennie">Военные</a>
            <a href="/films/semeynie">Семейные</a>
            <a href="/films/sportivniye">Спортивные</a>
                --->
            </div>
        </li>
        <li>
            <span class="drop-down">СЕРИАЛЫ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/serial/uzserial">Узбекские сериалы</a>
            <a href="/serial/russerial">Русские сериалы</a>
            <a href="/serial/turkserial">Турецкие сериалы</a>
            <a href="/serial/zarserial">Зарубежные сериалы</a>
            <a href="/serial/koreaserial">Корейские сериалы</a>
            </div>
        </li>
        <li>
            <span class="drop-down">МУЗЫКА <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/music/uzmp3">Узбекские</a> 
            <a href="/music/rusmp3">Русские</a> 
            <a href="/music/zarmp3">Зарубежные</a>
            <a href="/music/turkmp3">Турецкие</a>
            </div>
        </li>
        
          <li>
            <span class="drop-down">КЛИПЫ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
             
		<a href="/clips/uzclips">Узбекские клипы </a>    
		<a href="/clips/rusclips">Русские клипы   </a>
		<a href="/clips/zarclips">Зарубежные клипы  </a>   
		<a href="/clips/turkclips">Турецкие клипы </a>
		<a href="/konsert">Концерты </a>
		<a href="/tarjima-kino-teledasturlar">ТВ дастурлар</a>                
      </div>
        </li>
        
         <li>
            <span class="drop-down">НОВОСТИ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/news/newsmir">Новости мира</a>
            <a href="/news/shoubiznes">Шоу-бизнес</a> 
            <a href="/news/sport">Спорт</a> 
            <a href="/news/techno">Технология</a>
            <a href="/news/videonews">Интересные видео</a>
            <a href="/news/obzor-match">Обзор матчей</a>
            </div>
        </li>
        <!--
        <li><a href="/index.php?do=orderdesc"><img src="{THEME}/images/korzinka.png" align="absmiddle"> СТОЛ ЗАКАЗОВ</a></li>
    -->
</ul>
</div>




<div class="menucat" style="margin-left: 91%;">
   

    <ul class="drop-menu-main">
        
        <li>
           {login}
        </li>
    
       
    </ul>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        function hideallDropdowns() {
            $(".dropped .drop-menu-main-sub").hide();
            $(".dropped").removeClass('dropped');
            $(".dropped .drop-menu-main-sub .title").unbind("click");
        }

        function showDropdown(el) {
            var el_li = $(el).parent().addClass('dropped');
            el_li
                .find('.title')
                .click(function () {
                    hideallDropdowns();
                })
                .html($(el).html());

            el_li.find('.drop-menu-main-sub').show();
        }

        $(".drop-down").click(function(){
            showDropdown(this);
        });

        $(document).mouseup(function () {
            hideallDropdowns();
        });
    });
</script>



<div style="margin-left: 73%;">

  <form id="searchbar" method="post" action=''>
        <input type="hidden" name="do" value="search" />
        <input type="hidden" name="subaction" value="search" />
        <input class="ser-text" id="story" name="story" placeholder="Поиск по сайту..." value="" type="text" />
        <input type="submit" class="ser-but" alt="Найти" title="Найти" value="" />
    </form>

</div>



<div id="header">

    <table width="100%">
    <tr>
        
         <td width="3%" align="right">
   
    </td>
        
    <td width="27%" align="right">
   <a id="logo" href="/" class="logotip"></a>
    </td>
        
        
        
        
        
       <td width="45%">  

           
           
</td>
     
     <td width="15%" align="center">
  
        </td>
        
        
        
        <td width="10%" align="center">
    
           
        </td>
        
        </tr>
    </table>
</div>





