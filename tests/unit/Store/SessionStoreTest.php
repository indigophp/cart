<?php

namespace Indigo\Cart\Store;

session_start();

/**
 * Tests for Session Store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Store\SessionStore
 */
class SessionStoreTest extends AbstractStoreTest
{
    public function _before()
    {
        $this->store = new SessionStore;

        parent::_before();
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
