<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart;

use Codeception\TestCase\Test;

session_start();

/**
 * Tests for Session Store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\SessionStore
 * @group              Cart
 * @group              Store
 */
class SessionStoreTest extends Test
{
    /**
     * Store object
     *
     * @var Store
     */
    protected $store;

    /**
     * Cart object
     *
     * @var Cart
     */
    protected $cart;

    public function _before()
    {
        $this->store = new SessionStore;

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
     * @covers ::__construct
     * @covers ::getSessionKey
     */
    public function testSessionKey()
    {
        $store = new SessionStore('cart_key');

        $this->assertEquals('cart_key', $store->getSessionKey());
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
