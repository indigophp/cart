<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Item;
use Indigo\Cart\Options;
use Indigo\Cart\Option\Option;
use Indigo\Cart\Option\Tax;
use Fuel\Validation\Rule\Type;

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
                )
            )
        );

        $this->options->add(
            new Tax(
                array(
                    'id'    => 2,
                    'name'  => 'VAT',
                    'value' => 27,
                )
            )
        );
    }

    /**
     * @covers ::__construct
     * @group  Cart
     */
    public function testInstance()
    {
        $options = new Options(array(
            new Option(
                array(
                    'id'    => 1,
                    'name'  => 'Red color',
                    'value' => 123.0,
                )
            ),
            new Tax(
                array(
                    'id'    => 2,
                    'name'  => 'VAT',
                    'value' => 27,
                )
            ),
        ));

        $this->assertEquals(2, count($options));
    }

    /**
     * @covers ::add
     * @group  Cart
     */
    public function testAdd()
    {
        $option = new Option(
            array(
                'id'    => 3,
                'name'  => 'Red color',
                'value' => 123.0,
            )
        );

        $id = $option->getId();

        $this->assertFalse($this->options->has($id));

        $this->options->add($option);

        $this->assertTrue($this->options->has($id));
    }

    /**
     * @covers ::getValue
     * @group  Cart
     */
    public function testValue()
    {
        $this->assertEquals(150.0, $this->options->getValue(0));
    }

    /**
     * @covers ::getValueOfType
     * @group  Cart
     */
    public function testValueOfType()
    {
        $this->assertEquals(27, $this->options->getValueOfType(0, new Type('Indigo\\Cart\\Option\\Tax')));
    }
}
