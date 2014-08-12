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

session_start();

/**
 * Tests for Session Store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Cart\Store\SessionStore
 * @group              Cart
 * @group              Store
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
     */
    public function testSessionKey()
    {
        $store = new SessionStore('cart_key');

        $this->assertEquals('cart_key', $store->getSessionKey());
    }
}
