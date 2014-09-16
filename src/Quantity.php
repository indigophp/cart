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

use InvalidArgumentException;

/**
 * Implements quantity logic
 *
 * Makes sence when using with Item
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Quantity
{
    /**
     * Must be a positive integer
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
    private function assertQuantityInteger($quantity)
    {
        if (!is_int($quantity)) {
            throw new InvalidArgumentException('Quantity must be an integer');
        }
    }

    /**
     * Asserts that given quantity is positive
     *
     * @param integer $quantity
     *
     * @throws InvalidArgumentException If $quantity is not positive
     */
    private function assertQuantityPositive($quantity)
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantity must be positive');
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
        $this->assertQuantityInteger($quantity);

        $quantity = $this->quantity + $quantity;

        // Use this to make sure a proper integer check is done after addition
        $this->setQuantity($quantity);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->assertQuantityInteger($quantity);
        $this->assertQuantityPositive($quantity);

        $this->quantity = $quantity;

        return $this;
    }
}
