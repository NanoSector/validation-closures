<?php

/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

use ValidationClosures\Reflection;
use PHPUnit\Framework\TestCase;

class ReflectionTest extends TestCase
{
	public function testCreateReflectionObject()
	{
		$expectedReflection = new ReflectionClass(stdClass::class);
		$reflection = Reflection::createReflectionObject(stdClass::class);
		self::assertEquals($expectedReflection, $reflection);

		$this->expectException(\InvalidArgumentException::class);
		Reflection::createReflectionObject('blablabla\nonexistingclass');
	}

	public function testCallStaticMagicMethod()
	{
		self::assertFalse(Reflection::isInterface()(stdClass::class));
		self::assertFalse(Reflection::isInterface()(10));
		self::assertTrue(Reflection::isInstance(new stdClass())(stdClass::class));

		$this->expectException(\InvalidArgumentException::class);
		Reflection::nonExistingMethod();
	}
}
