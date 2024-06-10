{poll}
<div class="box-out margin">
    <div class="news-head">
        <div class="news-title">
           <table width="100%">
               <tr>
                   <td width="60%">
            <b>{title}</b>
                   </td>
                    <td width="40%" align="right" style="font-size: 12px;">
        
         <img src="{THEME}/images/view.png" align="absmiddle" width=15> {views}
        <img src="{THEME}/images/com.png" align="absmiddle"  width=15> {comments-num}
        <img src="{THEME}/images/time.png" align="absmiddle"  width=15> {date} 
           </td>
               </tr>
            </table>
        
        </div>

    </div>

    <div class="news-text">
        
            
        <a href="/">Главная</a> / {link-category} / {title}
        
        
        <br><br>
        <table width="100%">
            <tr>
                
                
               
                <td width="75%" align="right">
                 <b> [xfgiven_timekino] [xfvalue_timekino] мин.[/xfgiven_timekino] </b> &nbsp;&nbsp;&nbsp; 
                    [xfgiven_quality] <img src="[xfvalue_quality]" align="absmiddle"> [/xfgiven_quality]
             &nbsp; 
                </td>
                <td width="2%" >
      </td>
                <td width="23%"  >
 {rating}
                </td>
            </tr>
        </table>
    
         
           
                 <table width="100%">
            <tr>
                <td width="25%"  valign="top">
              <img src="{image-1}" width="180px" height="250px">
                    
                </td>
                <td width="75%" valign="top">
                   
                      <table width="100%">
            <tr>
                
                
                <td width="15%" valign="top">
                <b>  Режиссеры:  </b>
                </td>
                <td width="85%" valign="top">
                      [xfgiven_rejisser] [xfvalue_rejisser] [/xfgiven_rejisser]<br>
              
                </td>
            </tr>
        </table>
        <br>
                    
          <table width="100%">
            <tr>
                <td width="15%" valign="top">
                 <b> В ролях:</b>  
                </td>
                <td width="85%" valign="top">
 [xfgiven_actors] [xfvalue_actors] [/xfgiven_actors]<br>
              
                </td>
            </tr>
        </table>
                    
               <br>               
          <table width="100%">
            <tr>
                <td width="15%" valign="top">
                    <b>Описание:</b>
                </td>
                <td width="85%" valign="top">

                    [xfgiven_opisanie]
     [xfvalue_opisanie] [/xfgiven_opisanie]

                </td>
            </tr>
        </table>
                   <br>  
                    <table width="100%">
            <tr>
                <td width="15%" valign="top">
                    <b>Озвучка:</b><br>
                     <b>Страна:</b><br>
                    <b>Год:</b>
                </td>
                <td width="45%" valign="top">

                 [xfgiven_ozvuchka] [xfvalue_ozvuchka] [/xfgiven_ozvuchka]<br>
                         [xfgiven_strana] [xfvalue_strana] [/xfgiven_strana]<br>
                         [xfgiven_year] [xfvalue_year] [/xfgiven_year]
                    </td>
 				<td width="40%" valign="top">
                      <center>    [xfgiven_filmdown] <a href="[xfvalue_filmdown]" class="downmp3"></a> [/xfgiven_filmdown] 
                    </center>
                 </td>
                
            </tr>
        </table>
                    
               
                    
                    
            
                </td>
            </tr>
        </table>
    
                
        [xfgiven_trailer]<hr><a href="trailer"  class="trailer" rel="insert2"><center>Трейлер 1</center></a>[/xfgiven_trailer]
        [xfgiven_trailer2]<a href="trailer2" class="trailer" rel="insert2"><center>Трейлер 2</center></a>[/xfgiven_trailer2]
        
           <br>  
        
        <div id="insert2"></div>
        
        
         <script>
        var trailer = '<br>[xfgiven_trailer]<video width="800px" height="400px"  preload="metadata" controls="controls"><source src="[xfvalue_trailer]"></source></video>[/xfgiven_trailer]';  
   		var trailer2 = '<br>[xfgiven_trailer2]<video width="800px" height="400px"  preload="metadata" controls="controls"><source src="[xfvalue_trailer2]"></source></video>[/xfgiven_trailer2]';  
   
      $(function() {
        var insert = $('#insert2');
        $('a[rel="insert2"]').click(function() {
          var a = $(this).attr('href');
          insert.css('display', 'none').html(window[a]).fadeIn(300);
          return false;
        });
      });
    </script>
        
         <div class="clear"></div>
      <br>   
        <br>
      [xfgiven_screen2]   Скриншоты из фильма:
        <hr>
        [/xfgiven_screen2]
            <table width="100%">
            <tr>    
                
                 <td width="25%">
                     [xfgiven_screen1]  
               
<img src="[xfvalue_screen1]" style="border-radius: 10px;" height="120" width="180">[/xfgiven_screen1] 
                </td>
       
         <td width="25%" >
                     [xfgiven_screen2]  
               
<img src="[xfvalue_screen2]" style="border-radius: 10px;" height="120" width="180">[/xfgiven_screen2] 
                </td>
             <td width="25%" >
                     [xfgiven_screen3]  
               
<img src="[xfvalue_screen3]" style="border-radius: 10px;" height="120" width="180">[/xfgiven_screen3] 
                </td>
                 <td width="25%">
                     [xfgiven_screen4]  
               
<img src="[xfvalue_screen4]" style="border-radius: 10px;" height="120" width="180">[/xfgiven_screen4] 
                </td>
                
            </tr>
        </table>
        
        

        <br><br>
        
    
        <table width="100%">
            <tr>    
                
                <td width="25%">
                   
             </td>
         <td width="50%" align="center">
                    Поделитесь с друзьями:<br>
        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram"></div>
        
               </td>
             <td width="25%" align="right">
                 <img src="{THEME}/images/profile2.png" align="absmiddle" > &nbsp;{author} &nbsp;&nbsp;&nbsp;&nbsp;
         
               </td>
               
            </tr>
        </table>
        
        
    </div>
</div>



<!--
[related-news]
<div class="relnews-area">
    <h2>Также рекомендуем:</h2>
    <ul class="relnews">{related-news}</ul>
</div>
[/related-news]-->

	[group=5]
	<div class="clr berrors">
		Уважаемый посетитель, Вы зашли на сайт как незарегистрированный пользователь.<br />
		Мы рекомендуем Вам <a href="/index.php?do=register">зарегистрироваться</a> либо войти на сайт под своим именем.
	</div>
	[/group]


{addcomments}

{comments}
{navigation}

<br><br>Теги:{tags}