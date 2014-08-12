<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Option\Option;

/**
 * Tests for Option
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Option\Option
 * @group              Cart
 * @group              Option
 */
class OptionTest extends AbstractOptionTest
{
    public function _before()
    {
        $this->option = new Option([
            'id'    => 1,
            'name'  => 'Test option',
            'value' => 1.0
        ]);
    }

    /**
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $this->assertEquals(1.0, $this->option->getValue(1.0));
    }
}
