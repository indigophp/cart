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
use Fuel\Validation\Rule\Type;
use Serializable;

/**
 * Item class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Item extends Struct implements ItemInterface, Serializable
{
    use \Indigo\Container\Helper\Serializable;

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
        'option' => array('type' => 'Indigo\\Cart\\Option\\OptionInterface'),
    );

    /**
     * Keys to ignore in the hashing process
     *
     * @var array
     */
    protected $ignoreKeys = array('quantity');

    /**
     * {@inheritdocs}
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
     * {@inheritdocs}
     */
    public function changeQuantity($quantity)
    {
        $this->data['quantity'] += (int) $quantity;

        return $this;
    }

    /**
     * {@inheritdocs}
     */
    public function getPrice($option = false)
    {
        $price = $this->price;

        if ($option and isset($this['option'])) {
            $price += $this->option->getValue($price);
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
        $tax = 0;

        if (isset($this['option'])) {
            $tax = $this->option->getValueOfType($this->price, new Type('Indigo\\Cart\\Option\\Tax'));
        }

        return $tax;
    }

    /**
     * {@inheritdocs}
     */
    public function getSubtotal($option = false)
    {
        $price = $this->getPrice($option);

        return $price * $this->quantity;
    }
}
