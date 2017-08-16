<?php

namespace Silverorange\Turing\Utils;

class URL
{

	public static function join($a, $b)
	{
		return rtrim($a, '/').'/'.ltrim($b, '/');
	}

	public static function normalize($base, $url)
	{
		if (preg_match('!^https?://!', $url) === 0) {
			return self::join($base, $url);
		}

		return $url;
	}

}

?>
