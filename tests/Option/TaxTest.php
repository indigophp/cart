<?php

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Option\Tax;

class TaxTest extends AbstractOptionTest
{
    public function setUp()
    {
        $this->option = new Tax(array(
            'id'    => 1,
            'name'  => 'Test option',
            'value' => 1.0,
            'mode'  => Tax::ABSOLUTE,
        ));
    }

    public function testGetValue()
    {
        $this->assertEquals(1.0, $this->option->getValue(1.0));

        $this->option->mode = Tax::PERCENT;
        $this->option->value = 10;

        $this->assertEquals(0.1, $this->option->getValue(1.0));
    }
}
