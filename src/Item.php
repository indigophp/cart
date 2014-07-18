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
use Fuel\Validation\Rule\Type;
use Serializable;

/**
 * Item class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Item extends Struct implements ItemInterface, Serializable
{
    use \Indigo\Container\Helper\Id;
    use \Indigo\Container\Helper\Serializable;

    /**
     * {@inheritdoc}
     */
    protected $struct = [
        'id' => [
            'required',
            'type' => ['integer', 'string'],
        ],
        'name' => [
            'required',
            'type' => 'string',
        ],
        'price' => [
            'required',
            'type' => 'float',
        ],
        'quantity' => [
            'required',
            'type'       => 'integer',
            'numericMin' => 1,
        ],
        'option' => [
            'type' => 'Indigo\\Cart\\Option\\OptionInterface'
        ],
    ];

    /**
     * Keys to ignore in the hashing process
     *
     * @var []
     */
    protected $ignoreKeys = ['quantity'];

    /**
     * {@inheritdoc}
     */
    public function changeQuantity($quantity)
    {
        $this->data['quantity'] += (int) $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice($option = false)
    {
        $price = $this->price;

        if ($option and isset($this->data['option'])) {
            $price += $this->option->getValue($price);
        }

        return $price;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubtotal($option = false)
    {
        $price = $this->getPrice($option);

        return $price * $this->quantity;
    }
}
