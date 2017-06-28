<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

use ValidationClosures\Types;
use PHPUnit\Framework\TestCase;

class TypesTest extends TestCase
{
	public function testInt()
	{
		$closure = Types::int();

		self::assertTrue($closure(10));
		self::assertFalse($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertFalse($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testString()
	{
		$closure = Types::string();

		self::assertFalse($closure(10));
		self::assertTrue($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertTrue($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testFloat()
	{
		$closure = Types::float();

		self::assertFalse($closure(10));
		self::assertFalse($closure('test'));
		self::assertTrue($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertFalse($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testBool()
	{
		$closure = Types::boolean();

		self::assertFalse($closure(10));
		self::assertFalse($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertTrue($closure(false));
		self::assertTrue($closure(true));
		self::assertFalse($closure([ ]));
		self::assertFalse($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testArray()
	{
		$closure = Types::array();

		self::assertFalse($closure(10));
		self::assertFalse($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertFalse($closure(false));
		self::assertTrue($closure([ ]));
		self::assertFalse($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testCallable()
	{
		$closure = Types::callable();

		self::assertFalse($closure(10));
		self::assertFalse($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertTrue($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testObject()
	{
		$closure = Types::object();

		self::assertFalse($closure(10));
		self::assertFalse($closure('test'));
		self::assertFalse($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertFalse($closure('in_array'));
		self::assertTrue($closure(new stdClass()));
	}

	public function testInstanceOf()
	{
		$closure = Types::instanceof(Types::class);

		$stdClass = new stdClass();
		self::assertFalse($closure($stdClass));

		$types = new Types();
		self::assertTrue($closure($types));
	}
}
