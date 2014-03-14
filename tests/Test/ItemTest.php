<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Item;

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

    public function testId()
    {
        $item = $this->item->getContents();
        unset($item['quantity']);

        $hash = md5(serialize($item));

        $this->assertEquals($hash, $this->item->getId());
    }

    public function testAdd()
    {
        $item = $this->item->add(1);

        $this->assertInstanceOf('Indigo\\Cart\\Item', $item);

        $this->assertEquals(2, $item->quantity);

        $item->add(-1);

        $this->assertEquals(1, $item->quantity);
    }

    public function testPrice()
    {
        $this->assertEquals($this->item->price, $this->item->getPrice(false));
        $this->assertEquals($this->item->price * 1.27, $this->item->getPrice());
    }

    public function testTax()
    {
        $item = $this->item->setTax(27);
        $this->assertInstanceOf('Indigo\\Cart\\Item', $item);

        $this->assertEquals($this->item->price * 0.27, $this->item->getTax());

        $this->item->setTax(1, false);

        $this->assertEquals(1, $this->item->getTax());
        $this->assertEquals($this->item->price + 1, $this->item->getPrice());
    }

    public function testSubtotal()
    {
        $this->assertEquals(1.000, $this->item->getSubtotal(false));
        $this->assertEquals($this->item->getPrice(), $this->item->getSubtotal());
    }
}