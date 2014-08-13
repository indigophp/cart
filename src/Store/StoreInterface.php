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

use Indigo\Cart\CartInterface;

/**
 * Store Interface
 *
 * Interface for stores (like session, database, etc)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface StoreInterface
{
    /**
     * Loads data from store
     *
     * @param CartInterface $cart
     *
     * @return boolean
     */
    public function load(CartInterface $cart);

    /**
     * Saves data to store
     *
     * @param CartInterface $cart
     *
     * @return boolean
     */
    public function save(CartInterface $cart);

    /**
     * Deletes the cart from the store
     *
     * @param CartInterface $cart
     *
     * @return boolean
     */
    public function delete(CartInterface $cart);
}
