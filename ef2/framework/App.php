<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2;

use EF2\Core\EventManager;

class App
{
	private $data = [];

	public function __construct()
	{
		$this->data["baseurl"] = self::baseUrl();
		$this->data["ip"] = $this->getIP();

		$config = EventManager::pull("config");

		if ($config != false) {
			foreach ($config as $key => $value) {
				$this->data[$key] = $value;
			}
		}
	}

	public function __get($name)
	{
		$this->data["controller"] = str_replace("controller", "", strtolower(Framework::$controller));
		$this->data["action"] = str_replace("action", "", strtolower(Framework::$action));

		if (isset($this->data[strtolower($name)])) {
			return $this->data[strtolower($name)];
		}
	}

	/**
	 * Kullanıcı IP adresi getirir
	 * @return ip addres
	 */
	private function getIP()
	{
		if (getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode(',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
			$ip = getenv("REMOTE_ADDR");
		}

		return $ip;
	}

	public function redirect($str, $term = 0)
	{
		if ($term == 0) {
			header("Location: " . self::baseUrl() . "/" . $str);
		} else {
			header("refresh:" . $term . ";url=" . self::baseUrl() . "/" . $str);
		}

		exit();
	}

	public function isAjax()
	{
		if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && !empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
			return true;
		}
	}

	public function GetMethod()
	{
		return (isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : 'GET');
	}

	public function isPost()
	{
		if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
			return true;
		}
	}

	public function isGet()
	{
		if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "GET") {
			return true;
		}
	}

	public static function baseUrl()
	{
		return str_replace("/index.php", "", $_SERVER["SCRIPT_NAME"]);
	}
}