<?php
require "core/init.php";

$live = $live ? $live : 300;
$template = $template ? $template : "whoonline";

class whoonline_function
{
	private $user_id		=	null;
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
		$this->robots($_SERVER["HTTP_USER_AGENT"]);
		if(!$this->robots)
		{
			$this->user_os($_SERVER["HTTP_USER_AGENT"]);
			$this->user_browser($_SERVER["HTTP_USER_AGENT"]);
		}
		$this->user_info();
		$this->user_position();
		
		return array(
			"time"		=>	time() + $this->date_adjust,
			"ip"		=>	$_IP ? $_IP : $_SERVER["REMOTE_ADDR"],
			"name"		=>	$this->user_name,
			"id"		=>	$this->user_id,
			"foto"		=>	$this->user_foto,
			"group"		=>	$this->user_group,
			"groupid"	=>	$this->user_groupid,
			"os"		=>	$this->user_os,
			"browser"	=>	$this->user_browser,
			"position"	=>	$this->user_position
		);
	}
	
	private function robots($useragent)
	{
        $arr = array("#.*(yandex|yadirectbot).*#si" => "Yandex", "#.*(google|accoona|gsa-crawler).*#si" => "Google", "#.*rambler.*#si" => "Rambler", '#.*mail.ru.*#si' => "Mail Ru", "#.*aport.*#si" => "Aport", "#.*TurtleScanner.*#si" => "Turtle", "#.*slurp.*#si" => "Inktomi Spider", "#.*msnbot.*#si" => "Msn", "#.*(askjeeves|ask jeeves).*#si" => "Ask Com", "#.*yahoo.*#si" => "Yahoo", "#.*scooter.*#si" => "AltaVista", "#.*lycos.*#si" => "Lycos.com", "#.*libwww.*#si" => "Punto", "#.*picsearch.*#si" => "PicSearch", "#.*mnogosearch.*#si" => "mnoGoSearch", "#.*(is_archiver|archive_org).*#si" => "Archive Org", "#.*W3C_Validator.*#si" => "W3C Validator", "#.*W3C_CSS_Validator.*#si" => "W3C CSS Validator");
        $result = preg_replace(array_keys($arr), $arr, $useragent);
        $this->robots = $result == $useragent ? $this->robots : $result;
	}
	
	private function user_os($useragent)
	{
		$arr = array("#.*Windows NT 5.1.*#si" => "Windows XP", "#.*Windows NT 5.2.*#si" => "Windows XP x64 or Server 2003", "#.*Windows NT 6.0.*#si" => "Windows Vista", "#.*Windows NT 6.1.*#si" => "Windows 7", "#.*Windows NT 5.0.*#si" => "Windows 2000", "#.*(Windows NT 4.0|Windows NT 3.5).*#si" => "Windows NT", "#.*Windows CE.*#si" => "Windows CE or Mobile", "#.*Windows Me.*#si" => "Windows ME", "#.*Windows 98.*#si" => "Windows 98", "#.*Windows 95.*#si" => "Windows 95", "#.*(Linux|Lynx|Unix).*#si" => "Linux", "#.*(Macintosh|PowerPC).*#si" => "MacOS", "#.*OS/2.*#si" => "OS/2", "#.*BeOS.*#si" => "BeOS");
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
			$this->user_name = "Гость";
			$this->user_group = "гости";
		}
	}
	
	private function user_position()
	{
		global $cat_info, $category_id, $dle_module, $nam_e, $titl_e;
		$result = "Просматривает главную страницу";
		switch($dle_module)
		{
			case "main":			$result = "Просматривает главную страницу"; break;
			case "showfull":		$result = $titl_e ? "Просматривает новость: $titl_e" : "Просматривает страницу: Error 404"; break;
			case "alltags":			$result = "Просматривает облако тегов"; break;
			case "cat":				$result = $cat_info[$category_id]["name"] ? "Просматривает категорию: {$cat_info[$category_id]["name"]}" : "Просматривает категорию: Error 404"; break;
			case "favorites":		$result = "Просматривает избранные статьи"; break;
			case "lastcomments":	$result = "Просматривает последние комментарии"; break;
			case "lastnews":		$result = "Просматривает последние новости"; break;
			case "rules":			$result = "Просматривает правила сайта"; break;
			case "static":			$result = $titl_e ? "Просматривает страницу: $titl_e" : "Просматривает страницу: Error 404"; break;
			case "stats":			$result = "Просматривает статистику сайта"; break;
			case "tags":			$result = "Просматривает облако тегов"; break;
			case "userinfo":		$result = $nam_e ? "Просматривает профиль: $nam_e" : "Просматривает профиль: Error 404"; break;
			case "addcomment":		$result = "Добавляет комментарий"; break;
			case "addnews":			$result = "Добавляет новость"; break;
			case "comments":		$result = "Добавляет комментарий"; break;
			case "allnews":			$result = $nam_e ? "Находится в разделе: $nam_e" : "Находится в разделе: Errror 404"; break;
			case "feedback":		$result = $nam_e ? "Находится в разделе: $nam_e" : "Находится в разделе: Errror 404"; break;
			case "pm":				$result = $nam_e ? "Находится в разделе: $nam_e" : "Находится в разделе: Errror 404"; break;
		}
		$this->user_position = addslashes(htmlspecialchars($result));
	}
}

class whoonline extends whoonline_function
{
	private $template = null;
	private $live = null;
	private $whoonlock = null;
	private $whoonline = null;
	private $online = array();
	
	public function __construct()
	{
		$this->whoonlock = ENGINE_DIR."/data/whoonlock.txt";
		$this->whoonline = ENGINE_DIR."/data/whoonline.txt";
	}
	
	private function read()
	{
		$lines = $result = array();
		$result[] = $this->info();
		$lines = (array)unserialize(@file_get_contents($this->whoonline));
		foreach($lines as $arr)
		{
			if((in_array($result[0]["id"], array(1,2))) && (time() + $this->date_adjust - $arr["time"] < $this->live) && ($result[0]["ip"] != $arr["ip"]) && ($result[0]["name"] != $arr["name"])) $result[] = $arr;
			elseif(($result[0]["id"] == 0) && (time() + $this->date_adjust - $arr["time"] < $this->live) && ($result[0]["ip"] != $arr["ip"])) $result[] = $arr;
		}
		$this->online = $result;
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
			flock($lock, LOCK_UN);
		}
		fclose($lock);
	}
	
	public function view($template, $live)
	{
		global $config, $view;
		$this->live = $live;
		$this->template = $template;
		$this->read();
		$this->write();
		$view->set("online", $this->online);
		$view->set("config", array("allow_alt_url" => $config["allow_alt_url"], "seo_type" => $config["seo_type"], "skin" => $config["skin"], "home_url" => $config["http_home_url"]));
		
		return $view->display($this->template);		
	}
}

$whoonline = new whoonline();
echo $whoonline->view($template, $live);
unset($live, $template, $whoonline);
?>