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
 * Store the cart
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Store
{
    /**
     * Loads data from store
     *
     * @param mixed $id
     *
     * @return Cart
     */
    public function load($id);

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
     * @param mixed $id
     *
     * @return boolean
     */
    public function delete($id);
}
