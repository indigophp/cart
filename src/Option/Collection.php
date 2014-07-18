<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Option;

use Indigo\Container\Collection as CollectionContainer;
use Fuel\Validation\Rule\Type;
use Serializable;

/**
 * Option collection class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Collection extends CollectionContainer implements OptionInterface, Serializable
{
    use \Indigo\Container\Helper\Id;
    use \Indigo\Container\Helper\Insert;
    use \Indigo\Container\Helper\Serializable;

    /**
     * Creates a new Collection
     *
     * @param []      $data
     * @param boolean $readOnly
     */
    public function __construct(array $data = [], $readOnly = false)
    {
        parent::__construct(new Type('Indigo\\Cart\\Option\\OptionInterface'), [], $readOnly);

        foreach ($data as $value) {
            $this->add($value);
        }
    }

    /**
     * Add option to collection
     *
     * @param  OptionInterface $option
     * @param  integer|null    $pos
     * @return Collection
     */
    public function add(OptionInterface $option, $pos = null)
    {
        $id = $option->getId();

        if ($this->has($id) === false) {
            // Set parent, but disable the usage
            // Set option to read-only
            $option
                ->setParent($this)
                ->disableParent()
                ->setReadOnly();

            $this->insertAssoc($id, $option, $pos);
        }

        return $this;
    }

    /**
     * {@inheritdocs}
     */
    public function getValue($price)
    {
        $total = 0;

        foreach ($this->data as $option) {
            $value = $option->getValue($price);

            $total += $value;
            $price += $value;
        }

        return $total;
    }

    /**
     * Returns the value of type
     *
     * @param boolean $filter If false, the given types will be filtered out
     *
     * @return float
     */
    public function getValueOfType($price, Type $type, $filter = true)
    {
        $total = 0;

        foreach ($this->data as $option) {
            $value = $option->getValue($price);

            $price += $value;

            if ($type->validate($option) === (bool) $filter) {
                $total += $value;
            }
        }

        return $total;
    }
}
