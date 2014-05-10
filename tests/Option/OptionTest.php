<?php

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Option\Option;

class OptionTest extends AbstractOptionTest
{
    public function setUp()
    {
        $this->option = new Option(array(
            'id'    => 1,
            'name'  => 'Test option',
            'value' => 1.0
        ));
    }

    public function testGetValue()
    {
        $this->assertEquals(1.0, $this->option->getValue(1.0));
    }
}
