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
     * Returns the ID
     *
     * @return string
     */
    public function getId();

    /**
     * Updates quantity without messing with read-only
     *
     * @param integer $quantity
     *
     * @return this
     */
    public function changeQuantity($quantity);

    /**
     * Returns the price
     *
     * @param boolean $option Include option(s) in price
     *
     * @return mixed
     */
    public function getPrice($option = false);

    /**
     * Returns subtotal
     *
     * @param boolean $option Include option(s) in subtotal
     *
     * @return mixed
     */
    public function getSubtotal($option = false);
}
