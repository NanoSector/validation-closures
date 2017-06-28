<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

use ValidationClosures\Ranges;
use PHPUnit\Framework\TestCase;

class RangesTest extends TestCase
{
	public function testStringWithLengthBetween()
	{
		$this->expectException(InvalidArgumentException::class);
		Ranges::stringWithLengthBetween(-1, 0);

		$this->expectException(InvalidArgumentException::class);
		Ranges::stringWithLengthBetween(0, 0);

		$closure = Ranges::stringWithLengthBetween(0, 1);
		self::assertTrue($closure(''));
		self::assertTrue($closure('a'));
		self::assertFalse($closure('aaa'));
		self::assertFalse($closure('aaaaa'));

		$closure = Ranges::stringWithLengthBetween(0, 5);
		self::assertTrue($closure(''));
		self::assertTrue($closure('a'));
		self::assertTrue($closure('aaa'));
		self::assertTrue($closure('aaaaa'));

		$closure = Ranges::stringWithLengthBetween(2, 4);
		self::assertFalse($closure(''));
		self::assertFalse($closure('a'));
		self::assertTrue($closure('aa'));
		self::assertTrue($closure('aaa'));
		self::assertFalse($closure('aaaaa'));
	}

	public function testIntBetween()
	{
		$closure = Ranges::intBetween(0, 3);
		self::assertFalse($closure(-3));
		self::assertFalse($closure(-2));
		self::assertFalse($closure(-1));
		self::assertTrue($closure(0));
		self::assertTrue($closure(1));
		self::assertTrue($closure(2));
		self::assertTrue($closure(3));
		self::assertFalse($closure(4));
		self::assertFalse($closure(5));

		$closure = Ranges::intBetween(-2, 2);
		self::assertFalse($closure(-3));
		self::assertTrue($closure(-2));
		self::assertTrue($closure(-1));
		self::assertTrue($closure(0));
		self::assertTrue($closure(1));
		self::assertTrue($closure(2));
		self::assertFalse($closure(3));
		self::assertFalse($closure(4));
		self::assertFalse($closure(5));
	}

	public function testEnum()
	{
		$closure = Ranges::enum('string', 'double');

		self::assertFalse($closure(10));
		self::assertTrue($closure('test'));
		self::assertTrue($closure(1.2));
		self::assertFalse($closure(false));
		self::assertFalse($closure([ ]));
		self::assertTrue($closure('in_array'));
		self::assertFalse($closure(new stdClass()));
	}

	public function testStringOneOf()
	{
		$closure = Ranges::stringOneOf('test', 'ing');

		self::assertTrue($closure('test'));
		self::assertTrue($closure('ing'));
		self::assertFalse($closure('something else'));
		self::assertFalse($closure(' '));
	}
}
