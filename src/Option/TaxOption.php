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
use Fuel\Common\Arr;
use Serializable;

/**
 * Tax option class
 *
 * Calculate tax based on price
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class TaxOption extends Option implements Serializable
{
    /**
     * {@inheritdocs}
     */
    public function getValue($price = null)
    {
        if (is_float($this->value)) {
            return $this->value;
        }

        return $this->price * $this->value / 100;
    }
}
