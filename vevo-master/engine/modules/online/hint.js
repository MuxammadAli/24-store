function onlineHintInit() {
    $(".ionline").mouseleave(function(){
        $("#ionline_vis").hide();
    });
    $(".ionline a").hover(function(){
        if(!($("#ionline_vis").is(":visible"))) {
            $("#ionline_vis").show();
        }
        var postop = $(this).position().top - 105;
        var posleft = $(this).position().right - 245;
        var uhint = $(this).attr('udata');
        var uhint = uhint.replace(/\[\[quot\]\]/g, '"');
        $("#ionline_vis").stop().html(uhint).animate({
            top:postop,
            left:posleft
        }, 'normal');
    });
}
$(function(){
    onlineHintInit();
});
var hidecomm = [], rateval = 0, oright = 0, otop = 0;