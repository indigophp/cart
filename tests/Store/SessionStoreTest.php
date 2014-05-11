<?php

namespace Indigo\Cart\Test\Store;

use Indigo\Cart\Store\SessionStore;

session_start();

/**
 * Tests for Session Store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Store\SessionStore
 */
class SessionStoreTest extends StoreTest
{
    public function setUp()
    {
        $this->store = new SessionStore;

        parent::setUp();
    }

    /**
     * @covers ::__construct
     * @covers ::getSessionKey
     * @group  Cart
     */
    public function testSessionKey()
    {
        $store = new SessionStore('cart_key');

        $this->assertEquals('cart_key', $store->getSessionKey());
    }
}
