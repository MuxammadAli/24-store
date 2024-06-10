<div class="torrent_block_main" id="bx_1">				
   <a href="{full-link}">   <div class="torrent_descr_wrap">
 </div>
   <img class="torrent_pic" border="0" src="[xfvalue_image]" width="270" height="393" alt="" title="">
    <p class="torrent_name">
        <a href="{full-link}">{title}</a>
    </p></a>
</div>
<style>
 .torrent_block_main {
    position: relative;
    width: 270px;
    height: 450px;
    background-color: #cf2525;
    float: left;
    margin: 10px 25px 33px 0px;
    padding: 0;
    font-family: 'PT Sans', sans-serif;
} 
.torrent_descr_wrap {
    width: 270px;
    height: 394px;
    position: absolute;
}
.torrent_descr_wrap::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: -webkit-linear-gradient(top, rgba(207,37,37,0.2) 0%, rgba(207,37,37,0.9) 75%);
    background: linear-gradient(to bottom, rgba(207,37,37,0.2) 0%, rgba(207,37,37,0.9) 75%);
    content: '';
    opacity: 0;
    -webkit-transform: translate3d(0,0%,0);
    transform: translate3d(0,0%,0);
}
    .torrent_descr_wrap::before, .torrent_full_descr {
    -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
    transition: opacity 0.35s, transform 0.35s;
}
    .torrent_full_descr {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 2em 5px;
    width: 100%;
    opacity: 0;
    -webkit-transform: translate3d(0,0px,0);
    transform: translate3d(0,0px,0);
}
    .torrent_full_descr {
    text-align: center;
    color: #fff;
}
    .torrent_descr_wrap:hover::before, .torrent_descr_wrap:hover .torrent_full_descr {
    opacity: 1;
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
}
    .torrent_block_main img.torrent_pic {
    margin: 0px;
    }
        .torrent_block_main p.torrent_name {
    margin: 0px;
    padding: 0px;
    height: 56px;
    color: #fff;
    text-align: center;
    font-weight: 400;
    font-size: 9.5pt;
    word-wrap: break-word;
    overflow: hidden;
    vertical-align: middle;
}
    p.torrent_name a, p.torrent_name a:visited {
    margin: 0px;
    padding: 0px;
    color: inherit;
    text-decoration: none;
    outline: none;
    overflow: hidden;
    vertical-align: middle;
}
        
</style>