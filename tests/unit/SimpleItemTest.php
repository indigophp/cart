<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart;

use Codeception\TestCase\Test;

/**
 * Tests for Simple Item
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\SimpleItem
 * @group              Cart
 */
class SimpleItemTest extends Test
{
    protected $item;

    protected function _before()
    {
        $this->item = new SimpleItem('Some Product', 1.00, 1, 1);
    }

    /**
     * @covers ::__construct
     * @covers ::assertPriceNumeric
     */
    public function testConstruct()
    {
        $item = new SimpleItem('Some Product', 1.00, 1, 1);

        $this->assertEquals('Some Product', $item->getName());
        $this->assertEquals(1.00, $item->getPrice());
        $this->assertEquals(1, $item->getQuantity());
        $this->assertEquals(1, $item->getId());
    }

    /**
     * @covers                   ::__construct
     * @covers                   ::assertPriceNumeric
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Price must be an integer|float value
     */
    public function testFailedConstruct()
    {
        $item = new SimpleItem('Some Product', 'one', 1, 1);
    }

    /**
     * @covers ::getId
     * @covers ::hashId
     */
    public function testId()
    {
        $this->assertEquals(1, $this->item->getId());

        $item = new SimpleItem('Some Product', 1.00, 1);

        $id = md5(serialize(array('Some Product', 1.00)));

        $this->assertEquals($id, $item->getId());
    }

    /**
     * @covers ::getName
     */
    public function testName()
    {
        $this->assertEquals('Some Product', $this->item->getName());
    }

    /**
     * @covers ::getPrice
     */
    public function testPrice()
    {
        $this->assertEquals(1.00, $this->item->getPrice());
    }

    /**
     * @covers ::getSubtotal
     */
    public function testSubtotal()
    {
        $this->assertEquals(1.00, $this->item->getSubtotal());
    }
}
