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
    use Quantity;

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
     * @var integer|float
     */
    private $price;

    /**
     * @param string        $name
     * @param integer|float $price
     * @param integer       $quantity
     * @param mixed         $id
     */
    public function __construct($name, $price, $quantity, $id = null)
    {
        $this->assertPriceNumeric($price);
        $this->setQuantity($quantity);

        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
    }

    /**
     * Asserts that given price is integer|float
     *
     * @param integer|float $price
     *
     * @throws InvalidArgumentException If $price is not numeric
     */
    private function assertPriceNumeric($price)
    {
        if (!is_integer($price) and !is_float($price)) {
            throw new InvalidArgumentException('Price must be an integer|float value');
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
