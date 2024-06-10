<?php
/*
=====================================================
Автор: SX2
-----------------------------------------------------
Decoded & Modifed: Qnut 
-----------------------------------------------------
Web: http://coderlaba.com/
-----------------------------------------------------
Version: 2.5
=====================================================
*/
class whoonline_function
{
	private $user_id		=	null;
	private $user_proxy		=	null;
	private $user_name		=	null;
	private $user_foto		=	null;
	private $user_group		=	null;
	private $user_groupid	=	null;
	private $user_position	=	null;
	private $user_os		=	"неизвестная";
	private $user_browser	=	"неизвестный";
	private $robots			=	false;
	protected $date_ajust	= 	0;


	protected function info()
	{
		global $_IP, $config;
		$this->date_adjust = $config["date_adjust"]*60;
		$_UA = $_SERVER["HTTP_USER_AGENT"];
		$this->robots($_UA);
		if(!$this->robots)
		{
			$this->user_os($_UA);
			$this->user_browser($_UA);
		}
		$this->user_info();
		$this->user_position = $this->user_position();


		$usr = array (
			"time"		=>	time() + $this->date_adjust,
			"ip"		=>	$_IP ? $_IP : $_SERVER["REMOTE_ADDR"],
			"proxy"		=>	getenv('HTTP_X_FORWARDED_FOR'),
			"name"		=>	$this->user_name,
			"id"		=>	$this->user_id,
			"foto"		=>	$this->user_foto,
			"group"		=>	$this->user_group,
			"groupid"	=>	$this->user_groupid,
			"os"		=>	$this->user_os,
			"browser"	=>	$this->user_browser,
			"position"	=>	$this->user_position,
		);

		$this->start($usr['id'], $usr['name'], $usr['ip'], $usr['time'], $usr['position'], $usr['groupid'], $usr['proxy'], $usr['browser'], $usr['os'], $usr['foto']);

		return $usr;

	}
	
	private function robots($useragent)
	{
        $arr = array("#.*(yandex|yadirectbot).*#si" => "Yandex", "#.*(google|accoona|gsa-crawler).*#si" => "Google", "#.*rambler.*#si" => "Rambler", '#.*mail.ru.*#si' => "Mail Ru", "#.*aport.*#si" => "Aport", "#.*TurtleScanner.*#si" => "Turtle", "#.*slurp.*#si" => "Inktomi Spider", "#.*msnbot.*#si" => "Msn", "#.*(askjeeves|ask jeeves).*#si" => "Ask Com", "#.*yahoo.*#si" => "Yahoo", "#.*scooter.*#si" => "AltaVista", "#.*lycos.*#si" => "Lycos.com", "#.*libwww.*#si" => "Punto", "#.*picsearch.*#si" => "PicSearch", "#.*mnogosearch.*#si" => "mnoGoSearch", "#.*(is_archiver|archive_org).*#si" => "Archive Org", "#.*W3C_Validator.*#si" => "W3C Validator", "#.*W3C_CSS_Validator.*#si" => "W3C CSS Validator");
        $result = preg_replace(array_keys($arr), $arr, $useragent);
        $this->robots = $result == $useragent ? $this->robots : $result;
	}
	
	private function user_os($useragent)
	{
		$arr = array("#.*Windows NT 5.1.*#si" => "Windows XP", "#.*Windows NT 5.2.*#si" => "Windows XP x64 or Server 2003", "#.*Windows NT 6.0.*#si" => "Windows Vista", "#.*Windows NT 6.1.*#si" => "Windows 7",  /*update 2.5*/"#.*Windows NT 6.2.*#si" => "Windows 8", "#.*Windows NT 6.3.*#si" => "Windows 8.1 Blue"/*update 2.5*/, "#.*Windows NT 5.0.*#si" => "Windows 2000", "#.*(Windows NT 4.0|Windows NT 3.5).*#si" => "Windows NT", "#.*Windows CE.*#si" => "Windows CE or Mobile", "#.*Windows Me.*#si" => "Windows ME", "#.*Windows 98.*#si" => "Windows 98", "#.*Windows 95.*#si" => "Windows 95", "#.*(Linux|Lynx|Unix).*#si" => "Linux", "#.*(Macintosh|PowerPC).*#si" => "MacOS", "#.*OS/2.*#si" => "OS/2", "#.*BeOS.*#si" => "BeOS");
		$result = preg_replace(array_keys($arr), $arr, $useragent);
		$this->user_os = $result == $useragent ? $this->user_os : $result;
	}
	
	private function user_browser($useragent)
 	{
 		$arr = array("#.*MSIE (\S*);.*#si" => "Internet Explorer \\1", "#.*(Opera.*Version|Opera)/(\S*).*#si" => "Opera \\2", "#.*Navigator/(\S*).*#si" => "Navigator \\1", "#.*Flock/(\S*).*#si" => "Flock \\1", "#.*Firefox/(\S*).*#si" => "Firefox \\1", "#.*Chrome/(\S*).*#si" => "Chrome \\1", "#.*Version/(\S*).*Safari.*#si" => "Safari \\1", "#.*Safari/(\S*).*#si" => "Safari \\1", "#.*K-Meleon.*#si" => "K-Meleon", "#.*SeaMonkey.*#si" => "SeaMonkey", "#.*Camino.*#si" => "Camino", "#.*Epiphany.*#si" => "Epiphany", "#.*America Online Browser.*#si" => "America Online Browser", "#.*avantbrowser.*#si" => "Avant Browser.");
        $result = preg_replace(array_keys($arr), $arr, $useragent);
        $this->user_browser = $result == $useragent ? $this->user_browser : $result;
	}
	
