<?php
namespace TwigExtensions;

class Currency {
	
	private static $codes = array(
		'GBP' => array(
			'format' => "%01.2f", 
			'sign' => "&pound"
		),
	);

	public static function formatWithSign($value, $iso=null) {
		return self::$codes[$iso]['sign'] . self::format($value, $iso);
	}

	public static function format($value, $iso=null) {
		return  sprintf(self::$codes[$iso]['format'], $value);
	}
}