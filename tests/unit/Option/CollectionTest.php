<?php

namespace Indigo\Cart\Test\Option;

use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Option;
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

    protected function _before()
    {
        $this->option = new Collection;

        $this->mock = new Option(array(
            'id'    => 1,
            'name'  => 'Test Option',
            'value' => 2.00
        ));

        $this->option->add($this->mock);
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
