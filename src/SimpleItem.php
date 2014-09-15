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
 * Simple Item implementation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SimpleItem implements Item
{
    /**
     * Unique identifier
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Based on the implementation using this price can be an integer or float
     *
     * @var numeric
     */
    private $price;

    /**
     * Must be an integer greater than 0
     *
     * @var integer
     */
    private $quantity;

    public function __construct($name, $price, $quantity, $id = null)
    {
        $this->assertPriceNumeric($price);
        $this->assertQuantityNonZeroInteger($quantity);

        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->id = $id;
    }

    /**
     * Asserts that given price is numeric
     *
     * @param integer $price
     *
     * @throws InvalidArgumentException If $price is not numeric
     */
    private function assertPriceNumeric($price)
    {
        if (!is_numeric($price)) {
            throw new InvalidArgumentException('Price must be a numeric value');
        }
    }

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
        if (!is_int($quantity) or abs($quantity) >= $this->quantity or $quantity === 0) {
            throw new InvalidArgumentException('Absolute quantity change must be an integer lower than the actual quantity and must not be zero');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        if ($this->id === null) {
            $this->id = $this->hashId();
        }

        return $this->id;
    }

    /**
     * Generates a hash for the item
     *
     * @return string
     */
    private function hashId()
    {
        return md5(serialize(array($this->name, $this->price)));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubtotal()
    {
        return $this->price * $this->quantity;
    }
}
