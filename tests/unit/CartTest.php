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

use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Tax;
use Codeception\TestCase\Test;

/**
 * Tests for Cart
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Cart
 * @group              Cart
 */
class CartTest extends Test
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
        $this->cart = new Cart('cart_01');

        $this->item = new Item(
            [
                'id'       => 1,
                'name'     => 'Some Product',
                'price'    => 1.000,
                'quantity' => 1,
                'option'  => new Collection([
                    new Tax([
                        'id'    => 1,
                        'name'  => 'VAT',
                        'value' => 27,
                        'mode'  => Tax::PERCENT,
                    ]),
                ]),
            ]
        );

        $this->cart->add($this->item);
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $cart = new Cart('cart_01');

        $this->assertEquals('cart_01', $cart->getId());
    }

    /**
     * @covers ::getId
     */
    public function testId()
    {
        $this->assertEquals('cart_01', $this->cart->getId());

        $this->cart->setId();

        $this->assertNotEquals('cart_01', $this->cart->getId());

        $this->cart->setId('cart_01');

        $this->assertEquals('cart_01', $this->cart->getId());
    }

    /**
     * @covers ::add
     */
    public function testNewAdd()
    {
        $item = new Item([
            'id'       => 2,
            'name'     => 'Some Other Product',
            'price'    => 2.000,
            'quantity' => 1,
        ]);

        $id = $item->getId();

        $this->assertFalse($this->cart->has($id));

        $cart = $this->cart->add($item);
        $this->assertEquals($cart, $this->cart);

        $this->assertTrue($this->cart->has($id));
        $this->assertEquals($item, $this->cart->get($id));
    }

    /**
     * @covers ::add
     */
    public function testAdd()
    {
        $id = $this->item->getId();

        $this->assertTrue($this->cart->has($id));

        $this->cart->add($this->item);

        $currentItem = $this->cart->get($id);

        $this->assertEquals(2, $currentItem->quantity);
    }

    /**
     * @covers ::getTotal
     */
    public function testTotal()
    {
        $this->assertEquals(1, $this->cart->getTotal());
        $this->assertEquals(1.27, $this->cart->getTotal(true));
    }

    /**
     * @covers ::getQuantity
     */
    public function testQuantity()
    {
        $this->assertEquals(1, $this->cart->getQuantity());
    }
}
