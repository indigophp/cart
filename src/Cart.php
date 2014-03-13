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
use Fuel\Common\CollectionContainer;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Cart extends CollectionContainer
{
    protected $id;
    protected $store;
    protected $tax;

    public function __construct(StoreInterface $store, $id = null)
    {
        if (empty($id)) {
            $id = uniqid('__CART__', true);
        }

        $data = $store->fetch($id);

        $this->id = $id;
        $this->store = $store;


        parent::__construct('Indigo\\Cart\\Item', $data);
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

        // Make sure the new store has the data
        $this->save();

        return $this;
    }

    public function save()
    {
        return $this->store->save($this->id, $this->data);
    }

    public function flush($preserveStore = false)
    {
        if ($preserveStore === false) {
            $this->store->flush($this->id);
        }

        $this->data = array();
    }

    public function add(Item $item)
    {
        $id = $item->getId();

        if ($this->has($id)) {
            $currentItem = $this->get($id);
            $currentItem->add($item->quantity);
        } else {
            if (!$item->has('tax')) {
                $item->tax = $this->tax;
            }

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

    public function setTax($tax, $percent = true)
    {
        if ($precent === true) {
            $tax = (int) $tax;
        } else {
            $tax = (float) $tax;
        }

        $this->tax = $tax;

        return $this;
    }

    public function remove($item)
    {
        if ($item instanceof Item) {
            $item = $this->getId();
        }

        return $this->delete($item);
    }

    public function getTotal($tax = true)
    {
        $total = 0;

        foreach ($this->data as $id => $item) {
            $total += $item->getSubtotal($tax);
        }

        return $total;
    }

    public function getTax()
    {
        $tax = 0;

        foreach ($this->data as $id => $item) {
            $tax += $item->getTax();
        }

        return $tax;
    }

    public function getQuantity()
    {
        return Arr::sum($this->data, 'quantity');
    }
}
