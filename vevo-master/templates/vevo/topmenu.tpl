<div class="menucat">
   

    <ul class="drop-menu-main">
        
        <li>
            <span class="drop-down">������ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">

                <span class="title"></span>
            <a href="/films/uzfilms">��������� ������</a>
            <a href="/films/zarfilms">���������� ������</a>
            <a href="/films/rusfilms">������� ������</a>
            <a href="/films/tarjima-kino-teledasturlar">������� �������</a>
            <a href="/films/multfilm">�����������</a>
                <!---
            <a href="/films/drama">�����</a>
            <a href="/films/melodrama">���������</a>                
            <a href="/films/comedy">�������</a>
            <a href="/films/ujas">�����</a>           
            <a href="/films/boevik">�������</a>
            <a href="/films/biografiya">���������</a>                
            <a href="/films/triller">��������</a>
            <a href="/films/prik">�����������</a>
            <a href="/films/kriminal">��������</a>
            <a href="/films/detektiv">��������</a>
            <a href="/films/dokumentalniy">��������������</a>
            <a href="/films/fantastika">����������</a>
            <a href="/films/voennie">�������</a>
            <a href="/films/semeynie">��������</a>
            <a href="/films/sportivniye">����������</a>
                --->
            </div>
        </li>
        <li>
            <span class="drop-down">������� <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/serial/uzserial">��������� �������</a>
            <a href="/serial/russerial">������� �������</a>
            <a href="/serial/turkserial">�������� �������</a>
            <a href="/serial/zarserial">���������� �������</a>
            <a href="/serial/koreaserial">��������� �������</a>
            </div>
        </li>
        <li>
            <span class="drop-down">������ <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/music/uzmp3">���������</a> 
            <a href="/music/rusmp3">�������</a> 
            <a href="/music/zarmp3">����������</a>
            <a href="/music/turkmp3">��������</a>
            </div>
        </li>
        
          <li>
            <span class="drop-down">����� <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
             
		<a href="/clips/uzclips">��������� ����� </a>    
		<a href="/clips/rusclips">������� �����   </a>
		<a href="/clips/zarclips">���������� �����  </a>   
		<a href="/clips/turkclips">�������� ����� </a>
		<a href="/konsert">�������� </a>
		<a href="/tarjima-kino-teledasturlar">�� ���������</a>                
      </div>
        </li>
        
         <li>
            <span class="drop-down">������� <span class="arrow">&#9660;</span></span>

            <div class="drop-menu-main-sub">
                <span class="title"></span>
            <a href="/news/newsmir">������� ����</a>
            <a href="/news/shoubiznes">���-������</a> 
            <a href="/news/sport">�����</a> 
            <a href="/news/techno">����������</a>
            <a href="/news/videonews">���������� �����</a>
            <a href="/news/obzor-match">����� ������</a>
            </div>
        </li>
        <!--
        <li><a href="/index.php?do=orderdesc"><img src="{THEME}/images/korzinka.png" align="absmiddle"> ���� �������</a></li>
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
        <input class="ser-text" id="story" name="story" placeholder="����� �� �����..." value="" type="text" />
        <input type="submit" class="ser-but" alt="�����" title="�����" value="" />
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





