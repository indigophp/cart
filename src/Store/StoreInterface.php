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

/**
 * StoreInterface
 *
 * Interface for stores (like session, database, etc)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface StoreInterface
{
    /**
     * Fetch data from the store
     *
     * @param  string $cartId
     * @return array Array of items and cart settings
     */
    public function fetch($cartId);

    /**
     * Save items and cart settings to store
     *
     * @param  string $cartId
     * @param  array  $data
     * @return boolean
     */
    public function save($cartId, array $data);

    /**
     * Flush the cart from the store
     *
     * @param  string $cartId
     * @return boolean
     */
    public function flush($cartId);
}
