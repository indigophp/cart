<?php

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
 */
class CartTest extends Test
{
    protected $cart;

    protected $item;

    protected function _before()
    {
        $this->cart = new Cart('cart_01');

        $this->item = new Item(
            array(
                'id'       => 1,
                'name'     => 'Some Product',
                'price'    => 1.000,
                'quantity' => 1,
                'option'  => new Collection(array(
                    new Tax(array(
                        'id'    => 1,
                        'name'  => 'VAT',
                        'value' => 27,
                        'mode'  => Tax::PERCENT,
                    )),
                )),
            )
        );

        $this->cart->add($this->item);
    }

    /**
     * @covers ::getId
     * @group  Cart
     */
    public function testId()
    {
        $this->assertEquals('cart_01', $this->cart->getId());

        $this->cart->setId();

        $this->assertNotEquals('cart_01', $this->cart->getId());
    }

    /**
     * @covers ::add
     * @group  Cart
     */
    public function testNewAdd()
    {
        $item = new Item(
            array(
                'id'       => 2,
                'name'     => 'Some Other Product',
                'price'    => 2.000,
                'quantity' => 1,
            )
        );

        $id = $item->getId();

        $this->assertFalse($this->cart->has($id));

        $cart = $this->cart->add($item);
        $this->assertEquals($cart, $this->cart);

        $this->assertTrue($this->cart->has($id));
        $this->assertEquals($item, $this->cart->get($id));
    }

    /**
     * @covers ::add
     * @group  Cart
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
     * @group  Cart
     */
    public function testTotal()
    {
        $this->assertEquals(1, $this->cart->getTotal());
        $this->assertEquals(1.27, $this->cart->getTotal(true));
    }

    /**
     * @covers ::getQuantity
     * @group  Cart
     */
    public function testQuantity()
    {
        $this->assertEquals(1, $this->cart->getQuantity());
    }
}
