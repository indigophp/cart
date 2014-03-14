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
    public function get($cartId)
    {
        return Arr::get($_SESSION, $cartId, array());
    }

    /**
     * {@inheritdoc}
     */
    public function save($cartId, array $data)
    {
        Arr::set($_SESSION, $cartId, $data);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($cartId)
    {
        return Arr::delete($_SESSION, $cartId);
    }
}
