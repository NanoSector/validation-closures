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
	public static function invert(\Closure $closure): \Closure
	{
		return function ($value) use ($closure)
		{
			return !$closure($value);
		};
	}

	/**
	 * @param \Closure $closure1
	 * @param \Closure $closure2
	 *
	 * @return \Closure
	 */
	public static function merge(\Closure $closure1, \Closure $closure2): \Closure
	{
		return function ($value) use ($closure1, $closure2)
		{
			return $closure1($value) || $closure2($value);
		};
	}

	/**
	 * @param \Closure $closure1
	 * @param \Closure $closure2
	 *
	 * @return \Closure
	 */
	public static function both(\Closure $closure1, \Closure $closure2): \Closure
	{
		return function ($value) use ($closure1, $closure2)
		{
			return $closure1($value) && $closure2($value);
		};
	}

	/**
	 * @param \Closure $closure
	 * @param array $values
	 *
	 * @return bool
	 */
	public static function validateArray(\Closure $closure, array $values): bool
	{
		foreach ($values as $value)
			if (!$closure($value))
				return false;

		return true;
	}
}