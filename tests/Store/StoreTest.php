<?php

namespace Indigo\Cart\Test\Store;

use Indigo\Cart\Cart;

abstract class StoreTest extends \PHPUnit_Framework_TestCase
{
    protected $store;

    protected $cart;

    protected function setUp()
    {
        $this->cart = new Cart;

        $this->store->save($this->cart);
    }

    /**
     * @covers ::load
     * @group  Cart
     */
    public function testLoad()
    {
        $this->assertTrue($this->store->load($this->cart));
    }

    /**
     * @covers ::save
     * @group  Cart
     */
    public function testSave()
    {
        $this->assertTrue($this->store->save($this->cart));
    }

    /**
     * @covers ::delete
     * @group  Cart
     */
    public function testDelete()
    {
        $this->assertTrue($this->store->delete($this->cart));
    }
}
