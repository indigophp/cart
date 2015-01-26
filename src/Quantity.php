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

use Assert;
use Assert\Assertion;

/**
 * Implements quantity logic
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
        Assertion::integer($quantity, 'Quantity must be an integer');

        $quantity = $this->quantity + $quantity;

        // Use this to make sure a proper integer check is done after addition
        $this->setQuantity($quantity);
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        Assert\that($quantity)
            ->integer('Quantity must be an integer')
            ->min(1, 'Quantity must greater than zero');

        $this->quantity = $quantity;
    }
}
