<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace ValidationClosures;


class Ranges
{
	/**
	 * @param int $minimumLength
	 * @param int $maximumLength
	 *
	 * @return \Closure
	 */
	public static function stringWithLengthBetween(int $minimumLength, int $maximumLength): \Closure
	{
		if ($maximumLength < 0 || $maximumLength < 1)
			throw new \InvalidArgumentException('Minimum length cannot be below 0, maximum length cannot be below 1');

		return function (string $value) use ($minimumLength, $maximumLength)
		{
			return strlen($value) >= $minimumLength && strlen($value) <= $maximumLength;
		};
	}

	/**
	 * @param int $minimum
	 * @param int $maximum
	 *
	 * @return \Closure
	 */
	public static function intBetween(int $minimum, int $maximum): \Closure
	{
		return function (int $value) use ($minimum, $maximum)
		{
			return $value >= $minimum && $value <= $maximum;
		};
	}

	/**
	 * @param array ...$allowedValues
	 *
	 * @return \Closure
	 */
	public static function enum(...$allowedValues): \Closure
	{
		return function ($value) use ($allowedValues)
		{
			return in_array($value, $allowedValues, true);
		};
	}

	/**
	 * @param array ...$allowedTypes
	 *
	 * @return \Closure
	 */
	public static function typeEnum(...$allowedTypes): \Closure
	{
		return function ($value) use ($allowedTypes)
		{
			return in_array(gettype($value), $allowedTypes, true);
		};
	}

	/**
	 * @param array ...$allowedValues
	 *
	 * @return \Closure
	 */
	public static function stringOneOf(...$allowedValues): \Closure
	{
		return function (string $value) use ($allowedValues)
		{
			return in_array($value, $allowedValues);
		};
	}
}