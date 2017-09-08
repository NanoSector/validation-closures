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

		return function ($value) use ($minimumLength, $maximumLength)
		{
			return Types::string()($value) && static::intBetween($minimumLength, $maximumLength)(strlen($value));
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
        if ($maximum <= $minimum)
            throw new \InvalidArgumentException('Maximum can not be lesser than or equal to minimum.');
        
		return function ($value) use ($minimum, $maximum)
		{
			return Types::int()($value) && ($value >= $minimum && $value <= $maximum);
		};
	}

    /**
     * @param int $minimum
     * @param int $maximum
     *
     * @return \Closure
     */
    public static function intBetweenExclusive(int $minimum, int $maximum): \Closure
    {
        if ($maximum <= $minimum)
            throw new \InvalidArgumentException('Maximum can not be lesser than or equal to minimum.');
        
        return function ($value) use ($minimum, $maximum)
        {
            return Types::int()($value) && ($value > $minimum && $value < $maximum);
        };
	}

	/**
	 * @param float $minimum
	 * @param float $maximum
	 *
	 * @return \Closure
	 */
	public static function floatBetween(float $minimum, float $maximum): \Closure
	{
        if ($maximum <= $minimum)
            throw new \InvalidArgumentException('Maximum can not be lesser than or equal to minimum.');
        
		return function ($value) use ($minimum, $maximum)
		{
			return Types::float()($value) && ($value >= $minimum && $value <= $maximum);
		};
	}

    /**
     * @param float $minimum
     * @param float $maximum
     *
     * @return \Closure
     */
    public static function floatBetweenExclusive(float $minimum, float $maximum): \Closure
    {
        if ($maximum <= $minimum)
            throw new \InvalidArgumentException('Maximum can not be lesser than or equal to minimum.');
        
        return function ($value) use ($minimum, $maximum)
        {
            return Types::float()($value) && ($value > $minimum && $value < $maximum);
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
		if (!Utils::validateArray(Types::string(), $allowedValues))
			throw new \InvalidArgumentException('Ranges::stringOneOf expects arguments of type string only');

		return function ($value) use ($allowedValues)
		{
			return Types::string() && in_array($value, $allowedValues);
		};
	}
}