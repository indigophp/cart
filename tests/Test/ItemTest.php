<?php

namespace Indigo\Cart\Test;

use Indigo\Cart\Item;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $item = new Item(array(
            'id'       => 1,
            'name'     => 'Some Product',
            'price'    => 1.000,
            'quantity' => 1,
        ));

        $item->id = true;
    }

    public function testItem()
    {
        $this->assertTrue(true);
    }
}