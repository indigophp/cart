<?php

namespace Indigo\Cart\Test\Store;

use Indigo\Cart\Item;

abstract class StoreTest extends \PHPUnit_Framework_TestCase
{
    protected $store;
    protected $data;

    protected function setUp()
    {
        $this->data = array(
            new Item(array(
                'id'       => 1,
                'name'     => 'Some Product',
                'price'    => 1.000,
                'quantity' => 1,
                'tax'      => 27,
            ))
        );

        $this->store = $this->forge();

        $this->store->save('cart_01', $this->data);
    }

    abstract protected function forge();

    public function testDelete()
    {
        $this->assertTrue($this->store->delete('cart_01'));
    }

    public function testSave()
    {
        $this->assertTrue($this->store->save('cart_01', array()));
    }

    public function testGet()
    {
        $this->assertEquals($this->data, $this->store->get('cart_01'));
    }
}
