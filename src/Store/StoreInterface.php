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
     * Get data from the store
     *
     * @param  string $cartId
     * @return array Array of items and cart settings
     */
    public function get($cartId);

    /**
     * Save items to store
     *
     * @param  string $cartId
     * @param  array  $data
     * @return boolean
     */
    public function save($cartId, array $data);

    /**
     * Delete the cart from the store
     *
     * @param  string $cartId
     * @return boolean
     */
    public function delete($cartId);
}
