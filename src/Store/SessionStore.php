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

use Fuel\Common\Arr;

/**
 * Session store
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SessionStore implements StoreInterface
{
    /**
     * {@inheritdoc}
     */
    public function fetch($cartId)
    {
        return Arr::get($_SESSION, $cartId, array());
    }

    /**
     * {@inheritdoc}
     */
    public function save($cartId, $data)
    {
        Arr::set($_SESSION, $cartId, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function flush($cartId)
    {
        Arr::delete($_SESSION, $cartId);
    }
}
