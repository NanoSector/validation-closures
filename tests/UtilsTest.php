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
		$invertedClosure = Utils::invert($closure);

		self::assertTrue($invertedClosure(10));
		self::assertFalse($invertedClosure('test'));
		self::assertTrue($invertedClosure(1.2));
		self::assertTrue($invertedClosure(false));
		self::assertTrue($invertedClosure([ ]));
		self::assertFalse($invertedClosure('in_array'));
		self::assertTrue($invertedClosure(new stdClass()));
	}
}
