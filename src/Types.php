<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace ValidationClosures;

class Types
{
	/**
	 * @return \Closure
	 */
	public static function string(): \Closure
	{
		return \Closure::fromCallable('is_string');
	}

	/**
	 * @return \Closure
	 */
	public static function int(): \Closure
	{
		return \Closure::fromCallable('is_int');
	}

	/**
	 * @return \Closure
	 */
	public static function float(): \Closure
	{
		return \Closure::fromCallable('is_float');
	}

	/**
	 * @return \Closure
	 */
	public static function boolean(): \Closure
	{
		return \Closure::fromCallable('is_bool');
	}

	/**
	 * @return \Closure
	 */
	public static function array(): \Closure
	{
		return \Closure::fromCallable('is_array');
	}

	/**
	 * @return \Closure
	 */
	public static function callable(): \Closure
	{
		return \Closure::fromCallable('is_callable');
	}

	/**
	 * @return \Closure
	 */
	public static function object(): \Closure
	{
		return \Closure::fromCallable('is_object');
	}

	/**
	 * @param string $class
	 *
	 * @return \Closure
	 */
	public static function instanceof(string $class): \Closure
	{
		return function ($value) use ($class)
		{
			return $value instanceof $class;
		};
	}
}