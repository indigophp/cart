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

use Indigo\Container\Collection;
use Fuel\Validation\Rule\Type;
use Fuel\Common\Arr;

/**
 * Cart class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Cart extends Collection implements CartInterface
{
    use \Indigo\Container\Helper\Id;
    use \Indigo\Container\Helper\Reset;

    /**
     * Creates a new Cart
     *
     * @param mixed $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;

        parent::__construct(new Type('Indigo\\Cart\\ItemInterface'));
    }

    /**
     * {@inheritdoc}
     *
     * Cart id must be unique, so the same items should NOT mean the same cart
     */
    public function getId()
    {
        if (isset($this->id) === false) {
            $this->id = uniqid('__CART__');
        }

        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function add(ItemInterface $item)
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
     * {@inheritdoc}
     */
    public function getTotal($options = false)
    {
        $total = 0;

        foreach ($this->data as $id => $item) {
            $total += $item->getSubtotal($options);
        }

        return $total;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return Arr::sum($this->data, 'quantity');
    }
}
