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

/**
 * Session Store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SessionStore implements Store
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

        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = [];
        }
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
        $id = $cart->getId();

        if (array_key_exists($id, $_SESSION[$this->sessionKey])) {
            $cart->setItems($_SESSION[$this->sessionKey][$id]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Cart $cart)
    {
        $id = $cart->getId();

        $_SESSION[$this->sessionKey][$id] = $cart->getItems();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Cart $cart)
    {
        $id = $cart->getId();

        unset($_SESSION[$this->sessionKey][$id]);

        return true;
    }
}
