<div class="news-detail-block" style="font-size: 12pt;font-family: 'PT Sans', sans-serif;font-weight: 400;width: 890px;overflow: hidden;">
	<div class="news-detail-header" style="height: 50px;background-color: #b32121;color: #fff;">
			<h1 style="font-size: 18pt;font-style: italic;font-weight: 300;text-align: center;line-height: 50px;">{title}</h1>
	</div>
	<div class="news-detail-content" style="color: #7f7f7f;background-color: #fff;border-left: 2px solid #e3e3e3;border-right: 2px solid #e3e3e3;padding: 20px;">
     <center><img src="[xfvalue_image1]" alt="{title}"style="text-align: center;width: 100%;"></center> 
       <p> {full-story}</p>
        <a href="/" id="back-to-list"style="font-size: 13pt;font-style: italic;color: #b32121;">Возврат к списку</a>
	</div>
	<div class="news-detail-footer" style="height: 50px;background-color: #282829;color: #fff;padding: 0px 20px 0px 20px;line-height: 50px;font-size: 11pt;">
		<span>Опубликовал:&nbsp;<i>({author}) </i></span>
		<span id="right-span" style="float: right;">Дата:&nbsp;<i>{date}</i></span>
	</div>
</div>
<style>
.box_in {
    padding: 4% 8%;
}
.addcomment h3 {
    margin: .3em 0 .6em 0;
        font-size: 20px;
}
    textarea {
    display: inline-block;
    width: 302px;
    height: 46px;
    line-height: 22px;
    padding: 10px;
    vertical-align: middle;
    border-radius: 2px;
    background: #fff;
    border: 2px solid #e8e8e8;
    -webkit-transition: border 0.2s linear 0s;
    transition: border 0.2s linear 0s;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
 textarea {
    font: normal 14px/1.5 Arial, Helvetica, sans-serif;
    color: #353535;
    outline: none;
} 
.bb-editor textarea {
    padding: 7px;
    width: 100%;
    margin-top: -1px;
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
.bb-editor textarea, .ui-dialog textarea, select#category, .timezoneselect, .quick-edit-text {
    width: 100% !important;
}
#comment-editor .bb-editor textarea {
    padding: 7px;
    padding-bottom: 45px;
    height: 140px;
}
label {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
.form_submit {
    margin-top: 20px;
}
.btn-big {
    height: 46px;
    padding: 12px 27px;
    border-radius: 23px;
}
.btn, .bbcodes, .ui-button, .btn-border {
    border: 0 none;
    display: inline-block;
    vertical-align: middle;
    cursor: pointer;
    height: 36px;
    border-radius: 18px;
    line-height: 22px;
    outline: none;
    background-color: #d52c43;
    color: #fff;
    border: 0 none;
    padding: 7px 22px;
    text-decoration: none !important;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all ease .1s;
    transition: all ease .1s;
} 
  .btn b {
    font-weight: bold;
}
.btn:hover, .bbcodes:hover, .ui-button:hover {
        background-color: #282829;
}
.bot, .comment {
    background-color: #fff;
    margin-bottom: 25px;
    border-radius: 2px;
    position: relative;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
}
.showfull #dle-content .bot {
    float: left;
    width: 100%;
}
.bot > .heading {
    padding: 4% 8%;
    margin: 0;
    text-transform: uppercase;
    font-size: 18px;
    letter-spacing: -0.01em;
    line-height: normal;
    font-weight: bold;
    text-rendering: optimizeLegibility;
}
.bot > .heading .hnum {
    font-size: .6em;
    display: inline-block;
    vertical-align: top;
    margin: 0 0 0 .4em;
    color: #919191;
}

.grey {
    color: #919191;
}
.bb-pane {
    display: none;
}
</style>