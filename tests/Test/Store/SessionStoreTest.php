<?php

namespace Indigo\Cart\Test\Store;

use Indigo\Cart\Store\SessionStore;

class SessionStoreTest extends StoreTest
{
    protected function forge()
    {
        return new SessionStore;
    }
}