	private function user_info()
	{
		global $is_logged, $member_id, $user_group;
		if($this->robots)
		{
			$this->user_id = 2;
			$this->user_name = $this->robots;
			$this->user_group = "роботы";
		}
		elseif($is_logged)
		{
			$this->user_id = 1;
			$this->user_name = $member_id["name"];
			$this->user_foto = $member_id["foto"] ? $member_id["foto"] : null;
			$this->user_group = $user_group[$member_id["user_group"]]["group_name"];
			$this->user_groupid = $member_id["user_group"];
		}
		else
		{
			$this->user_id = 0;
			//$this->user_name = "<img src='{THEME}/online/images/nouser.png' width='10' height='15'>";
			$this->user_name = "<img src='{THEME}/online/images/anony.gif'>";
			$this->user_group = "гости";
		}
		
	}
	
	public function user_position()
	{
		global $cat_info, $category_id, $dle_module, $nam_e, $titl_e;
		$result = "Просматривает главную страницу";
		switch($dle_module)
		{
			case "main":			$result = "Просматривает главную страницу"; break;
			case "showfull":		if($titl_e) $result = "Просматривает новость: $titl_e"; else $result = "Просматривает страницу: Error 404"; break;
			case "alltags":			$result = "Просматривает облако тегов"; break;
			case "cat":				if($cat_info[$category_id]["name"]) $result = "Просматривает категорию: {$cat_info[$category_id]["name"]}"; else $result = "Просматривает категорию: Error 404"; break;
			case "favorites":		$result = "Просматривает избранные статьи"; break;
			case "lastcomments":	$result = "Просматривает последние комментарии"; break;
			case "lastnews":		$result = "Просматривает последние новости"; break;
			case "rules":			$result = "Просматривает правила сайта"; break;
			case "static":			$result = "Просматривает страницу: $titl_e"; break;
			case "stats":			$result = "Просматривает статистику сайта"; break;
			case "tags":			$result = "Просматривает облако тегов"; break;
			case "userinfo":		$result = "Просматривает профиль: $nam_e"; break;
			case "addcomment":		$result = "Добавляет комментарий"; break;
			case "addnews":			$result = "Добавляет новость"; break;
			case "comments":		$result = "Добавляет комментарий"; break;
			case "seotools":		$result = "Находится в разделе: $nam_e"; break;
			case "allnews":			$result = "Находится в разделе: $nam_e"; break;
			case "feedback":		$result = "Находится в разделе: $nam_e"; break;
			case "pm":				$result = "Находится в разделе: $nam_e"; break;
		}
		return addslashes(htmlspecialchars($result));
	}
}

class whoonline extends whoonline_function
{
	private $template = null;
	private $live = null;
	private $whoonlock = null;
	private $whoonline = null;
	private $online = array();
	


//------------------------------------------------------------------------

