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

use Indigo\Cart\Option\Tax;

/**
 * Tests for Tax Option
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Option\Tax
 * @group              Cart
 * @group              Option
 */
class TaxTest extends AbstractOptionTest
{
    public function _before()
    {
        $this->option = new Tax([
            'id'    => 1,
            'name'  => 'Test option',
            'value' => 1.0,
            'mode'  => Tax::FIXED,
        ]);
    }

    /**
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $this->assertEquals(1.0, $this->option->getValue(1.0));

        $this->option->mode = Tax::PERCENT;
        $this->option->value = 10;

        $this->assertEquals(0.1, $this->option->getValue(1.0));
    }
}
