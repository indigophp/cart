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

use Indigo\Cart\Store\StoreInterface;
use Indigo\Container\Collection;
use Fuel\Validation\Rule\Type;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Cart extends Collection
{
    /**
     * Cart ID
     *
     * @var string
     */
    protected $id;

    public function __construct($id = null)
    {
        if (empty($id)) {
            $id = uniqid('__CART__', true);
        }

        $this->id = $id;

        parent::__construct(new Type('Indigo\\Cart\\Item'));
    }

    /**
     * Get Cart ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add item to Cart
     *
     * @param Item $item
     * @return Cart
     */
    public function add(Item $item)
    {
        $id = $item->getId();

        if ($this->has($id)) {
            $currentItem = $this->get($id);
            $currentItem->changeQuantity($item->quantity);
        } else {
            // Set parent, but disable the usage
            // Set item to read-only
            $item
                ->setParent($this)
                ->disableParent()
                ->setReadOnly();

            $this->set($id, $item);
        }

        return $this;
    }

    /**
     * Get total
     *
     * @param  boolean $tax Get taxed price
     * @return float
     */
    public function getTotal($tax = false)
    {
        $total = 0;

        foreach ($this->data as $id => $item) {
            $total += $item->getSubtotal($tax);
        }

        return $total;
    }

    /**
     * Get total tax
     *
     * @return float
     */
    public function getTax()
    {
        $tax = 0;

        foreach ($this->data as $id => $item) {
            $tax += $item->getTax() * $item->quantity;
        }

        return $tax;
    }

    /**
     * Get total quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return Arr::sum($this->data, 'quantity');
    }
}
