<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Item;

/**
 * @coversDefaultClass \Indigo\Cart\Item
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    protected $item;

    protected function setUp()
    {
        $this->item = new Item(array(
            'id'       => 1,
            'name'     => 'Some Product',
            'price'    => 1.000,
            'quantity' => 1,
            'tax'      => 27,
        ));
    }

    /**
     * @covers ::getID
     * @group  Cart
     */
    public function testId()
    {
        $item = $this->item->getContents();
        unset($item['quantity']);

        $hash = md5(serialize($item));

        $this->assertEquals($hash, $this->item->getId());
    }

    /**
     * @covers ::changeQuantity
     * @group  Cart
     */
    public function testChangeQuantity()
    {
        $item = $this->item->changeQuantity(1);

        $this->assertInstanceOf('Indigo\\Cart\\Item', $item);

        $this->assertEquals(2, $item->quantity);

        $item->changeQuantity(-1);

        $this->assertEquals(1, $item->quantity);
    }

    /**
     * @covers ::getPrice
     * @group  Cart
     */
    public function testPrice()
    {
        $this->assertEquals($this->item->price, $this->item->getPrice());
        $this->assertEquals($this->item->price * 1.27, $this->item->getPrice(true));
    }

    /**
     * @covers ::getTax
     * @covers ::getPrice
     * @group  Cart
     */
    public function testTax()
    {
        $this->item->tax = 27;

        $this->assertEquals($this->item->price * 0.27, $this->item->getTax());

        $this->item->tax = 1.0;

        $this->assertEquals(1, $this->item->getTax());
        $this->assertEquals($this->item->price + 1, $this->item->getPrice(true));
    }

    /**
     * @covers ::getSubtotal
     * @covers ::getPrice
     * @group  Cart
     */
    public function testSubtotal()
    {
        $this->assertEquals(1.000, $this->item->getSubtotal());
        $this->assertEquals($this->item->getPrice(true), $this->item->getSubtotal(true));
    }
}