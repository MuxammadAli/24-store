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

          <table width="100%">
            <tr>
                
                 <td width="30%" align="center">
                    
                    
                
                     [xfgiven_screen] 
<img src="[xfvalue_screen]" style="border-radius: 10px;" width="180"> [/xfgiven_screen]
             
                   
                </td>
                
                
                
                
                <td width="65%"  align="center">
                    
      {rating}
                  <br><br>
               [xfgiven_mp3down]<a href="[xfvalue_mp3down]" class="downmp3">  </a> [/xfgiven_mp3down] 
 
            
                
                </td>
            
                 <td width="5%" valign="top" align="center">
                    
               
                   
                </td>
                
                
            </tr>
        </table>
        
        <br><br>
         [xfgiven_mp3down]      
                 <audio width="810" controls="control" preload="none" src="[xfvalue_mp3down]"></audio>
                    [/xfgiven_mp3down]
        
        <br><br>
        
        <div class="grey_box">
                        <div class="sb_info">
                            <div class="lclmn">
                                <div class="sb_item">
                                    <strong class="sb_icon icon-song" title="Формат"></strong>
                                    <b>MP3</b>
                                </div>
                                <div class="sb_item">
                                    <strong class="sb_icon icon-size" title="Размер"></strong>
                                    <b>[xfgiven_mp3joy] [xfvalue_mp3joy] [/xfgiven_mp3joy]</b> МБ
                                </div>
                                <div class="sb_item">
                                    <strong class="sb_icon icon-bitrate" title="Битрейт"></strong>
                                    <b>[xfgiven_mp3bit] [xfvalue_mp3bit] [/xfgiven_mp3bit]</b> кбит/c
                                </div>
                                <div class="sb_item">
                                    <strong class="sb_icon icon-time" title="Длительность"></strong>
                                    <b>[xfgiven_mp3time] [xfvalue_mp3time] [/xfgiven_mp3time] </b>
                                    <meta itemprop="duration" content="PT3M26S"/>
                                    
                                 &nbsp;  <img src="{THEME}/images/papka111.png" align="absmiddle">  {link-category}
                                </div>
                            </div>
                            <div class="rclmn">
                                <div class="sb_item">
                                    <meta itemprop="interactionCount" content="UserPlays:621170"/>
                                    <strong class="sb_icon icon-downl" data-tool="tooltip" title="Скачиваний"></strong>
                                    <b>{views}</b>
                                </div>
                            </div>
                        </div>
                    </div>


 

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


<div class="box-out margin">
 <div class="news-head">
        <div class="news-title">Другие песни</div>
       
      
    </div>
  <div class="news-text">
[related-news]
{related-news}

[/related-news]       
        
    </div> </div>




	[group=5]
	<div class="clr berrors">
		Уважаемый посетитель, Вы зашли на сайт как незарегистрированный пользователь.<br />
		Мы рекомендуем Вам <a href="/index.php?do=register">зарегистрироваться</a> либо войти на сайт под своим именем.
	</div>
	[/group]


{addcomments}

{comments}
{navigation}