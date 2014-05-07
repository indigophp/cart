<?php

namespace Indigo\Cart\Test\Store;

use Indigo\Cart\Cart;
use Indigo\Cart\Item;

abstract class StoreTest extends \PHPUnit_Framework_TestCase
{
    protected $store;
    protected $cart;

    protected function setUp()
    {
        $this->cart = \Mockery::mock('Indigo\\Cart\\Cart', function($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(uniqid('__CART__', true));

            $mock->shouldReceive('getContents')
                ->andReturn(array());

            $mock->shouldReceive('setContents')
                ->andReturn($mock);
        });

        $this->store->save($this->cart);
    }

    public function tearDown()
    {
        \Mockery::close();
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
