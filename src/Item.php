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

use Indigo\Container\Struct;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Item extends Struct
{
    /**
     * {@inheritdocs}
     */
    protected $struct = array(
        'id' => array(
            'required',
            'type' => array('integer', 'string'),
        ),
        'name' => array(
            'required',
            'type' => 'string',
        ),
        'price' => array(
            'required',
            'type' => 'float',
        ),
        'quantity' => array(
            'required',
            'type'       => 'integer',
            'numericMin' => 1,
        ),
        'tax' => array('type' => array('float', 'integer')),
        'options' => array('type' => 'array'),
    );

    /**
     * Keys to ignore in the hashing process
     *
     * @var array
     */
    protected $ignoreKeys = array('quantity');

    /**
     * Get ID
     *
     * @return string
     */
    public function getId()
    {
        // Filter ignored keys
        $hashData = Arr::filterKeys($this->data, $this->ignoreKeys, true);

        // Get hash
        $hash = md5(serialize($hashData));

        return $hash;
    }

    /**
     * Update quantity without messing with read-only
     *
     * @param int   $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->data['quantity'] += (int) $quantity;

        return $this;
    }

    /**
     * Get price
     *
     * @param  boolean $tax Get taxed price
     * @return float
     */
    public function getPrice($tax = false)
    {
        $price = $this->price;

        if ($tax) {
            $price += $this->getTax();
        }

        return $price;
    }

    /**
     * Get tax
     *
     * @return float
     */
    public function getTax()
    {
        if (is_float($this->tax)) {
            return $this->tax;
        }

        return $this->price * $this->tax / 100;
    }

    /**
     * Get subtotal
     *
     * @param  boolean $tax Get taxed subtotal
     * @return float
     */
    public function getSubtotal($tax = false)
    {
        $price = $this->getPrice($tax);

        return $price * $this->quantity;
    }
}
