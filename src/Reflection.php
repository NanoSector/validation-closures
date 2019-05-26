<?php

/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace ValidationClosures;

use Closure;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

/**
 * Class Reflection
 * @package ValidationClosures
 *
 * Taken from \ReflectionClass; all methods which could be used properly as a validation closure.
 * Nothing stops you from using the other methods though, but they'll be less useful as a validation mechanism.
 * @method static bool hasConstant(string $name)
 * @method static bool hasMethod(string $name)
 * @method static bool hasProperty(string $name)
 * @method static bool implementsInterface(string $interface)
 * @method static bool inNamespace()
 * @method static bool isAbstract()
 * @method static bool isAnonymous()
 * @method static bool isCloneable()
 * @method static bool isFinal()
 * @method static bool isInstance(object $object)
 * @method static bool isInstantiable()
 * @method static bool isInterface()
 * @method static bool isInternal()
 * @method static bool isIterateable()
 * @method static bool isSubclassOf(string $class)
 * @method static bool isTrait()
 * @method static bool isUserDefined()
 *
 */
class Reflection
{
    /**
     * @param string $class
     *
     * @return ReflectionClass
     * @throws ReflectionException
     */
	public static function createReflectionObject(string $class): ReflectionClass
	{
		if (!class_exists($class)) {
            throw new InvalidArgumentException('The given class does not exist');
        }

		return new ReflectionClass($class);
	}

	/**
	 * @param string $method
	 * @param array $arguments
	 *
	 * @return Closure
	 */
	public static function __callStatic(string $method, array $arguments): Closure
	{
		if (!method_exists(ReflectionClass::class, $method)) {
            throw new InvalidArgumentException('Cannot create closure from method ReflectionClass::' . $method . ', it does not exist');
        }

		return static function ($value) use ($method, $arguments)
		{
			if (!Types::string()($value)) {
                return false;
            }

			$reflection = static::createReflectionObject($value);

			return call_user_func_array([$reflection, $method], $arguments);
		};
	}
}