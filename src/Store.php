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
 * Interface for stores (like session, database, etc)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Store
{
    /**
     * Loads data from store
     *
     * @param Cart $cart
     *
     * @return boolean
     */
    public function load(Cart $cart);

    /**
     * Saves data to store
     *
     * @param Cart $cart
     *
     * @return boolean
     */
    public function save(Cart $cart);

    /**
     * Deletes the cart from the store
     *
     * @param Cart $cart
     *
     * @return boolean
     */
    public function delete(Cart $cart);
}