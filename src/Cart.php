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
interface Cart extends \Countable
{
    /**
     * Returns the cart ID
     *
     * @return string
     */
    public function getId();

    /**
     * Returns an item by ID
     *
     * @param mixed $id
     *
     * @return Item
     *
     * @throws Exception\ItemNotFound If item with $id cannot be found
     */
    public function getItem($id);

    /**
     * Returns the cart items
     *
     * @return Item[]
     */
    public function getItems();

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
     * If the Item with the same ID already exists, the quantity is changed
     * Make sure that same products with different options have different item IDs
     *
     * @param Item $item
     */
    public function addItem(Item $item);

    /**
     * Removes an item from cart
     *
     * @param mixed $id
     *
     * @return boolean
     */
    public function removeItem($id);

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
     * Clears the Cart
     *
     * @return boolean
     */
    public function clear();
}
