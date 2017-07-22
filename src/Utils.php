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
	/**
	 * @param \Closure $closure
	 *
	 * @return \Closure
	 */
	public static function invert(\Closure $closure)
	{
		return function ($value) use ($closure)
		{
			return !$closure($value);
		};
	}
}