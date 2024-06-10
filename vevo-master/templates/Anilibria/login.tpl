[not-group=5]
<script type="text/javascript">
    $(document).ready(function(){
        $('.popup #popup_rightside .close_window, .overlay').click(function (){
            $('.popup, .overlay').css('opacity','0');
            $('.popup, .overlay').css('visibility','hidden');
        });
        $('a.open_window').click(function (e){
            $('.popup, .overlay').css('opacity','1');
            $('.popup, .overlay').css('visibility','visible');
            e.preventDefault();
        });
    });
</script>
<div id="profile_block">
    <form action="/">
        <div class="useravatar">
            <img src="{foto}" border="0" alt="" width="54" height="54">
        </div>
        <div class="userinfo">
            <p>{login}</p>
            <p><a href="{profile-link}" title="Мой профиль">Мой профиль</a></p>
            <p style="float:left; margin-right:5px;"></p>
            <p style="float:right;">
            <a class="right" href="{logout-link}">Выход</a>
            </p>
        </div>
    </form>
</div>

[/not-group]
[group=5]
<script type="text/javascript">
top.BX.defer(top.rsasec_form_bind)({'formid':'system_auth_form6zOYVN','key':{'M':'BaAkdic34IXZdUmRkUaFVMtJW1LcVpbY/9OeyKgJjWjbHPKIfBZZnulnujlMjczsvKFuKYwbT9uZJ5BIzzkCxWzZ/eOjn6x2Q5/O8HF8CuUAuHbSeV6oa2XlY6AFfQsW/C3Z+FeMe2KLUc7hTxF+i8T7DMHwBgE4xgrZJBm0sOQ=','E':'AQAB','chunk':'128'},'rsa_rand':'579b64cc9294b0.51729359','params':['USER_PASSWORD']});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.popup #popup_rightside .close_window, .overlay').click(function (){
            $('.popup, .overlay').css('opacity','0');
            $('.popup, .overlay').css('visibility','hidden');
        });
        $('a.open_window').click(function (e){
            $('.popup, .overlay').css('opacity','1');
            $('.popup, .overlay').css('visibility','visible');
            e.preventDefault();
        });
    });
</script>
<a id="auth_link" class="open_window" href="">Авторизация</a>
<div class="overlay" title="окно"></div>
<div class="popup">
    <div id="popup_leftside">
        <h2>ДОБРО ПОЖАЛОВАТЬ!</h2>
        <hr>
        <form name="system_auth_form6zOYVN" method="post" target="_top" action="/?login=yes">
            <input type="hidden" name="backurl" value="/">
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="AUTH">
            <div>
                <div id="loginpic"></div>
                <input class="logtext" type="text" name="USER_LOGIN" placeholder="Логин" value="" required="">
            </div>
            <div>
                <div id="passwordpic"></div>
                <input class="logtext" type="password" name="USER_PASSWORD" placeholder="Пароль" required="">
            </div>
            <div id="auth_links">
                <span class="bx-auth-secure" id="bx_auth_secure6zOYVN" title="Перед отправкой формы авторизации пароль будет зашифрован в браузере. Это позволит избежать передачи пароля в открытом виде." style="display: inline-block;">
                    <div class="bx-auth-secure-icon"></div>
                </span>
                <noscript>
                    &lt;span class="bx-auth-secure" title="Пароль будет отправлен в открытом виде. Включите JavaScript в браузере, чтобы зашифровать пароль перед отправкой."&gt;
                    &lt;div class="bx-auth-secure-icon bx-auth-secure-unlock"&gt;&lt;/div&gt;
                    &lt;/span&gt;
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure6zOYVN').style.display = 'inline-block';
                </script>
	                <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y">
                <label for="USER_REMEMBER_frm" title="Запомнить меня на этом компьютере">Запомнить меня</label><br>
                <noindex><a href="{lostpassword-link}" rel="nofollow">Забыли свой пароль?</a></noindex>
            </div>
           <button class="btn" onclick="submit();" type="submit" title="Войти">
						<svg class="icon icon-right"><use xlink:href="#icon-right"></use></svg>
						<span class="title_hide">Войти</span>
					</button>
        </form>
    </div>
    <div id="popup_rightside">
        <h2>СОЗДАНИЕ АККАУНТА</h2>
        <hr>
        <div class="close_window">X</div>
        <div id="register_text">
            <span>У тебя всё ещё нет аккаунта? Тогда зарегистрируйся прямо сейчас!<br>
                <div class="bx-auth-lbl">Войти как пользователь:</div>
                <div class="bx-auth-serv-icons">
                   <div class="soc_links">
				[vk]<a href="{vk_url}" target="_blank" class="soc_vk">
					<svg class="icon icon-vk"><use xlink:href="#icon-vk"/></svg>
				</a>[/vk]
				[yandex]<a href="{yandex_url}" target="_blank" class="soc_ya">
					<svg class="icon icon-ya"><use xlink:href="#icon-ya"/></svg>
				</a>[/yandex]
				[facebook]<a href="{facebook_url}" target="_blank" class="soc_fb">
					<svg class="icon icon-fb"><use xlink:href="#icon-fb"/></svg>
				</a>[/facebook]
				[google]<a href="{google_url}" target="_blank" class="soc_gp">
					<svg class="icon icon-gp"><use xlink:href="#icon-gp"/></svg>
				</a>[/google]
				[odnoklassniki]<a href="{odnoklassniki_url}" target="_blank" class="soc_od">
					<svg class="icon icon-od"><use xlink:href="#icon-od"/></svg>
				</a>[/odnoklassniki]
				[mailru]<a href="{mailru_url}" target="_blank" class="soc_mail">
					<svg class="icon icon-mail"><use xlink:href="#icon-mail"/></svg>
				</a>[/mailru]
			</div>
                </div>
            </span>
            <noindex><a id="register_link" href="{registration-link}" rel="nofollow">Регистрация</a></noindex>
        </div>
    </div>
</div>
<div style="display:none">
    <div id="bx_auth_float" class="bx-auth-float">
        <div class="bx-auth">        
</div>
</div>
</div>																																																																																																																																													[aviable=showfull]<span style="display:none;">все шаблоны для dle на сайте <a href="http://newtemplates.ru/kinoportal/">кино шаблоны</a> dle скачать</span>[/aviable]
[/group]