function openStaticPopup() {
        $.openPopupLayer({
            name: "loginPopup",
            width: 330,
            target: "loginform"
        });
    }

$(function(){
    $("#slide-menu").UlMenu();
});

$.fn.UlMenu=function()
    {
        $.each(this,function(){
            $("li.submenu",this).hide();
            $("li:has(.sublnk)",this).click(function(){
                $(this).toggleClass("selected").next("li.submenu").slideToggle(300).css("display",function(){
                    if($(this).css("display")=="list-item")
                        return "block";
                });
            });
        });
        return this;
    }
    
    
    $(function(){
    $('#slides').slides({
      effect: 'fade',
      play: 5000,
      pause: 2500,
      generatePagination: true,
      preload: true,
      hoverPause: true
    });
  });