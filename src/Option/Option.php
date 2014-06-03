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
 * Cart item option class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Option extends Struct implements OptionInterface, Serializable
{
    use \Indigo\Container\Helper\Id;
    use \Indigo\Container\Helper\Serializable;

    /**
     * {@inheritdocs}
     */
    protected $struct = array(
        'id' => array(
            'type' => array('integer', 'string')
        ),
        'name' => array(
            'required',
            'type' => 'string',
        ),
        'value' => array(
            'type' => 'float'
        ),
    );

    /**
     * {@inheritdocs}
     */
    public function getValue($price)
    {
        return $this->value;
    }
}
