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

use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Option;
use Fuel\Validation\Rule\Type;

/**
 * Tests for Collection Option
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Option\Collection
 * @group              Cart
 * @group              Option
 */
class CollectionTest extends AbstractOptionTest
{
    /**
     * Option object
     *
     * @var Option
     */
    protected $mock;

    protected function _before()
    {
        $this->option = new Collection;

        $this->mock = new Option([
            'id'    => 1,
            'name'  => 'Test Option',
            'value' => 2.00
        ]);

        $this->option->add($this->mock);
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $option = new Collection([
            new Option(['name' => 'test']),
        ]);
    }

    /**
     * @covers ::add
     */
    public function testAdd()
    {
        $option = $this->mock;

        $this->option->setContents([]);
        $id = $option->getId();

        $this->assertFalse($this->option->has($id));

        $this->option->add($option);

        $this->assertTrue($this->option->has($id));
    }

    /**
     * @covers ::getValue
     */
    public function testValue()
    {
        $this->assertEquals(2.0, $this->option->getValue(1.0));
    }

    /**
     * @covers ::getValueOfType
     */
    public function testValueOfType()
    {
        $this->assertEquals(2.0, $this->option->getValueOfType(1.0, new Type('Indigo\\Cart\\Option\\OptionInterface')));
    }
}
