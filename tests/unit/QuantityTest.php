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
 * @coversDefaultClass Indigo\Cart\Quantity
 * @group              Cart
 */
class QuantityTest extends Test
{
    protected $item;

    protected function _before()
    {
        $this->item = new SimpleItem('Some Product', 1.00, 1, 1);
    }

    /**
     * @covers ::getQuantity
     */
    public function testGetQuantity()
    {
        $this->assertEquals(1, $this->item->getQuantity());
    }

    /**
     * @covers ::changeQuantity
     * @covers ::assertQuantityInteger
     */
    public function testChangeQuantity()
    {
        $this->assertSame($this->item, $this->item->changeQuantity(1));
        $this->assertEquals(2, $this->item->getQuantity());
    }

    /**
     * @covers                   ::changeQuantity
     * @covers                   ::assertQuantityInteger
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Quantity must be an integer
     */
    public function testFailedQuantityChange()
    {
        $this->item->changeQuantity('asdasdasd');
    }

    /**
     * @covers ::setQuantity
     * @covers ::assertQuantityInteger
     * @covers ::assertQuantityPositive
     */
    public function testSetQuantity()
    {
        $this->assertSame($this->item, $this->item->setQuantity(1));
    }

    /**
     * @covers                   ::setQuantity
     * @covers                   ::assertQuantityInteger
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Quantity must be an integer
     */
    public function testFailedSetQuantityType()
    {
        $this->item->setQuantity('1');
    }

    /**
     * @covers                   ::setQuantity
     * @covers                   ::assertQuantityPositive
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Quantity must be positive
     */
    public function testFailedSetQuantityNegative()
    {
        $this->item->setQuantity(-1);
    }
}
