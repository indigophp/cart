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
 * Interface for Cart Item implementations
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Item
{
    /**
     * Returns the ID
     *
     * It must be a unique identifier for all product variants
     *
     * @return string
     */
    public function getId();

    /**
     * Returns the name of the item
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the quantity
     *
     * @return integer
     */
    public function getQuantity();

    /**
     * Updates the quantity
     *
     * Handles negative integers as well
     *
     * Should result in a positive quantity
     *
     * @param integer $quantity
     *
     * @return self
     */
    public function changeQuantity($quantity);

    /**
     * Sets the quantity
     *
     * Sets the value instead of modifying it
     *
     * @param integer $quantity
     *
     * @return self
     */
    public function setQuantity($quantity);

    /**
     * Returns the price
     *
     * @return mixed
     */
    public function getPrice();

    /**
     * Returns the subtotal
     *
     * @return mixed
     */
    public function getSubtotal();
}
