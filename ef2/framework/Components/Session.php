<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Components;

class Session
{
	private $security;
	private $iv;

	public function setSecurity($security)
	{
		$this->security = md5(sha1($security));
	}

	public function register()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return bool
	 */
	public function set($key, $value)
	{
		$_SESSION[$this->security . md5(sha1($key))] = $this->encrypt($value);

		if ($_SESSION[$this->security . md5(sha1($key))]) {
			return true;
		}

		return false;
	}

	/**
	 * @param $key
	 *
	 * @return session or false
	 */
	public function get($key)
	{
		if (isset($_SESSION[$this->security . md5(sha1($key))])) {
			return trim($this->decrypt($_SESSION[$this->security . md5(sha1($key))]));
		}

		return false;
	}

	public function reset()
	{
		foreach ($_SESSION as $key => $value) {
			$key = str_replace($this->security, "", $key);
			unset($_SESSION[$this->security . $key]);
		}
	}

	public function remove($key)
	{
		if (isset($_SESSION[$this->security . md5(sha1($key))])) {
			unset($_SESSION[$this->security . md5(sha1($key))]);

			return true;
		}

		return false;
	}

	public function isSessionStart()
	{
		if (session_status() == PHP_SESSION_NONE) {
			return false;
		}

		return true;
	}

	private function iv()
	{
		return substr(hash('sha256', $this->security), 0, 16);
	}

	private function encrypt($str)
	{
		return base64_encode(openssl_encrypt($str, "AES-256-CBC", $this->security, 0, $this->iv()));
	}

	private function decrypt($str)
	{
		return openssl_decrypt(base64_decode($str), "AES-256-CBC", $this->security, 0, $this->iv());
	}
}