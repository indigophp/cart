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

use Indigo\Cart\Item;

/**
 * Interface for Cart implementations
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Cart
{
    /**
     * Returns the Cart ID
     *
     * @return string
     */
    public function getId();

    /**
     * Adds an item to Cart
     *
     * @param Item $item
     *
     * @return this
     */
    public function add(Item $item);

    /**
     * Returns total
     *
     * @return mixed
     */
    public function getTotal();

    /**
     * Returns total quantity
     *
     * @return integer
     */
    public function getQuantity();

    /**
     * Resets the Cart
     *
     * @return boolean
     */
    public function reset();

    /**
     * Returns the cart items
     *
     * @return []
     */
    public function getItems();

    /**
     * Sets the cart data
     *
     * @param [] $data
     *
     * @return this
     */
    public function setItems(array $data);
}
