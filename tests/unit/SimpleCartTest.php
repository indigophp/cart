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
 * Tests for Simple Cart
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\SimpleCart
 * @group              Cart
 */
class SimpleCartTest extends Test
{
    /**
     * Cart object
     *
     * @var Cart
     */
    protected $cart;

    /**
     * Item object
     *
     * @var Item
     */
    protected $item;

    protected function _before()
    {
        $this->cart = new SimpleCart('cart_01');

        $this->item = new SimpleItem('Some Product', 1.00, 1, 1);

        $this->cart->addItem($this->item);
    }

    /**
     * @covers ::__construct
     * @covers ::getId
     */
    public function testConstruct()
    {
        $cart = new SimpleCart('cart_01');

        $this->assertEquals('cart_01', $cart->getId());

        $cart = new SimpleCart();

        $this->assertStringStartsWith('__CART__', $cart->getId());
    }

    /**
     * @covers ::count
     * @covers ::getIterator
     */
    public function testInterfaces()
    {
        $this->assertEquals(count($this->cart), $this->cart->count());
        $this->assertEquals(1, $this->cart->count());

        $this->assertInstanceOf('ArrayIterator', $this->cart->getIterator());
    }

    /**
     * @covers ::getId
     */
    public function testId()
    {
        $this->assertEquals('cart_01', $this->cart->getId());
    }

    /**
     * @covers ::getItem
     * @covers ::hasItem
     */
    public function testItem()
    {
        $this->assertInstanceOf('Indigo\\Cart\\Item', $this->cart->getItem(1));
        $this->assertNull($this->cart->getItem(2));
        $this->assertTrue($this->cart->hasItem(1));
        $this->assertFalse($this->cart->hasItem(2));
    }

    /**
     * @covers ::addItem
     */
    public function testAddNewItem()
    {
        $item = new SimpleItem('Some Other Product', 2.00, 1, 2);

        $id = $item->getId();

        $this->assertFalse($this->cart->hasItem($id));

        $this->assertSame($this->cart, $this->cart->addItem($item));

        $this->assertTrue($this->cart->hasItem($id));
        $this->assertSame($item, $this->cart->getItem($id));
    }

    /**
     * @covers ::addItem
     */
    public function testAddItem()
    {
        $id = $this->item->getId();

        $this->assertTrue($this->cart->hasItem($id));

        $this->cart->addItem($this->item);

        $currentItem = $this->cart->getItem($id);

        $this->assertEquals(2, $currentItem->getQuantity());
    }

    /**
     * @covers ::removeItem
     */
    public function testRemoveItem()
    {
        $this->assertTrue($this->cart->removeItem(1));

        $this->cart->addItem($this->item);

        $this->assertTrue($this->cart->removeItem($this->item));
        $this->assertFalse($this->cart->removeItem(1));
        $this->assertFalse($this->cart->removeItem(2));
    }

    /**
     * @covers ::getTotal
     */
    public function testTotal()
    {
        $this->assertEquals(1, $this->cart->getTotal());
    }

    /**
     * @covers ::getTotal
     */
    public function testTotalCalculator()
    {
        $item = \Mockery::mock('Indigo\\Cart\\Item, Indigo\\Cart\\TotalCalculator');

        $item->shouldReceive('getId')
            ->andReturn(1);

        $item->shouldReceive('calculateTotal')
            ->andReturn(123);

        $this->cart->reset();

        $this->cart->addItem($item);

        $this->assertEquals(123, $this->cart->getTotal());
    }

    /**
     * @covers ::getQuantity
     */
    public function testQuantity()
    {
        $this->assertEquals(1, $this->cart->getQuantity());
    }

    /**
     * @covers ::reset
     * @covers ::isEmpty
     */
    public function testResetEmpty()
    {
        $this->assertFalse($this->cart->isEmpty());
        $this->assertTrue($this->cart->reset());
        $this->assertTrue($this->cart->isEmpty());
    }

    /**
     * @covers ::getItems
     * @covers ::setItems
     */
    public function testItems()
    {
        $this->assertSame($this->cart, $this->cart->setItems([]));
        $this->assertEquals([], $this->cart->getItems());
    }
}
