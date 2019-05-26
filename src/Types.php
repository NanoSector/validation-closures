<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace ValidationClosures;

use Closure;

class Types
{
	/**
	 * @return Closure
	 */
	public static function string(): Closure
	{
		return Utils::createClosureFromCallable('is_string');
	}

	/**
	 * @return Closure
	 */
	public static function int(): Closure
	{
		return Utils::createClosureFromCallable('is_int');
	}

	/**
	 * @return Closure
	 */
	public static function float(): Closure
	{
		return Utils::createClosureFromCallable('is_float');
	}

	/**
	 * @return Closure
	 */
	public static function boolean(): Closure
	{
		return Utils::createClosureFromCallable('is_bool');
	}

	/**
	 * @return Closure
	 */
	public static function array(): Closure
	{
		return Utils::createClosureFromCallable('is_array');
	}

	/**
	 * @return Closure
	 */
	public static function callable(): Closure
	{
		return Utils::createClosureFromCallable('is_callable');
	}

	/**
	 * @return Closure
	 */
	public static function object(): Closure
	{
		return Utils::createClosureFromCallable('is_object');
	}

    /**
     * @return Closure
     */
    public static function numeric(): Closure
    {
        return Utils::createClosureFromCallable('is_numeric');
	}

	/**
	 * @param string $class
	 *
	 * @return Closure
	 */
	public static function instanceof(string $class): Closure
	{
		return static function ($value) use ($class)
		{
			return $value instanceof $class;
		};
	}
}