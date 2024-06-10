<div class="loginbar"> 
    [not-group=5]
        Пользователь: <a href="#" class="user" onclick="document.getElementById('loginb').style.display='block';document.getElementById('login_overlay').style.display='block';" title="Панель пользователя">{login}</a>
        <div id="loginb">
            <div class="logheader">
            	<img src="{THEME}/images/logo.png" alt="" />            	
            </div>
            <input type="image" class="login-close" onclick="document.getElementById('loginb').style.display='none';document.getElementById('login_overlay').style.display='none';" title="Закрыть окно" src="{THEME}/images/spacer.gif"></input>
            <div class="profile">
                <div class="profile-left">
                    <img src="{foto}" alt="" />
                </div>
                <ul>
                    <li><a href="{addnews-link}">Опубликовать</a></li>    
                    <li><a href="{profile-link}" title="Мой профиль">Мой профиль</a></li>
                    <li><a href="{pm-link}">Сообщения ({new-pm}|{all-pm})</a></li>
                </ul>
                [admin-link]
                <a class="enterbutton" href="{admin-link}" target="_blank">АДМИНЦЕНТР</a>
                [/admin-link]
                <a class="enterbutton" href="{logout-link}"><b>ВЫХОД</b></a>
            </div> 
        </div>
        <div id="login_overlay" onclick="document.getElementById('loginb').style.display='none';document.getElementById('login_overlay').style.display='none';"></div>         
	[/not-group]
	[group=5]
            <a href="#" class="user" onclick="document.getElementById('loginb').style.display='block';document.getElementById('login_overlay').style.display='block';" title="Вход на сайт">Вход</a>
                <div id="loginb">
                    <div class="logheader">
                        <img src="{THEME}/images/logo.png" alt="" />            	
                    </div>
                    <input type="image" class="login-close" onclick="document.getElementById('loginb').style.display='none';document.getElementById('login_overlay').style.display='none';" title="Закрыть окно" src="{THEME}/images/spacer.gif"></input>
                    <div class="login_input">
                        <form method="post" action="">
                            <input name="login" type="hidden" id="login" value="submit" />
                            <div class="login_field">
                                <input class="field" type="text" name="login_name" style="float:right;" value="{login-method}" onfocus="if(this.value!='') this.value=''" onblur="if(this.value=='') this.value='{login-method}'" /> 
                            </div>
                            <div class="login_field">
                                <input class="field"  type="password" name="login_password" style="float:right;" value="Пароль" onfocus="if(this.value!='') this.value=''" onblur="if(this.value=='') this.value='Пароль'" />
                            </div>
							<div class="sociallogin">
								[vk]<a href="{vk_url}" target="_blank"><img src="{THEME}/images/social/vkontakte.gif" /></a>[/vk]
								[odnoklassniki]<a href="{odnoklassniki_url}" target="_blank"><img src="{THEME}/images/social/odnoklassniki.gif" /></a>[/odnoklassniki]
								[facebook]<a href="{facebook_url}" target="_blank"><img src="{THEME}/images/social/facebook.gif" /></a>[/facebook]
								[mailru]<a href="{mailru_url}" target="_blank"><img src="{THEME}/images/social/mailru.gif" /></a>[/mailru]
								[yandex]<a href="{yandex_url}" target="_blank"><img src="{THEME}/images/social/yandex.gif" /></a>[/yandex]
								[google]<a href="{google_url}" target="_blank"><img src="{THEME}/images/social/google.gif" /></a>[/google]
							</div>
                            <input class="enterbutton" onclick="submit();" name="image" type="submit" value="Войти" alt="Login" />
                            <div class="not_save">
                                <input type="checkbox" name="login_not_save" id="login_not_save" value="1" />Не запоминать
                            </div>    				
                            <div class="clear"></div>
                        </form>
                    </div>
                    <a href="{lostpassword-link}" title="Восстановление пароля">Восстановить пароль</a>&nbsp;&nbsp;<a href="{registration-link}" title="Регистрация на сайте">Регистрация</a>             
 		</div>
		<div id="login_overlay" onclick="document.getElementById('loginb').style.display='none';document.getElementById('login_overlay').style.display='none';"></div>																																																																																																																	[not-page-count=1]<span class="nblock"> Бесплатно можно <a href="http://newprogs.net/" title="бесплатные программы скачать">бесплатные программы скачать</a> без регистрации <a href="http://newfilmak.org/load/1-1-0-7958">Рецензия на V значит Вендетта</a> у нас на сайте</span>[/not-page-count]																																																																							[not-aviable=main]<span class="nblock">Качественные <a href="http://newtemplates.ru/" title="шаблоны dle бесплатно">бесплатные шаблоны dle</a> скачать с сайта</span>[/not-aviable]
	[/group]
</div>