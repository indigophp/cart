<?php

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Item;
use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Option;
use Indigo\Cart\Option\Tax;
use Fuel\Validation\Rule\Type;

/**
 * Tests for Collection Option
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Option\Collection
 */
class CollectionTest extends AbstractOptionTest
{
    protected $mock;

    protected function setUp()
    {
        $this->option = new Collection;

        $this->mock = \Mockery::mock('Indigo\\Cart\\Option\\OptionInterface', function($mock) {
            $mock->shouldReceive('getId')->andReturn('option_id');
            $mock->shouldReceive('setParent')->andReturn($mock);
            $mock->shouldReceive('disableParent')->andReturn($mock);
            $mock->shouldReceive('setReadOnly')->andReturn($mock);
            $mock->shouldReceive('getValue')->with(1.0)->andReturn(2.0);
        });

        $this->option->add($this->mock);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @covers ::add
     * @group  Cart
     */
    public function testAdd()
    {
        $option = $this->mock;

        $this->option->setContents(array());
        $id = $option->getId();

        $this->assertFalse($this->option->has($id));

        $this->option->add($option);

        $this->assertTrue($this->option->has($id));
    }

    /**
     * @covers ::getValue
     * @group  Cart
     */
    public function testValue()
    {
        $this->assertEquals(2.0, $this->option->getValue(1.0));
    }

    /**
     * @covers ::getValueOfType
     * @group  Cart
     */
    public function testValueOfType()
    {
        $this->assertEquals(2.0, $this->option->getValueOfType(1.0, new Type('Indigo\\Cart\\Option\\OptionInterface')));
    }
}
