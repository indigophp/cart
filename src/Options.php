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

use Indigo\Cart\Option\Option;
use Indigo\Container\Collection;
use Fuel\Validation\Rule\Type;
use Fuel\Common\Arr;

/**
 * Options class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Options extends Collection
{
    public function __construct()
    {
        parent::__construct(new Type('Indigo\\Cart\\Option\\Option'));
    }

    /**
     * Add option to collection
     *
     * @param  Option           $option
     * @return OptionCollection
     */
    public function add(Option $option)
    {
        $id = $option->getId();

        if ($this->has($id) === false) {
            // Set parent, but disable the usage
            // Set option to read-only
            $option
                ->setParent($this)
                ->disableParent()
                ->setReadOnly();

            $this->set($id, $option);
        }

        return $this;
    }

    /**
     * {@inheritdocs}
     */
    public function setContents(array $data)
    {
        $return = parent::setContents($data);

        $this->ensureOrder();

        return $return;
    }

    /**
     * {@inheritdocs}
     */
    public function set($key, $value)
    {
        $return = parent::set($key, $value);

        $this->ensureOrder();

        return $return;
    }

    /**
     * {@inheritdocs}
     */
    public function merge($arg)
    {
        $return = call_user_func_array(array(get_parent_class($this), 'merge'), func_get_args());

        $this->ensureOrder();

        return $return;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue($price)
    {
        $this->ensureOrder();

        $total = 0;
        // $price = $this->parent->getPrice();

        foreach ($this->data as $option) {
            $value = $option->getValue($price);

            $total += $value;
            $price += $value;
        }

        return $total;
    }

    /**
     * Get value of type
     *
     * @return float
     */
    public function getValueOfType($type)
    {
        $this->ensureOrder();

        $total = 0;
        $price = $this->parent->getPrice();

        foreach ($this->data as $option) {
            $value = $option->getValue($price);

            $price += $value;

            if ($option instanceof $type) {
                $total += $value;
            }
        }

        return $total;
    }

    /**
     * Ensure options are processed in the right order
     *
     * @return boolean
     */
    protected function ensureOrder()
    {
        return uasort($this->data, function($a, $b) {
            return $a['order'] < $b['order'] ? -1 : 1;
        });
    }
}
