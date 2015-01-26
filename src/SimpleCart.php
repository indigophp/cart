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

/**
 * Proof of concept Cart implementation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SimpleCart implements Cart, \IteratorAggregate
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var Item[]
     */
    private $items = [];

    /**
     * @param mixed $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        if ($this->id === null) {
            $this->id = uniqid('__CART__');
        }

        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getItem($id)
    {
        if (!$this->hasItem($id)) {
            throw new Exception\ItemNotFound($id);
        }

        return $this->items[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem($id)
    {
        return array_key_exists($id, $this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(Item $item)
    {
        $id = $item->getId();

        if ($currentItem = $this->getItem($id)) {
            $currentItem->changeQuantity($item->getQuantity());

            return;
        }

        $this->items[$id] = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem($item)
    {
        if ($item instanceof Item) {
            $item = $item->getId();
        }

        if ($this->hasItem($item)) {
            unset($this->items[$item]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {
        // Null initial value is used for TotalCalculator
        // It is casted to integer when TotalCalculator is not used
        $total = null;

        foreach ($this->items as $item) {
            if ($item instanceof TotalCalculator) {
                $total = $item->calculateTotal($total);

                continue;
            }

            $total += $item->getSubtotal();
        }

        return $total;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        $quantities = array_map(function ($item) {
            return $item->getQuantity();
        }, $this->items);

        return array_sum($quantities);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->items = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getItems());
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
