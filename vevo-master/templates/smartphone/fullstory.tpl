{poll}
<article class="post fullstory">
    <h1 class="title"><b>{title}</b> [xfgiven_quality] <img src="[xfvalue_quality]" height="15" align="absmiddle"> [/xfgiven_quality]</h1>
	<ul class="post-info">
		<li class="iauthor ico">[profile]<b>{login}</b>[/profile]</li>
		<li class="idate ico">{date}</li>
		<li class="iviews ico">{views}</li>
	</ul>
	<p class="icat ico">{link-category}</p>
	<div class="post-cont clrfix">
		
        
        
    
    
         
            <center>  <img src="{image-1}" width="200px" height="300px">
                 </center>    
                 <br>
                <b>  Режиссеры:  </b>
             
                      [xfgiven_rejisser] [xfvalue_rejisser] [/xfgiven_rejisser]<br>
              
              
        <br>
                    
         
                 <b> В ролях:</b>  
               
 [xfgiven_actors] [xfvalue_actors] [/xfgiven_actors]<br>
              
               
               <br>               
          
                    <b>Описание:</b>
               
                    [xfgiven_opisanie]
     [xfvalue_opisanie] [/xfgiven_opisanie]

             
                   <br>  <br>  
                  
                    <b>Озвучка:</b>  [xfgiven_ozvuchka] [xfvalue_ozvuchka] [/xfgiven_ozvuchka]<br>
                     <b>Страна:</b> [xfgiven_strana] [xfvalue_strana] [/xfgiven_strana]<br>
                    <b>Год:</b>  [xfgiven_year] [xfvalue_year] [/xfgiven_year]<br>
                   <b>Длительность:</b> [xfgiven_timekino] [xfvalue_timekino] мин.[/xfgiven_timekino]<br>
                
        
        
        
                <br>
        
        Смотреть онлайн фильм "{title}":
        <hr>
        
         <div style="height:200px; width:100%;">
            [xfgiven_filmdown] 
<center><video id="my-video" class="video-js" controls preload="auto" width="300px" height="195px"
  poster="{image-1}" data-setup="{}">
    <source src="[xfvalue_filmdown]" type='video/mp4'>
    <source src="[xfvalue_filmdown]" type='video/webm'>
  </video>
  <script src="http://vevo.uz/video.js"></script>
				</center>
                       [/xfgiven_filmdown]
      
        
    </div>
        
         <br>
                      
                      <center>    [xfgiven_filmdown] <a href="[xfvalue_filmdown]" class="downmp3"></a> [/xfgiven_filmdown] 
                    </center>
      <br> 
         [xfgiven_trailer]<hr><a href="trailer"  class="trailer" rel="insert2"><center>Трейлер 1</center></a>[/xfgiven_trailer]
        [xfgiven_trailer2]<a href="trailer2" class="trailer" rel="insert2"><center>Трейлер 2</center></a>[/xfgiven_trailer2]
        
           <br>  
        
        <div id="insert2"></div>
        
        
         <script>
        var trailer = '<br>[xfgiven_trailer]<video width="100%" height="200px"  preload="metadata" controls="controls"><source src="[xfvalue_trailer]"></source></video>[/xfgiven_trailer]';  
   		var trailer2 = '<br>[xfgiven_trailer2]<video width="100%" height="200px"  preload="metadata" controls="controls"><source src="[xfvalue_trailer2]"></source></video>[/xfgiven_trailer2]';  
   
      $(function() {
        var insert = $('#insert2');
        $('a[rel="insert2"]').click(function() {
          var a = $(this).attr('href');
          insert.css('display', 'none').html(window[a]).fadeIn(300);
          return false;
        });
      });
    </script>
        <br> <br>
        Скриншоты из фильма:
        <hr>
    
            <table width="100%">
            <tr>    
                
                 <td width="25%"align="center">
                     [xfgiven_screen1]  
               
<img src="[xfvalue_screen1]" style="border-radius: 10px;" height="100" width="140">[/xfgiven_screen1] 
                </td>
       
         <td width="25%" align="center">
                     [xfgiven_screen2]  
               
<img src="[xfvalue_screen2]" style="border-radius: 10px;" height="100" width="140">[/xfgiven_screen2] 
                </td>
           
                
            </tr>
        </table>
        
        
        
         <table width="100%" align="center">
            <tr>    
                
              
             <td width="25%" align="center">
                     [xfgiven_screen3]  
               
<img src="[xfvalue_screen3]" style="border-radius: 10px;" height="100" width="140">[/xfgiven_screen3] 
                </td>
                 <td width="25%"align="center">
                     [xfgiven_screen4]  
               
<img src="[xfvalue_screen4]" style="border-radius: 10px;" height="100" width="140">[/xfgiven_screen4] 
                </td>
                
            </tr>
        </table>
        
        

        <br>
        
    
        <center>
                    Поделитесь с друзьями:<br>
        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram"></div>
        
        </center>
        
        
        
	</div>
</article>

<div class="box commentbox">
	<h3>Комментарии ({comments-num})</h3>
	[comments]{comments}[/comments]
</div>