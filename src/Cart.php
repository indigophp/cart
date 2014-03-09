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
use Indigo\Cart\Item;
use Fuel\Common\DataContainer;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Cart extends DataContainer
{
    protected $id;
    protected $store;

    public function __construct(StoreInterface $store, $id = null)
    {
        if (empty($id)) {
            $id = uniqid('__CART__', true);
        }

        $this->id = $id;
        $this->store = $store;

        $items = $store->fetch($id);

        parent::__construct($items);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStore()
    {
        return $this->store;
    }

    public function setStore(StoreInterface $store)
    {
        $this->store = $store;

        return $this;
    }

    public function add(Item $item)
    {
        $id = $item->getId();

        if ($this->has($id)) {
            $currentItem = $this->get($id);
            $currentItem->addQuantity($item->quantity);
        } else {
            if (!$item->has('tax')) {
                $item->setReadOnly(false);

                $item->tax = $this->tax;
            }

            // Set parent, but disable the usage
            $item->setParent($this)->disableParent();

            $this->set($id, $item);
        }

        return $this;
    }

    public function getTotal($tax = true)
    {
        $total = 0;

        foreach ($this->data as $id => $item) {
            $total += $item->getSubtotal($tax);
        }
    }

    public function getQuantity()
    {
        return Arr::sum($this->data, 'quantity');
    }
}
