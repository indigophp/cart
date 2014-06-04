<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Option;

/**
 * Tax Interface
 *
 * Special OptionInterface to indicate taxes
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface TaxInterface
{
    /**
     * Tax calculating mode
     */
    const ABSOLUTE = 1;
    const PERCENT  = 2;
}
