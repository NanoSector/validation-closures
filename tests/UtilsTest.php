<?php
/**
 * Copyright 2017 NanoSector
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

use ValidationClosures\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
	public function testInvert()
	{
		$closure = \ValidationClosures\Types::string();

		// This should become equal to Types::notString()
		$invertedClosure = Utils::invert($closure);

		self::assertTrue($invertedClosure(10));
		self::assertFalse($invertedClosure('test'));
		self::assertTrue($invertedClosure(1.2));
		self::assertTrue($invertedClosure(false));
		self::assertTrue($invertedClosure([ ]));
		self::assertFalse($invertedClosure('in_array'));
		self::assertTrue($invertedClosure(new stdClass()));
	}

	public function testMerge()
	{
		$closure1 = \ValidationClosures\Types::int();
		$closure2 = \ValidationClosures\Ranges::stringWithLengthBetween(2, 10);

		$mergedClosure = Utils::merge($closure1, $closure2);

		self::assertTrue($mergedClosure(10));
		self::assertTrue($mergedClosure('test'));
		self::assertFalse($mergedClosure(1.2));
		self::assertFalse($mergedClosure(false));
		self::assertFalse($mergedClosure([ ]));
		self::assertTrue($mergedClosure('in_array'));
		self::assertFalse($mergedClosure(new stdClass()));
	}

	public function testBoth()
	{
		$closure1 = \ValidationClosures\Ranges::stringOneOf('test', 'testing', 'te');
		$closure2 = \ValidationClosures\Ranges::stringWithLengthBetween(2, 10);

		$mergedClosure = Utils::both($closure1, $closure2);

		self::assertFalse($mergedClosure(10));
		self::assertTrue($mergedClosure('test'));
		self::assertFalse($mergedClosure(1.2));
		self::assertFalse($mergedClosure(false));
		self::assertFalse($mergedClosure([ ]));
		self::assertFalse($mergedClosure('in_array'));
		self::assertFalse($mergedClosure(new stdClass()));
	}

	public function testValidateArray()
	{
		$array = ['string', 'another string', 'a third string'];
		self::assertTrue(Utils::validateArray(\ValidationClosures\Types::string(), $array));

		$array = ['string', 'another string', 'a third string', 10];
		self::assertFalse(Utils::validateArray(\ValidationClosures\Types::string(), $array));
	}
}
