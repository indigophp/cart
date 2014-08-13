<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Store;

use Indigo\Cart\Cart;
use Codeception\TestCase\Test;

/**
 * Tests for Stores
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractStoreTest extends Test
{
    /**
     * Store object
     *
     * @var StoreInterface
     */
    protected $store;

    /**
     * Cart object
     *
     * @var CartInterface
     */
    protected $cart;

    protected function _before()
    {
        $this->cart = \Mockery::mock('Indigo\\Cart\\CartInterface');

        $this->cart->shouldReceive('getContents')
            ->andReturn([])
            ->byDefault();

        $this->cart->shouldReceive('setContents')
            ->andReturn([])
            ->byDefault();

        $this->cart->shouldReceive('getId')
            ->andReturn('cart')
            ->byDefault();

        $this->store->save($this->cart);
    }

    /**
     * @covers ::load
     */
    public function testLoad()
    {
        $this->assertTrue($this->store->load($this->cart));
    }

    /**
     * @covers ::save
     */
    public function testSave()
    {
        $this->assertTrue($this->store->save($this->cart));
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $this->assertTrue($this->store->delete($this->cart));
    }
}
