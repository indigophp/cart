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
use Fuel\Common\Arr;

/**
 * Session store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SessionStore implements StoreInterface
{
    /**
     * Session key used for store
     *
     * @var string
     */
    protected $sessionKey;

    /**
     * Creates a new SessionStore
     *
     * @param string $sessionKey
     */
    public function __construct($sessionKey = 'cart')
    {
        $this->sessionKey = $sessionKey;
    }

    /**
     * Returns the session key
     *
     * @return string
     */
    public function getSessionKey()
    {
        return $this->sessionKey;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Cart $cart)
    {
        $data = Arr::get($_SESSION, $this->sessionKey . '.' . $cart->getId(), array());
        $cart->setContents($data);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Cart $cart)
    {
        $data = $cart->getContents();
        Arr::set($_SESSION, $this->sessionKey . '.' . $cart->getId(), $data);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Cart $cart)
    {
        return Arr::delete($_SESSION, $this->sessionKey . '.' . $cart->getId());
    }
}
