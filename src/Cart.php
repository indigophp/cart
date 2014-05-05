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
    protected $id;
    protected $store;

    public function __construct(StoreInterface $store, $id = null)
    {
        if (empty($id)) {
            $id = uniqid('__CART__', true);
        }

        $data = $store->get($id);

        $this->id = $id;
        $this->store = $store;


        parent::__construct(new Type('Indigo\\Cart\\Item'), $data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStore()
    {
        return $this->store;
    }

    public function save()
    {
        return $this->store->save($this->id, $this->data);
    }

    public function delete($preserveStore = false)
    {
        if ($preserveStore === false) {
            $this->store->delete($this->id);
        }

        $this->data = array();

        return true;
    }

    public function add(Item $item)
    {
        $id = $item->getId();

        if ($this->has($id)) {
            $currentItem = $this->get($id);
            $currentItem->add($item->quantity);
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
            $tax += $item->getTax() * $item->quantity;
        }

        return $tax;
    }

    public function getQuantity()
    {
        return Arr::sum($this->data, 'quantity');
    }
}