    public function start( $user_id, $user_name, $user_ip, $time, $user_location, $u_group, $user_proxy, $user_agent, $user_OS, $user_foto )
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_ip = $user_ip;
        $this->time = $time;
        $this->user_location = $user_location;
        $this->user_group = $u_group;
        $this->user_proxy = $user_proxy;
        $this->user_agent = $user_agent;
		$this->user_lastdate = $time;
        $this->user_OS = $user_OS;
        $this->user_foto = $user_foto;
        $this->tpl->load_template( "online/user_hint.tpl" );
    }

    private function set_block( $name, $text )
    {
        $this->tpl->set_block( "'\\[".$name."\\](.*?)\\[/".$name."\\]'si", $text );
    }

    public function arruser( $val )
    {
		global $css_num, $css_num_last ;
        $this->tpl->result['online_user'] = NULL;
        $this->tpl->result['online_user_hint'] = NULL;

		$browser_icon = "";
		$flag = "";
		if ( $this->config['allow_alt_url'] == "yes" )
        {
            $profile_url = $this->config['http_home_url']."user/".urlencode($this->user_name);
        }else{
            $profile_url = $this->config['http_home_url']."index.php?subaction=userinfo&user=".urlencode($this->user_name);
        }	
		
		if ( $this->user_foto && file_exists( ROOT_DIR."/uploads/fotos/".$this->user_foto ))
        {
            $foto = "<img src=" . $this->config['http_home_url']."uploads/fotos/".$this->user_foto . " border=0>";
        }else{
            if (($this->online_config['show_avatar_def'] == "yes")&&($val['id'] != 2)) {
				$foto = "<img src=" . $this->config['http_home_url']."templates/".$this->config['skin']."/images/dnoavatar.png" . " border=0>";
			}else{
				$foto = "";
			}
        }
		if ($this->config['version_id'] >= 9.8) {
			if ( $this->user_foto && file_exists( ROOT_DIR."/uploads/fotos/".$this->user_foto ))
			{
				$foto = "<img src=" . $this->config['http_home_url']."uploads/fotos/".$this->user_foto . " border=0>";
			}else{
				if (($this->online_config['show_avatar_def'] == "yes")&&($val['id'] != 2)) {
					$foto = "<img src=" . $this->config['http_home_url']."templates/".$this->config['skin']."/dleimages/noavatar.png" . " border=0>";
				}else{
				$foto = "";
				}
			}
		}
        
		if ( $this->online_config['show_country_flag'] == "yes" || $this->online_config['show_country'] == "yes" || $this->online_config['show_city'] == "yes" )
        {
            $gi = geoip_open( ROOT_DIR."/engine/data/GeoLiteCity.dat", GEOIP_STANDARD );
            $geoip = geoip_record_by_addr( $gi, $this->user_ip );
            geoip_close( $gi );
        }
        
		if ( $this->online_config['show_country_flag'] == "yes" && $geoip->country_code != NULL )
        {
            $flag = "<img src=\\'".$this->config['http_home_url']."templates/".$this->config['skin']."/online/flags/".$geoip->country_code."0.gif\\'>";
            $this->set_block( "flag", "\\1" );
        }else{
            $this->set_block( "flag", "" );
        }
        
		if ( $this->online_config['show_country'] == "yes" && $geoip->country_name != NULL )
        {
            $this->set_block( "country", "\\1" );
        }else{
            $this->set_block( "country", "" );
        }
        
		if ( $this->online_config['show_city'] == "yes" && $geoip->city != NULL )
        {
            $this->set_block( "city", "\\1" );
        }else{
            $this->set_block( "city", "" );
        }
        
		if ( $this->online_config['show_location'] == "yes" && $this->user_location != NULL )
        {
            $this->set_block( "user_location", "\\1" );
        }else{
            $this->set_block( "user_location", "" );
        }
		
        if ( $this->online_config['show_last_visit'] == "yes" && $this->time != NULL )
        {
            if ( date( "d.m.Y" ) == date( "d.m.Y", $this->time ) )
            {
                $last_visit = "Сегодня, ".date( "H:i:s", $this->time );
            }else{
                $last_visit = date( "d.m.Y, H:i:s", $this->time );
            }
            $this->set_block( "last_visit", "\\1" );
        }else{
            $this->set_block( "last_visit", "" );
        }
		
        if ( $this->online_config['show_user_group'] == "yes" && $this->user_group != NULL )
        {
            $this->set_block( "usergroup", "\\1" );
        }else{
            $this->set_block( "usergroup", "" );
        }
		
        if ( $this->online_config['show_ip'] == "yes" && $this->user_ip != NULL )
        {
            $this->set_block( "ip", "\\1" );
        }else{
            $this->set_block( "ip", "" );
        }
		
        if ( $this->online_config['show_proxy'] == "yes" && $this->user_proxy != NULL )
        {
            $this->set_block( "proxy", "\\1" );
        }else{
            $this->set_block( "proxy", "" );
        }
		
		global $_TIME;
		if ( ($this->user_lastdate + $this->live) > $_TIME && $this->user_lastdate != NULL) {
			$this->tpl->set( '[online]', "" );	
			$this->tpl->set( '[/online]', "" );	
			$this->tpl->set_block( "'\\[offline\\](.*?)\\[/offline\\]'si", "" );
		} else {
			$this->tpl->set( '[offline]', "" );
			$this->tpl->set( '[/offline]', "" );
			$this->tpl->set_block( "'\\[online\\](.*?)\\[/online\\]'si", "" );
		}
		
        if ( $this->online_config['show_user_OS'] == "yes" && $this->user_OS != NULL )
        {
            $this->set_block( "user_OS", "\\1" );
        }else{
            $this->set_block( "user_OS", "" );
        }
		
        if ( $this->online_config['show_user_agent'] == "yes" && $this->user_agent != NULL )
        {
            $this->set_block( "user_agent", "\\1" );
        }else{
            $this->set_block( "user_agent", "" );
        }
		
        if ( $this->online_config['show_browser_icon'] == "yes" && $this->user_agent != NULL )
        {
            $browser_name = explode( " ", $this->user_agent );
            $browser_name = strtolower( trim( $browser_name['0'] ) );
            $browsers_list = array( "firefox", "safari", "opera", "explorer", "internet", "mozilla", "chrome", "chromiun", "flock", "konqueror", "Internet Explorer" );
            if ( in_array( $browser_name, $browsers_list ) )
            {
                $browser_icon = "<img src='".$this->config['http_home_url']."templates/".$this->config['skin']."/online/browsers/".$browser_name.".png'>";
            }
            $this->set_block( "browser_icon", "\\1" );
        }else{
            $this->set_block( "browser_icon", "" );
        }

		$this->tpl->set( "{ip}", $val["ip"] );
        $this->tpl->set( "{flag}", $flag );
        $this->tpl->set( "{proxy}", $this->user_proxy );
        $this->tpl->set( "{country}", $geoip->country_name );
        $this->tpl->set( "{city}", $geoip->city );
        $this->tpl->set( "{user_OS}", $this->user_OS );
        $this->tpl->set( "{user_agent}", $this->user_agent );
        $this->tpl->set( "{usergroup}", $this->user_groups[$this->user_group]['group_name'] );
        $this->tpl->set( "{last_visit}", $last_visit );
        $this->tpl->set( "{user_location}", $this->user_location );
        $this->tpl->set( "{browser_icon}", $browser_icon );
        $this->tpl->set( "{foto}", $foto );
        $this->tpl->compile( "online_user_hint" );
        $this->tpl->clear( );

		
		//Заполняем шаблон пользователя
		$this->tpl->load_template( "online/user.tpl" );

		if ( $this->config['allow_alt_url'] == "yes" )
        {
            $profile_url = $this->config['http_home_url']."user/".urlencode($val['name']);
        }else{
            $profile_url = $this->config['http_home_url']."index.php?subaction=userinfo&user=".urlencode($val['name']);
        }		


        if ( strpos( $this->tpl->copy_template, "[user_group=" ) !== FALSE )
        {
            $this->tpl->copy_template = preg_replace( "#\\[user_group=(.+?)\\](.*?)\\[/user_group\\]#ies", "\$this->check_user_group('\\1', '\\2', '".$this->user_group."')", $this->tpl->copy_template );
        }
        $this->tpl->set( "{hint}", $this->tpl->result['online_user_hint'] );
		if ($val['id'] == 0) { //Гости
			$_nn = $this->online_list['guests_count'] + 1;
			//$val['name'] = "Гость-" . $_nn;
		}
		if ($val['id'] == 1) {
			if ($this->config["version_id"] >= "9.0") {
				$profile_url = "onclick=\"ShowProfile('".urlencode($val['name'])."', '".$profile_url."'); return false;\""." href=\"".$profile_url."/\"";
			} else {
				$profile_url = "href=\"".$profile_url."\"";
			}
		} else {
			$profile_url = ""; //Если НЕ пользователи, то и ссылки на профиль не должно быть
		}
		
		if ($val['id'] == 0) { //Гости
			$css_num = $this->online_config['num_col_guest'];
		} elseif ($val['id'] == 1) { //Пользователи
			$css_num = $this->online_config['num_col_user'];
		} elseif ($val['id'] == 2) { //Роботы
			$css_num = $this->online_config['num_col_robot'];
		} else {$css_num = 1;}
		$css_num_last = $this->online_config['num_col_last'];

		
		$this->tpl->set( "{user_name}", $val['name'] );
		$this->tpl->set( "{flag}", "<img src='{THEME}/online/flags/".$geoip->country_code."0.gif'>" );
		
		if ($this->online_config['show_user_group_color'] === "yes") {
			$this->tpl->set( '[group_color]', $this->user_groups[$this->user_group]['group_prefix'] );	
			$this->tpl->set( '[/group_color]', $this->user_groups[$this->user_group]['group_suffix'] );	
		} else {
			$this->tpl->set( '[group_color]', "" );	
			$this->tpl->set( '[/group_color]', "" );	
		}
		
		//
		
		//$user_group[$row['user_group']]['group_prefix'].$user_group[$row['user_group']]['group_name'].$user_group[$row['user_group']]['group_suffix'] );
		
        $this->tpl->set( "{profile}", $profile_url );

		if ($val['id'] != 1) { //НЕ Пользователи
			if ($css_num > 1 ) {
				$this->tpl->set( "{separator}", $this->online_config['separator_col'] );
			} else {
				$this->tpl->set( "{separator}", $this->online_config['separator'] );
			}
			$this->tpl->set( "{css_online_out}", "online_out".$css_num );
		}
		$this->tpl->compile( "online_user" );
        $this->tpl->clear( );
        return $this->tpl->result['online_user'];
    }

    private function check_user_group( $id, $text, $user_group )
    {
        if ( $id == $user_group )
        {
            return $text;
        }
        return FALSE;
    }

    public function getUserOS( $user_agent )
    {
        $os_arr = array( "Windows NT 4.0" => "Windows NT", "Windows NT 3.5" => "Windows NT", "Windows NT 5.0" => "Windows 2000", "Windows NT 5.1" => "Windows XP", "Windows NT 5.2" => "Windows XP x64 or Windows Server 2003", "Windows NT 6.0" => "Windows Vista", "Windows NT 6.1" => "Windows 7", "Windows CE" => "Windows CE or Windows Mobile", "Windows Me" => "Windows Me", "Windows 98" => "Windows 98", "Windows 95 " => "Windows 95", "Linux" => "Linux", "Lynx" => "Linux", "Unix" => "Linux", "Macintosh" => "Macintosh", "PowerPC" => "Macintosh", "OS/2" => "OS/2", "BeOS" => "BeOS" );
        foreach ( $os_arr as $key => $value )
        {
            if ( !strstr( strtolower( $user_agent ), strtolower( $key ) ) )
            {
                continue;
            }
            return $value;
        }
        return FALSE;
    }

    public function check_robot( $user_agent )
    {
        $robots = array( "Mail.Ru" => "Mail Ru", "spider" => "spider Bot", "robot" => "robot Bot", "crawl" => "crawl Bot", "msiecrawler" => "MSIE Crawler", "spider17" => "yandex.ru", "spider17.yandex.ru" => "Вот", "twiceler" => "Cuil", "googlebot" => "Google Bot", "mediapartners-google" => "Google AdSense", "slurp@inktomi" => "Hot Bot", "archive_org" => "Archive.org Bot", "Ask Jeeves" => "Ask Jeeves Bot", "Lycos" => "Lycos Bot", "WhatUSeek" => "What You Seek Bot", "ia_archiver" => "IA.Archiver Bot", "GigaBlast" => "Gigablast Bot", "Yahoo!" => "Yahoo Bot", "Yahoo-MMCrawler" => "Yahoo-MMCrawler Bot", "TurtleScanner" => "TurtleScanner Bot", "TurnitinBot" => "TurnitinBot", "ZipppBot" => "ZipppBot", "oBot" => "oBot", "rambler" => "Rambler Bot", "Jetbot" => "Jet Bot", "NaverBot" => "Naver Bot", "libwww" => "Punto Bot", "aport" => "Aport Bot", "msnbot" => "MSN Bot", "MnoGoSearch" => "mnoGoSearch Bot", "booch" => "Booch Bot", "Openbot" => "Openfind Bot", "scooter" => "Altavista Bot", "WebCrawler" => "Fast Bot", "WebZIP" => "WebZIP Bot", "GetSmart" => "GetSmart Bot", "grub-client" => "GrubClient Bot", "Vampire" => "Net_Vampire Bot", "Rambler" => "Rambler Bot", "appie" => "Walhello appie", "architext" => "ArchitextSpider", "jeeves" => "AskJeeves", "bjaaland" => "Bjaaland", "ferret" => "Wild Ferret Web Hopper #1, #2, #3", "gulliver" => "Northern Light Gulliver", "harvest" => "Harvest", "htdig" => "ht://Dig", "linkwalker" => "LinkWalker", "lycos_" => "Lycos", "moget" => "moget", "muscatferret" => "Muscat Ferret", "myweb" => "Internet Shinchakubin", "nomad" => "Nomad", "scooter" => "Scooter", "slurp" => "Inktomi Slurp", "voyager" => "Voyager", "weblayers" => "weblayers", "antibot" => "Antibot", "digout4u" => "Digout4u", "echo" => "EchO!", "fast-webcrawler" => "Fast-Webcrawler", "ia_archiver" => "Alexa (IA Archiver)", "jennybot" => "JennyBot", "mercator" => "Mercator", "netcraft" => "Netcraft", "petersnews" => "Petersnews", "unlost_web_crawler" => "Unlost Web Crawler", "voila" => "Voila", "webbase" => "WebBase", "wisenutbot" => "WISENutbot", "fish" => "Fish search", "abcdatos" => "ABCdatos BotLink", "acme.spider" => "Acme.Spider", "ahoythehomepagefinder" => "Ahoy! The Homepage Finder", "alkaline" => "Alkaline", "anthill" => "Anthill", "arachnophilia" => "Arachnophilia", "arale" => "Arale", "araneo" => "Araneo", "aretha" => "Aretha", "ariadne" => "ARIADNE", "arks" => "arks", "aspider" => "ASpider (Associative Spider)", "atn.txt" => "ATN Worldwide", "atomz" => "Atomz.com Search Robot", "auresys" => "AURESYS", "backrub" => "BackRub", "bbot" => "BBot", "bigbrother" => "Big Brother", "blackwidow" => "BlackWidow", "blindekuh" => "Die Blinde Kuh", "bloodhound" => "Bloodhound", "borg-bot" => "Borg-Bot", "brightnet" => "bright.net caching robot", "bspider" => "BSpider", "cactvschemistryspider" => "CACTVS Chemistry Spider", "calif" => "Calif", "cassandra" => "Cassandra", "cgireader" => "Digimarc Marcspider/CGI", "checkbot" => "Checkbot", "christcrawler" => "ChristCrawler.com", "churl" => "churl", "cienciaficcion" => "cIeNcIaFiCcIoN.nEt", "collective" => "Collective", "combine" => "Combine System", "conceptbot" => "Conceptbot", "coolbot" => "CoolBot", "core" => "Web Core / Roots", "cosmos" => "XYLEME Robot", "cruiser" => "Internet Cruiser Robot", "cusco" => "Cusco", "cyberspyder" => "CyberSpyder Link Test", "desertrealm" => "Desert Realm Spider", "deweb" => "DeWeb© Katalog/Index", "dienstspider" => "DienstSpider", "digger" => "Digger", "diibot" => "Digital Integrity Robot", "direct_hit" => "Direct Hit Grabber", "dnabot" => "DNAbot", "download_express" => "DownLoad Express", "dragonbot" => "DragonBot", "dwcp" => "DWCP (Dridus' Web Cataloging Project)", "e-collector" => "e-collector", "ebiness" => "EbiNess", "elfinbot" => "ELFINBOT", "emacs" => "Emacs-w3 Search Engine", "emcspider" => "ananzi", "esther" => "Esther", "evliyacelebi" => "Evliya Celebi", "fastcrawler" => "FastCrawler", "fdse" => "Fluid Dynamics Search Engine robot", "felix" => "Felix IDE", "fetchrover" => "FetchRover", "fido" => "fido", "finnish" => "Hдmдhдkki", "fireball" => "KIT-Fireball", "fouineur" => "Fouineur", "francoroute" => "Robot Francoroute", "freecrawl" => "Freecrawl", "funnelweb" => "FunnelWeb", "gama" => "gammaSpider, FocusedCrawler", "gazz" => "gazz", "gcreep" => "GCreep", "getbot" => "GetBot", "geturl" => "GetURL", "golem" => "Golem", "grapnel" => "Grapnel/0.01 Experiment", "griffon" => "Griffon", "gromit" => "Gromit", "gulperbot" => "Gulper Bot", "hambot" => "HamBot", "havindex" => "havIndex", "hometown" => "Hometown Spider Pro", "htmlgobble" => "HTMLgobble", "hyperdecontextualizer" => "Hyper-Decontextualizer", "iajabot" => "iajaBot", "iconoclast" => "Popular Iconoclast", "ilse" => "Ingrid", "imagelock" => "Imagelock", "incywincy" => "IncyWincy", "informant" => "Informant", "infoseek" => "InfoSeek Robot 1.0", "infoseeksidewinder" => "Infoseek Sidewinder", "infospider" => "InfoSpiders", "inspectorwww" => "Inspector Web", "intelliagent" => "IntelliAgent", "irobot" => "I, Robot", "iron33" => "Iron33", "israelisearch" => "Israeli-search", "javabee" => "JavaBee", "jbot" => "JBot Java Web Robot", "jcrawler" => "JCrawler", "jobo" => "JoBo Java Web Robot", "jobot" => "Jobot", "joebot" => "JoeBot", "jubii" => "The Jubii Indexing Robot", "jumpstation" => "JumpStation", "kapsi" => "image.kapsi.net", "katipo" => "Katipo", "kilroy" => "Kilroy", "ko_yappo_robot" => "KO_Yappo_Robot", "labelgrabber.txt" => "LabelGrabber", "larbin" => "larbin", "legs" => "legs", "linkidator" => "Link Validator", "linkscan" => "LinkScan", "lockon" => "Lockon", "logo_gif" => "logo.gif Crawler", "macworm" => "Mac WWWWorm", "magpie" => "Magpie", "marvin" => "marvin/infoseek", "mattie" => "Mattie", "mediafox" => "MediaFox", "merzscope" => "MerzScope", "meshexplorer" => "NEC-MeshExplorer", "mindcrawler" => "MindCrawler", "mnogosearch" => "mnoGoSearch search engine software", "momspider" => "MOMspider", "monster" => "Monster", "motor" => "Motor", "muncher" => "Muncher", "mwdsearch" => "Mwd.Search", "ndspider" => "NDSpider", "nederland.zoek" => "Nederland.zoek", "netcarta" => "NetCarta WebMap Engine", "netmechanic" => "NetMechanic", "netscoop" => "NetScoop", "newscan-online" => "newscan-online", "nhse" => "NHSE Web Forager", "northstar" => "The NorthStar Robot", "nzexplorer" => "nzexplorer", "objectssearch" => "ObjectsSearch", "occam" => "Occam", "octopus" => "HKU WWW Octopus", "openfind" => "Openfind data gatherer", "orb_search" => "Orb Search", "packrat" => "Pack Rat", "pageboy" => "PageBoy", "parasite" => "ParaSite", "patric" => "Patric", "pegasus" => "pegasus", "perignator" => "The Peregrinator", "perlcrawler" => "PerlCrawler 1.0", "phantom" => "Phantom", "phpdig" => "PhpDig", "piltdownman" => "PiltdownMan", "pimptrain" => "Pimptrain.com's robot", "pioneer" => "Pioneer", "pitkow" => "html_analyzer", "pjspider" => "Portal Juice Spider", "plumtreewebaccessor" => "PlumtreeWebAccessor", "poppi" => "Poppi", "portalb" => "PortalB Spider", "psbot" => "psbot", "python" => "The Python Robot", "raven" => "Raven Search", "rbse" => "RBSE Spider", "resumerobot" => "Resume Robot", "rhcs" => "RoadHouse Crawling System", "road_runner" => "Road Runner: The ImageScape Robot", "robbie" => "Robbie the Robot", "robi" => "ComputingSite Robi/1.0", "robocrawl" => "RoboCrawl Spider", "robofox" => "RoboFox", "robozilla" => "Robozilla", "roverbot" => "Roverbot", "rules" => "RuLeS", "safetynetrobot" => "SafetyNet Robot", "search-info" => "Sleek", "search_au" => "Search.Aus-AU.COM", "searchprocess" => "SearchProcess", "senrigan" => "Senrigan", "sgscout" => "SG-Scout", "shaggy" => "ShagSeeker", "shaihulud" => "Shai'Hulud", "sift" => "Sift", "simbot" => "Simmany Robot Ver1.0", "site-valet" => "Site Valet", "sitetech" => "SiteTech-Rover", "skymob" => "Skymob.com", "slcrawler" => "SLCrawler", "smartspider" => "Smart Spider", "snooper" => "Snooper", "solbot" => "Solbot", "speedy" => "Speedy Spider", "spider_monkey" => "spider_monkey", "spiderbot" => "SpiderBot", "spiderline" => "Spiderline Crawler", "spiderman" => "SpiderMan", "spiderview" => "SpiderView™", "spry" => "Spry Wizard Robot", "ssearcher" => "Site Searcher", "suke" => "Suke", "suntek" => "suntek search engine", "sven" => "Sven", "tach_bw" => "TACH Black Widow", "tarantula" => "Tarantula", "tarspider" => "tarspider", "techbot" => "TechBOT", "templeton" => "Templeton", "titan" => "TITAN", "titin" => "TitIn", "tkwww" => "The TkWWW Robot", "tlspider" => "TLSpider", "ucsd" => "UCSD Crawl", "udmsearch" => "UdmSearch", "urlck" => "URL Check", "valkyrie" => "Valkyrie", "verticrawl" => "Verticrawl", "victoria" => "Victoria", "visionsearch" => "vision-search", "voidbot" => "void-bot", "vwbot" => "VWbot", "w3index" => "The NWI Robot", "w3m2" => "W3M2", "wallpaper" => "WallPaper (alias crawlpaper)", "wanderer" => "the World Wide Web Wanderer", "wapspider" => "w@pSpider by wap4.com", "webbandit" => "WebBandit Web Spider", "webcatcher" => "WebCatcher", "webcopy" => "WebCopy", "webfetcher" => "webfetcher", "webfoot" => "The Webfoot Robot", "webinator" => "Webinator", "weblinker" => "WebLinker", "webmirror" => "WebMirror", "webmoose" => "The Web Moose", "webquest" => "WebQuest", "webreader" => "Digimarc MarcSpider", "webreaper" => "WebReaper", "websnarf" => "Websnarf", "webspider" => "WebSpider", "webvac" => "WebVac", "webwalk" => "webwalk", "webwalker" => "WebWalker", "webwatch" => "WebWatch", "whatuseek" => "whatUseek Winona", "whowhere" => "WhoWhere Robot", "wired-digital" => "Wired Digital", "wmir" => "w3mir", "wolp" => "WebStolperer", "wombat" => "The Web Wombat", "worm" => "The World Wide Web Worm", "wwwc" => "WWWC Ver 0.2.5", "wz101" => "WebZinger", "xget" => "XGET", "awbot" => "AWBot", "baiduspider" => "BaiDuSpider", "bobby" => "Bobby", "boris" => "Boris", "bumblebee" => "Bumblebee (relevare.com)", "cscrawler" => "CsCrawler", "daviesbot" => "DaviesBot", "exactseek" => "ExactSeek Crawler", "ezresult" => "sEzresult", "gigabot" => "GigaBot", "gnodspider" => "sGNOD Spider", "grub" => "Grub.org", "henrythemiragorobot" => "Mirago", "holmes" => "Holmes", "internetseer" => "InternetSeer", "justview" => "JustView", "linkbot" => "LinkBot", "linkchecker" => "LinkChecker", "metager-linkchecker" => "MetaGer LinkChecker", "microsoft_url_control" => "Microsoft URL Control", "nagios" => "Nagios", "perman" => "Perman surfer", "pompos" => "Pompos", "rambler" => "StackRambler", "redalert" => "Red Alert", "shoutcast" => "Shoutcast Directory Service", "slysearch" => "SlySearch", "surveybot" => "SurveyBot", "turnitinbot" => "Turn It In", "turtle" => "Turtle", "turtlescanner" => "Turtle", "ultraseek" => "Ultraseek", "webclipping.com" => "WebClipping.com", "webcompass" => "webcompass", "wonderer" => "spider: Web Wombat Redback Spider", "yahoo-verticalcrawler" => "Yahoo Vertical Crawler", "zealbot" => "ZealBot", "zyborg" => "Zyborg", "BecomeBot" => "Become Bot", "Yandex" => "Yandex Bot", "StackRambler" => "Rambler Bot", "ask jeeves" => "Ask Jeeves Bot", "lycos" => "Lycos.com Bot", "whatuseek" => "What You Seek Bot", "ia_archiver" => "Archive.org Bot" );
        foreach ( $robots as $key => $value )
        {
            if ( !strstr( strtolower( $user_agent ), strtolower( $key ) ) )
            {
                continue;
            }
            return $value;
        }
        return FALSE;
    }

    public function clear( )
    {
        $this->user_id = NULL;
        $this->user_name = NULL;
        $this->user_ip = NULL;
        $this->time = NULL;
        $this->user_location = NULL;
        $this->user_group = NULL;
        $this->user_proxy = NULL;
        $this->user_agent = NULL;
        $this->user_OS = NULL;
        $this->user_foto = NULL;
    }



	public function __construct()
	{
		$this->whoonlock = ENGINE_DIR."/data/whoonlock.txt";
		$this->whoonline = ENGINE_DIR."/data/whoonline.txt";
		$this->whoonline_reserve = ENGINE_DIR."/data/whoonline_reserve.txt";
	}
	
	private function read_online()
	{
		global $css_num, $css_num_last;
		$_alls = $this->online_config['limit_users'] + $this->online_config['limit_robots']+5;
		$lines = $result = array();
		$result[] = $this->info();
		$tusers = $trobots = $tguests = "" ;
		
		$_readok = 0;
		for($_ii=0; $_ii<5; $_ii++){
			if(false != ($file_user=@file_get_contents($this->whoonline))) {
				$lines = (array)unserialize($file_user);	
				$_readok = 1;
				break;
			}
		}
		if ($_readok == 0) { //Бяда....
			$lines = (array)unserialize(@file_get_contents($this->whoonline_reserve));
		}
		
		
		//----------------------------------
		if ($result[0]["id"] == 0) { //Гости
			++$this->online_list['guests_count'];
			//$result[0]["name"] = "Гость-1";
			$tguests = $this->arruser($result[0]) ;
		}
		if ($result[0]["id"] == 1) { //Пользователи
			++$this->online_list['users_count'];
			$tusers = $this->arruser($result[0]) ;

			$t_users = $tusers;
			if ($css_num > 1 ) {
				$tusers = str_replace("{separator}", $this->online_config['separator_col'], $tusers);
			} else {
				$tusers = str_replace("{separator}", $this->online_config['separator'], $tusers);
			}
			$tusers = str_replace("{css_online_out}", "online_out".$css_num, $tusers);

			++$this->online_list['twenty_users_count'];

			if ($css_num_last > 1 ) {
				$twenty_users = str_replace("{separator}", $this->online_config['separator_col'], $t_users);
			} else {
				$twenty_users = str_replace("{separator}", $this->online_config['separator'], $t_users);
			}
			$twenty_users = str_replace("{css_online_out}", "online_out".$css_num_last, $twenty_users);

			$twenty_users_count = $this->arruser($result[0]) ;
		}
		if ($result[0]["id"] == 2) { //Роботы
			++$this->online_list['robots_count'];
			$trobots = $this->arruser($result[0]) ;
		}
		++$this->online_list['all']; //Всего
		//----------------------------------

		foreach($lines as $arr)
		{
			$_add = 0;
			if( ($arr['id'] == 0) && ($result[0]["ip"] != $arr["ip"]) && (time() + $this->date_adjust - $arr["time"] < $this->live) ) {//Гость  и не просрочен
				$this->start($arr['id'], $arr['name'], $arr['ip'], $arr['time'], $arr['position'], $arr['groupid'], $arr['proxy'], $arr['browser'], $arr['os'], $arr['foto']);
				$tusr = $this->arruser($arr);
				$result[] = $arr;
				++$this->online_list['guests_count'];
				++$this->online_list['all']; //Всего
				if ($this->online_list['guests_count'] <= $this->online_config['limit_guests']) {
					$tguests = $tguests . $tusr ;
				}
				$_add = 1;
			}
			if( ($arr['id'] == 1) && ($result[0]["name"] != $arr["name"]) && (time() + $this->date_adjust - $arr["time"] < $this->live) ) {//Пользователь  и не просрочен
				$this->start($arr['id'], $arr['name'], $arr['ip'], $arr['time'], $arr['position'], $arr['groupid'], $arr['proxy'], $arr['browser'], $arr['os'], $arr['foto']);
				$tusr = $this->arruser($arr);
				
			$t_users = $tusr;
			if ($css_num > 1 ) {
				$tusr = str_replace("{separator}", $this->online_config['separator_col'], $tusr);
			} else {
				$tusr = str_replace("{separator}", $this->online_config['separator'], $tusr);
			}
			$tusr = str_replace("{css_online_out}", "online_out".$css_num, $tusr);
			
				$result[] = $arr;
				++$this->online_list['users_count'];
				++$this->online_list['all']; //Всего
				if ($this->online_list['users_count'] <= $this->online_config['limit_users']) {
					$tusers = $tusers . $tusr ;
				}
				/* Топ пользователей */

			if ($css_num_last > 1 ) {
				$twenty_users_t = str_replace("{separator}", $this->online_config['separator_col'], $t_users);
			} else {
				$twenty_users_t = str_replace("{separator}", $this->online_config['separator'], $t_users);
			}
			$twenty_users_t = str_replace("{css_online_out}", "online_out".$css_num_last, $twenty_users_t);

				$twenty_users = $twenty_users . $twenty_users_t;
				++$this->online_list['twenty_users_count'];
				/*------------------ */
				$_add = 1;
			}
			if( ($arr['id'] == 2) && ($result[0]["name"] != $arr["name"]) && (time() + $this->date_adjust - $arr["time"] < $this->live) ) {//Робот  и не просрочен
				$this->start($arr['id'], $arr['name'], $arr['ip'], $arr['time'], $arr['position'], $arr['groupid'], $arr['proxy'], $arr['browser'], $arr['os'], $arr['foto']);
				$tusr = $this->arruser($arr);
				$result[] = $arr;
				++$this->online_list['robots_count'];
				++$this->online_list['all']; //Всего
				if ($this->online_list['robots_count'] <= $this->online_config['limit_robots']) {
					$trobots = $trobots . $tusr ;
				}
				$_add = 1;
			}
			if ($_add == 0) { //Просрочен клиет. Смотрим, нужно ли его в топ добавлять...
				if( ($arr['id'] == 1) && ($result[0]["name"] != $arr["name"]) && ($this->online_list['twenty_users_count'] < $this->online_config['limit_users']) ) { //Если это пользователь (гости и роботы нас не интересуют)
					$this->start($arr['id'], $arr['name'], $arr['ip'], $arr['time'], $arr['position'], $arr['groupid'], $arr['proxy'], $arr['browser'], $arr['os'], $arr['foto']);
					$tusr = $this->arruser($arr);
					$result[] = $arr;

			$t_users = $tusr;
			if ($css_num_last > 1 ) {
				$twenty_users_t = str_replace("{separator}", $this->online_config['separator_col'], $t_users);
			} else {
				$twenty_users_t = str_replace("{separator}", $this->online_config['separator'], $t_users);
			}
			$twenty_users_t = str_replace("{css_online_out}", "online_out".$css_num_last, $twenty_users_t);
					
					
					$twenty_users = $twenty_users . $twenty_users_t;
					++$this->online_list['twenty_users_count']; //Всего
				}
			}
		}
		$this->online = $result;
		$this->online_list['guests'] = $tguests;
		$this->online_list['users'] = $tusers;
		$this->online_list['robots'] = $trobots;
		$this->online_list['twenty_users'] = $twenty_users;

	}
	private function write()
	{
		$lock = fopen($this->whoonlock, "a+");
		if(flock($lock, LOCK_EX+LOCK_NB)) 
		{
			$file = fopen($this->whoonline, "w");
			fwrite($file, serialize($this->online));
			fflush($file);
			fclose($file);
			//------------------------
/*			$file = fopen($this->whoonline_reserve, "w");
			fwrite($file, serialize($this->online));
			fflush($file);
			fclose($file);*/
			//---------------------------
			flock($lock, LOCK_UN);
		}
		fclose($lock);
		copy($this->whoonlock , $this->whoonline_reserve);
	}
	
	public function GetOnUser($live)
	{
		global $config;
		$this->live = $live;
		$this->read_online();
		$this->write();
		
		return $this->online;		
	}
}

require_once ROOT_DIR.'/engine/data/online_config.php';

$whoonline = new whoonline();
$whoonline->tpl = $tpl;
$whoonline->member_id = $member_id;
$whoonline->user_groups = $user_group;
$whoonline->config = $config;
$whoonline->online_config = $online_config;
$whoonline->online_list['guests'] = NULL;
$whoonline->online_list['guests_count'] = 0;
$whoonline->online_list['robots'] = NULL;
$whoonline->online_list['robots_count'] = 0;
$whoonline->online_list['users'] = NULL;
$whoonline->online_list['users_count'] = 0;
$whoonline->online_list['twenty_users'] = NULL;
$whoonline->online_list['twenty_users_count'] = 0;
$whoonline->online_list['all'] = 0;


?>
