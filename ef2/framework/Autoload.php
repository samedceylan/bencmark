<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2;


class Autoload
{

	private static $appDirs = [];

	/**
	 * @param $className
	 *
	 * include class
	 */

	private static function autoloadFramework($className)
	{


		$className = ltrim($className, '\\');
		$parts = explode("\\", $className);

		$fileName = '';
		$namespace = '';


		if ($lastNsPos = strrpos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			$fileName = EF2_PATH . str_replace($parts[0], "", $fileName);

		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

		if (is_file($fileName))
			require $fileName;


	}

	public static function autoloadApp($className)
	{
		$className = ltrim($className, '\\');

		$fileName = '';
		$namespace = '';

		if (strrpos($className, '\\')) {
			$lastNsPos = strrpos($className, '\\');
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName = str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}


		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . ".php";

		foreach (self::$appDirs as $value) {

			$len = strlen($value);

			if (substr($value, $len - 1, $len) != "/") {

				$value = $value . DIRECTORY_SEPARATOR;

			}


			if (is_file($value . $fileName)) {

				require($value . $fileName);
				break;

			}
		}
	}


	/**
	 * autoload register
	 *
	 * @param $config
	 */

	public function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoloadFramework'), true, true);
	}

	/**
	 * autoload register
	 *
	 * @param $config
	 */

	public static function registerApp($appDirs)
	{
		self::$appDirs = $appDirs;
		spl_autoload_register(array(__CLASS__, 'autoloadApp'), true, true);
	}


}