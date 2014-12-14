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
 * Contains the Items and other Cart relevant data
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Cart
{
    /**
     * Returns the cart ID
     *
     * @return string
     */
    public function getId();

    /**
     * Returns an item by id
     *
     * @param mixed $id
     *
     * @return Item
     */
    public function getItem($id);

    /**
     * Checks whether an item is already in cart
     *
     * @param mixed $id
     *
     * @return boolean
     */
    public function hasItem($id);

    /**
     * Adds an item to the cart
     *
     * @param Item $item
     *
     * @return self
     */
    public function addItem(Item $item);

    /**
     * Removes an item from cart (by ID or by object)
     *
     * @param mixed $item
     *
     * @return boolean
     */
    public function removeItem($item);

    /**
     * Returns total value of items (without any formatting)
     *
     * The format/type of value is/can be preserved
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
     * Checks whether cart is empty
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * Resets the Cart
     *
     * @return boolean
     */
    public function reset();

    /**
     * Returns the cart items
     *
     * @return array
     */
    public function getItems();

    /**
     * Sets the cart items
     *
     * NOTE: Use with caution! This is the only point where no type check is done
     *
     * @param array $items
     *
     * @internal
     */
    public function setItems(array $items);
}
