<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace ValidationClosures;

class Utils
{
	public static function invert(\Closure $closure)
	{
		return function (string $value) use ($closure)
		{
			return !$closure($value);
		};
	}
}