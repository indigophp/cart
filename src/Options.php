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

use Indigo\Cart\Option\OptionInterface;
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
        parent::__construct(new Type('Indigo\\Cart\\Option\\OptionInterface'));
    }

    /**
     * Add option to collection
     *
     * @param  OptionInterface $option
     * @return Options
     */
    public function add(OptionInterface $option)
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
     * Get value
     *
     * @return float
     */
    public function getValue($price)
    {
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
}
