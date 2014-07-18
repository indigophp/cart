<?php

namespace Indigo\Cart\Store;

use Indigo\Cart\Cart;
use Codeception\TestCase\Test;

abstract class AbstractStoreTest extends Test
{
    protected $store;

    protected $cart;

    protected function _before()
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
