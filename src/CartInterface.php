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

use Indigo\Cart\ItemInterface;

/**
 * Cart Interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface CartInterface
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
     * @param ItemInterface $item
     *
     * @return this
     */
    public function add(ItemInterface $item);

    /**
     * Returns total
     *
     * @param boolean $option Get total with option(s)
     *
     * @return mixed
     */
    public function getTotal($option = false);

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
     * Returns the cart data
     *
     * @return []
     */
    public function getContents();

    /**
     * Sets the cart data
     *
     * @param [] $data
     *
     * @return this
     */
    public function setContents(array $data);
}
