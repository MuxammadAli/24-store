<script type="text/javascript" src="/engine/skins/default.js"></script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <a href="http://power-dle.com/" style="display:none;">Шаблоны для DLE</a><a href="http://piratbit.ws/" style="display:none;">торрентом</a>
<style type="text/css">
  .online_robot{color:black;cursor:pointer;margin-right:15px} 
  .online_user, .online_user:visited, .online_user:hover{color:green;text-decoration:none;font-weight:bold;margin-right:15px} 
  .group_1, .group_1:visited, .group_1:hover{color:red} 
  #hintbox {text-align:left;width:250px;font-size:10px;border:1px solid #FFF;background:#000;layer-background-color:#a396d9;color:#FFF;margin:10px 0 0 0;padding:5px 7px;position:absolute;top:0;visibility:hidden;z-index:998;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(opacity=90)";filter:progid:DXImageTransform.Microsoft.Alpha(opacity=90);-moz-opacity:0.90;-khtml-opacity:0.90;opacity: 0.90;}
  .foto {float:left;width:100px;height:100px;margin-right:7px;}
</style>
<?
$g = $r = $u = 0;
$robots = $users = "";
foreach ($this->online as $key=>$val)
{
if($val['id'] == 2) {$r++; $robots .= "<b class=\"online_robot\" onmouseover=\"showhint('Группа: {$val['group']}<br />ОС: {$val['os']}<br />Браузер: {$val['browser']}<br />Был здесь в: ".date("H:i:s", $val['time'])."<br />{$val['position']}', this, event, '270px');\">{$val[name]}</b> ";}
elseif($val['id'] == 1) {$u++; if($val['foto']) $foto = "<img src=/uploads/fotos/{$val['foto']} class=foto />"; else $foto = "<img src=/templates/{$this->config['skin']}/images/noavatar.png class=foto />"; 
if($this->config["allow_alt_url"]!="no") $profile = "/user/".urlencode($val['name'])."/"; else $profile = "/?subaction=userinfo&user=".urlencode($val['name']); 
$users .= "<a class=\"online_user group_{$val['groupid']}\" onmouseover=\"showhint('$foto <span style=font-size:10pt>{$val['name']}</span><br /> Группа: {$val['group']}<br />ОС: {$val['os']}<br />Браузер: {$val['browser']}<br />Был здесь в: ".date("H:i:s", $val['time'])."<br />{$val['position']}', this, event, '270px');\" href=\"$profile\">{$val[name]}</a> ";}
  else $g++;
}
$vsego = $u+$g;
$procent = round($u * 100 / $vsego) ;
?>

  <img src="{THEME}/images/profile2.png" align="absmiddle"><font color="black"> На сайте: <b><?=$vsego?></b> онлайн</font>
