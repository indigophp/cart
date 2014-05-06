<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Cart;
use Indigo\Cart\Item;
use Indigo\Cart\Store\SessionStore;

/**
 * Tests for Cart
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Cart\Cart
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    protected $cart;

    protected function setUp()
    {
        $data = array(
            'b89a9e2ee493c37d2e090e54f7f79f3a' => new Item(array(
                'id'       => 1,
                'name'     => 'Some Product',
                'price'    => 1.000,
                'quantity' => 1,
                'tax'      => 27,
            ))
        );

        $store = new SessionStore;
        $store->save('cart_01', $data);

        $this->cart = new Cart('cart_01');
    }

    public function testNewAdd()
    {
        $this->cart->setTax(27);

        $item = new Item(array(
            'id'       => 2,
            'name'     => 'Some Other Product',
            'price'    => 2.000,
            'quantity' => 1,
        ));

        $id = $item->getId();

        $this->assertFalse($this->cart->has($id));

        $cart = $this->cart->add($item);
        $this->assertInstanceOf('Indigo\\Cart\\Cart', $cart);

        $this->assertTrue($this->cart->has($id));
        $this->assertEquals($item, $this->cart->get($id));
    }

    public function testAdd()
    {
        $item = new Item(array(
            'id'       => 1,
            'name'     => 'Some Product',
            'price'    => 1.000,
            'quantity' => 1,
            'tax'      => 27,
        ));

        $id = $item->getId();

        $this->assertTrue($this->cart->has($id));

        $this->cart->add($item);

        $currentItem = $this->cart->get($id);

        $this->assertEquals(2, $currentItem->quantity);
    }

    public function testTotal()
    {
        $this->assertEquals(1, $this->cart->getTotal(false));
        $this->assertEquals(1.27, $this->cart->getTotal());
    }

    public function testTax()
    {
        $this->assertEquals(0.27, $this->cart->getTotalTax());

        $cart = $this->cart->setTax(27);
        $this->assertInstanceOf('Indigo\\Cart\\Cart', $cart);
        $this->assertTrue(is_int($this->cart->getTax()));

        $this->cart->setTax(1, false);
        $this->assertTrue(is_float($this->cart->getTax()));
    }

    public function testQuantity()
    {
        $this->assertEquals(1, $this->cart->getQuantity());
    }
}