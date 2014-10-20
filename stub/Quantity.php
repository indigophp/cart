<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Stub;

/**
 * Quantity Stub
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Quantity
{
    use \Indigo\Cart\Quantity;

    public function __construct()
    {
        $this->quantity = 1;
    }
}
