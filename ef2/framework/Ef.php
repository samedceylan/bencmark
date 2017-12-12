<?php

/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2;


class Ef
{

	private static $app;


	public static function app()
	{

		if (self::$app === null) {
			self::$app = new App();
		}

		return self::$app;
	}


}