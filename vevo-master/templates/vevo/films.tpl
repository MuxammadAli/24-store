[aviable=main]



<div id="contentfilm">

                
<div class="slider1 wow fadeInUp">
    <script type="text/javascript" src="{THEME}/js/jquery.bxSlider.min.js"></script>
<script>
	var $ = jQuery.noConflict();

	jQuery(document).ready(function() {
		var browser_viewport_width = jQuery(window).width();
		var item_width = parseInt(172)
		item_width += -40;  
     	var nr_of_slides = parseInt(browser_viewport_width / item_width) + 1;
		var nr_of_elements_to_scroll = 1;
		var carousel_slider = $('#big_carousel1').bxSlider({
        	displaySlideQty: nr_of_slides,
			moveSlideQty: nr_of_elements_to_scroll,
			speed: 300,
			controls: false
			
    	});

		$('#big_carousel_prev1').click(function(){
			carousel_slider.goToPreviousSlide();
			return false;
		});
		
		$('#big_carousel_next1').click(function(){
			carousel_slider.goToNextSlide();
			return false;
		});
	});
</script>
    
   
    
<div id="slider1">
    
    <div class="slider1_tittle">
    
    <table width="100%">
            <tr>
            <td width="50%">
       <img src="{THEME}/images/film.png" align="center">  <b>Фильмы</b>
            </td>
            <td width="50%" align="right">
    
    <a href="/films">показать все »</a>
            </td></tr> </table>
    </div>
    <div id="big_carousel_wrapper1">
        <ul id="big_carousel1">
           {custom category="1" template="film" aviable="main" from="0" limit="70" cache="no"}
        </ul>
    </div>
	<a id="big_carousel_prev1" href="#">prev</a>
	<a id="big_carousel_next1" href="#">next</a>
</div></div></div>





<div id="contentmult">

 <div class="slider1 wow fadeInUp">
<script>
	var $ = jQuery.noConflict();

	jQuery(document).ready(function() {
		var browser_viewport_width = jQuery(window).width();
		var item_width = parseInt(172)
		item_width += -40;  
     	var nr_of_slides = parseInt(browser_viewport_width / item_width) + 1;
		var nr_of_elements_to_scroll = 1;
		var carousel_slider = $('#big_carousel2').bxSlider({
        	displaySlideQty: nr_of_slides,
			moveSlideQty: nr_of_elements_to_scroll,
			speed: 300,
			controls: false
			
    	});

		$('#big_carousel_prev2').click(function(){
			carousel_slider.goToPreviousSlide();
			return false;
		});
		
		$('#big_carousel_next2').click(function(){
			carousel_slider.goToNextSlide();
			return false;
		});
	});
</script>
<div id="slider1">
    <div class="slider1_tittle">
     <table width="100%">
            <tr>
            <td width="50%">
          <img src="{THEME}/images/film.png" align="center"> <b>Сериалы</b>
            </td>
            <td width="50%" align="right">
    
  <a href="/serial">показать все »</a>
            </td></tr> </table>
    
    </div>
   
    <div id="big_carousel_wrapper2">
        <ul id="big_carousel2">
           {custom category="122" template="serial" aviable="main" from="0" limit="70" cache="no"}
        </ul>
    </div>
    <a id="big_carousel_prev2" href="#">prev</a>
	<a id="big_carousel_next2" href="#">next</a>
</div></div></div>




<div id="contentfilm">

 <div class="slider1 wow fadeInUp">
<script>
	var $ = jQuery.noConflict();

	jQuery(document).ready(function() {
		var browser_viewport_width = jQuery(window).width();
		var item_width = parseInt(172)
		item_width += -40;  
     	var nr_of_slides = parseInt(browser_viewport_width / item_width) + 1;
		var nr_of_elements_to_scroll = 1;
		var carousel_slider = $('#big_carousel4').bxSlider({
        	displaySlideQty: nr_of_slides,
			moveSlideQty: nr_of_elements_to_scroll,
			speed: 300,
			controls: false
			
    	});

		$('#big_carousel_prev4').click(function(){
			carousel_slider.goToPreviousSlide();
			return false;
		});
		
		$('#big_carousel_next4').click(function(){
			carousel_slider.goToNextSlide();
			return false;
		});
	});
</script>
<div id="slider1">
    <div class="slider1_tittle">
     <table width="100%">
            <tr>
            <td width="50%">
          <img src="{THEME}/images/film.png" align="center"> <b>Таржима кино ва ТВ дастурлар</b>
            </td>
            <td width="50%" align="right">
    
  <a href="/films/tarjima-kino-teledasturlar/">показать все »</a>
            </td></tr> </table>
    
    </div>
   
    <div id="big_carousel_wrapper4">
        <ul id="big_carousel4">
           {custom category="297" template="film" aviable="main" from="0" limit="20" cache="no"}
        </ul>
    </div>
    <a id="big_carousel_prev4" href="#">prev</a>
	<a id="big_carousel_next4" href="#">next</a>
</div></div></div>


[/aviable]
