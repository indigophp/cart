<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Cart;
use Indigo\Cart\Item;
use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Tax;
use Indigo\Cart\Store\SessionStore;

/**
 * Tests for Cart
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  \Indigo\Cart\Cart
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    protected $cart;

    protected function setUp()
    {
        $this->cart = new Cart('cart_01');

        $store = new SessionStore;

        $store->load($this->cart);

        $this->cart->add(
            new Item(
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
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::getId
     * @group  Cart
     */
    public function testInstance()
    {
        $cart = new Cart('test');

        $this->assertEquals('test', $cart->getId());

        $cart = new Cart();

        $this->assertStringStartsWith('__CART__', $cart->getId());
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
        $this->assertInstanceOf('Indigo\\Cart\\Cart', $cart);

        $this->assertTrue($this->cart->has($id));
        $this->assertEquals($item, $this->cart->get($id));
    }

    /**
     * @covers ::add
     * @group  Cart
     */
    public function testAdd()
    {
        $item = new Item(
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

        $id = $item->getId();

        $this->assertTrue($this->cart->has($id));

        $this->cart->add($item);

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
     * @covers ::getTax
     * @group  Cart
     */
    public function testTax()
    {
        $this->assertEquals(0.27, $this->cart->getTax());
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
