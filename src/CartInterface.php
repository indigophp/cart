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
 * Cart interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface CartInterface
{
    /**
     * Get Cart ID
     *
     * @return string
     */
    public function getId();

    /**
     * Add item to Cart
     *
     * @param  ItemInterface $item
     * @return CartInterface
     */
    public function add(ItemInterface $item);

    /**
     * Get total
     *
     * @param  boolean $option Get total with option(s)
     * @return float
     */
    public function getTotal($option = false);

    /**
     * Get total quantity
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Reset the Cart
     *
     * @return boolean
     */
    public function reset();
}
