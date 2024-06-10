<aside>
    <div class="side-block">
        <div class="asidehead">
            <p>Поиск</p>
        </div>
        <!-- Поиск -->
				<form id="q_search" class="rightside" method="post">
					<div class="q_search">
						<input id="story" name="story" placeholder="Поиск по сайту..." type="search">
						<button class="btn q_search_btn" type="submit" title="Найти"><span class="title_hide">Найти</span></button>
											</div>
					<input type="hidden" name="do" value="search">
					<input type="hidden" name="subaction" value="search">
                    <style>
                        /* --- Поиск --- */
.q_search { position: relative; margin-top: 22px; }
	.q_search > input {
		width: 100%; height: 36px;
		line-height: 22px;
		padding: 7px 72px 7px 18px;
		border-radius: 18px;
		background-color: #dfdfdf;
		display: block;
		border: 0 none;
		box-shadow: inset 0 1px 1px 0 rgba(0,0,0,0.1); -webkit-box-shadow: inset 0 1px 1px 0 rgba(0,0,0,0.1);
		-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
	}
	.q_search > input:focus {
		background-color: #fff;
		box-shadow: 0 1px 1px 0 rgba(0,0,0,0.1); -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,0.1);
	}
	.q_search > .btn { position: absolute;
    margin: 0px 0 0 1px;
    width: 48px;
    height: 36px;
    display: inline-block;
    vertical-align: middle;
    cursor: pointer;
    height: 36px;
    border-radius: 18px;
    line-height: 22px;
    outline: none;
    background-color: #3394e6;
    color: #fff;
    border: 0 none;
    text-decoration: none !important;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all ease .1s;
    transition: all ease .1s; 
    right: 0;
    top: 0;}
	.q_search .icon-search { position: absolute; left: 50%; top: 50%; margin: -8px 0 0 -8px; width: 16px; height: 16px; }
	.q_search .q_search_adv {
		position: absolute;
		right: 0; top: 0;
		margin-right: 36px;
		width: 36px; height: 36px;
	}
	.q_search .icon-set {
		width: 16px; height: 16px;
		position: absolute;
		left: 50%; top: 50%;
		margin: -8px 0 0 -8px;
		fill: #737373;
	}
	.q_search .q_search_adv:hover .icon-set { fill: #3394e6; }
.title_hide {
    left: -9999px;
    
    top: -9999px;
    overflow: hidden;
    width: 0;
    height: 0;
}
                        
                .q_search > .btn:hover, .bbcodes:hover, .ui-button:hover {
    background-color: #46a6f6;
}
                    </style>
				</form>
		<!-- / Поиск -->
        <a href="/" target="_blank"><img src="{theme}/images/pushall1.png"></a>
	</div>
    <div class="side-block">
        <div class="asidehead">
            <p><font style="color: #ffffff;">Новые серии</font></p>
		</div>
        {custom category="3" template="news" aviable="global" order="date" limit="5" cache="no"}	
    </div>
    <img src="{theme}/images/last-tor-reklama.png" alt="Рекламное место">
</aside>