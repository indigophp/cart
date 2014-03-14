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

use Fuel\Common\StructContainer;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Item extends StructContainer
{
    protected static $struct = array(
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

    public function getId()
    {
        // Keys to ignore in the hashing process
        $ignoreKeys = array('quantity');

        // Filter ignored keys
        $hashData = Arr::filterKeys($this->data, $ignoreKeys, true);

        // Get hash
        $hash = md5(serialize($hashData));

        return $hash;
    }

    public function add($quantity)
    {
        $this->data['quantity'] += $quantity;

        return $this;
    }

    public function getPrice($tax = true)
    {
        $price = $this->price;

        if ($tax) {
            $price += $this->getTax();
        }

        return $price;
    }

    public function getTax()
    {
        if (is_float($this->tax)) {
            return $this->tax;
        }

        return $this->price * $this->tax / 100;
    }

    public function setTax($tax, $percent = true)
    {
        if ($percent === true) {
            $tax = (int) $tax;
        } else {
            $tax = (float) $tax;
        }

        $this->tax = $tax;

        return $this;
    }

    public function getSubtotal($tax = true)
    {
        $price = $this->getPrice($tax);

        return $price * $this->quantity;
    }
}
