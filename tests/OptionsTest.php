<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Item;
use Indigo\Cart\Options;
use Indigo\Cart\Option\Option;
use Indigo\Cart\Option\TaxOption;

/**
 * @coversDefaultClass \Indigo\Cart\Options
 */
class OptionsTest extends \PHPUnit_Framework_TestCase
{
    protected $options;

    protected function setUp()
    {
        $this->options = new Options;

        $this->options->add(
            new Option(
                array(
                    'id'    => 1,
                    'name'  => 'Red color',
                    'value' => 123.0,
                    'order' => 10,
                )
            )
        );

        $this->options->add(
            new TaxOption(
                array(
                    'id'    => 2,
                    'name'  => 'VAT',
                    'value' => 27.0,
                    'order' => 20,
                )
            )
        );
    }

    /**
     * @covers ::getValue
     * @group  Cart
     */
    public function testValue()
    {
        var_dump($this->options->getValue(1)); exit;
    }
}
