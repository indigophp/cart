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
 * Item interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface ItemInterface
{
    /**
     * Get ID
     *
     * @return string
     */
    public function getId();

    /**
     * Update quantity without messing with read-only
     *
     * @param  int           $quantity
     * @return ItemInterface
     */
    public function changeQuantity($quantity);

    /**
     * Get price
     *
     * @param  boolean $option Include option(s) in price
     * @return float
     */
    public function getPrice($option = false);

    /**
     * Get subtotal
     *
     * @param  boolean $option Include option(s) in subtotal
     * @return float
     */
    public function getSubtotal($option = false);
}
