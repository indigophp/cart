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

use Indigo\Container\Struct;
use Serializable;

/**
 * Tax option class
 *
 * Calculate tax based on price
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Tax extends Struct implements OptionInterface, TaxInterface, Serializable
{
    use \Indigo\Container\Helper\Id;
    use \Indigo\Container\Helper\Serializable;

    /**
     * {@inheritdoc}
     */
    protected $struct = [
        'id' => [
            'type' => ['integer', 'string'],
        ],
        'name' => [
            'required',
            'type' => 'string',
        ],
        'value' => [
            'type' => ['float', 'int'],
        ],
        'mode'  => [
            'value' => [TaxInterface::ABSOLUTE, TaxInterface::PERCENT],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function getValue($price)
    {
        if ($this->get('mode', static::ABSOLUTE) === static::ABSOLUTE) {
            return $this->value;
        }

        return $price * $this->value / 100;
    }
}
