<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Http;


class Security
{

	function __construct($scanRequest = false)
	{
		if ($scanRequest) {
			$_POST = array_map(array($this, 'scan'), $_POST);
			$_GET = array_map(array($this, 'scan'), $_GET);
		}
	}

	/**
	 * USER_AGENT gibi değerleri de tarayabilmek için, XSS, CROSS-SITE XHR, SQL Injection temizleme
	 *
	 * @param $mix
	 * @return mixed
	 */
	public function scan($mix)
	{
		$keys = array_keys(array('#[a-zA-Z0-9_]=(\.\.//?)+#s' => '',
								 '#[a-zA-Z0-9_]=/([a-z0-9_.]//?)+#s' => '',
								 '#\=PHP[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}#s' => '',
								 '#(\.\./|\.\.)#s' => '',
								 '#ftp\:#s' => '',
								 '#http\:#s' => '',
								 '#https\:#s' => '',
								 '#\=\|w\|#s' => '',
								 '#^(.*)/self/(.*)$#s' => '',
								 '#^(.*)cPath=http://(.*)$#s' => '',
								 '#^(.*)on([a-zA-Z0-9]*)=(.*)$#s' => '',
								 '#(\<|%3C).*script.*(\>|%3E)#s' => '',
								 '#(<|%3C)([^s]*s)+cript.*(>|%3E)#s' => '',
								 '#(\<|%3C).*iframe.*(\>|%3E)#s' => '',
								 '#(<|%3C)([^i]*i)+frame.*(>|%3E)#s' => '',
								 '#base64_encode.*\(.*\)#s' => '',
								 '#base64_(en|de)code[^(]*\([^)]*\)#s' => '',
								 '#GLOBALS(=|\[|\%[0-9A-Z]{0,2})#s' => '',
								 '#_REQUEST(=|\[|\%[0-9A-Z]{0,2})#s' => '',
								 '#^.*(\[|\]|\(|\)|<|>).*#s' => '',
								 '#(NULL|OUTFILE|LOAD_FILE|XOR)#s' => '',
								 '#(\./|\../|\.../)+(motd|etc|bin)#s' => '',
								 '#(localhost|loopback|127\.0\.0\.1)#s' => '',
								 '#(<|>|\'|%0A|%0D|%27|%3C|%3E|%00)#s' => '',
								 '#concat[^\(]*\(#s' => '',
								 '#union([^s]*s)+elect#s' => '',
								 '#union([^a]*a)+ll([^s]*s)+elect#s' => '',
								 '#(;|<|>|\'|"|\)|%0A|%0D|%22|%27|%3C|%3E|%00).*(/\*|union|select|sleep|insert|drop|delete|update|cast|create|char|convert|alter|declare|order|script|set|md5|benchmark|encode)#s' => '',
								 '#(if\()#s' => ''));
		return preg_replace($keys, '', $mix);
	}
}