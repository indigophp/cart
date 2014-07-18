<?php

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Option\Option;

/**
 * Tests for Option
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Option\Option
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
     * @group  Cart
     */
    public function testGetValue()
    {
        $this->assertEquals(1.0, $this->option->getValue(1.0));
    }
}
