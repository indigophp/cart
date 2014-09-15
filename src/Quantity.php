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
 * Implements quantity logic
 *
 * Makes sence when using with Item
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Quantity
{
    /**
     * Must be an integer greater than zero
     *
     * @var integer
     */
    private $quantity;

    /**
     * Asserts that given quantity is integer
     *
     * @param integer $quantity
     *
     * @throws InvalidArgumentException If $quantity is not integer
     */
    private function assertQuantityNonZeroInteger($quantity)
    {
        if (!is_int($quantity) or $quantity < 1) {
            throw new InvalidArgumentException('Quantity must be an integer greater than zero');
        }
    }

    /**
     * Asserts that a given quantity change is valid
     *
     * @param integer $quantity
     *
     * @throws InvalidArgumentException If quantity change is invalid
     */
    private function assertValidQuantityChange($quantity)
    {
        if (!is_int($quantity) or ($quantity < 0 and abs($quantity) >= $this->quantity) or $quantity === 0) {
            throw new InvalidArgumentException('Quantity change must not be zero and must result in an integer greater than zero');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function changeQuantity($quantity)
    {
        $this->assertValidQuantityChange($quantity);

        $this->quantity += $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->assertQuantityNonZeroInteger($quantity);

        $this->quantity = $quantity;

        return $this;
    }
}
