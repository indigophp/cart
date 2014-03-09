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

use Fuel\Common\ValidableDataContainer;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Item extends ValidableDataContainer
{
    protected static $validation = array(
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
            'type' => 'integer',
        ),
        'tax' => array('type' => 'float'),
        'options' => array('type' => 'array'),
    );

    public function addQuantity($quantity)
    {
        $this->data['quantity'] += $quantity;

        return $this;
    }

    public function getPrice($tax = true)
    {
        $price = $this->price;

        if ($tax) {
            $price = $price * (100 + $this->tax) / 100;
        }

        return $price;
    }

    public function getSubtotal($tax = true)
    {
        $price = $this->getPrice($tax);

        return $price * $this->quantity;
    }
}
