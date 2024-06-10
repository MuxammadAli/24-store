[aviable=main]
<div id="contentclip">
<div class="slider1 wow fadeInUp">
<script>
	var $ = jQuery.noConflict();

	jQuery(document).ready(function() {
		var browser_viewport_width = jQuery(window).width();
		var item_width = parseInt(172)
		item_width += -40;  
     	var nr_of_slides = parseInt(browser_viewport_width / item_width) + 1;
		var nr_of_elements_to_scroll = 1;
		var carousel_slider = $('#big_carousel3').bxSlider({
        	displaySlideQty: nr_of_slides,
			moveSlideQty: nr_of_elements_to_scroll,
			speed: 300,
			controls: false
			
    	});

		$('#big_carousel_prev3').click(function(){
			carousel_slider.goToPreviousSlide();
			return false;
		});
		
		$('#big_carousel_next3').click(function(){
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
        <img src="{THEME}/images/clip.png" align="center"> <b>Клипы</b>
            </td>
            <td width="50%" align="right">
    
    <a href="/clips">показать все »</a>
            </td></tr> </table>
    </div>
   
    <div id="big_carousel_wrapper3">
        <ul id="big_carousel3">
           {custom category="34" template="clip" aviable="main" from="0" limit="50" cache="no"}
        </ul>
    </div>
    <a id="big_carousel_prev3" href="#">prev</a>
	<a id="big_carousel_next3" href="#">next</a>
</div></div></div><br>
[/aviable]