<?php

namespace Indigo\Cart;

use Indigo\Cart\Option\Collection;
use Indigo\Cart\Option\Tax;
use Codeception\TestCase\Test;

/**
 * Tests for Item
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Item
 */
class ItemTest extends Test
{
    protected $item;

    protected function _before()
    {
        $this->item = new Item(array(
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
