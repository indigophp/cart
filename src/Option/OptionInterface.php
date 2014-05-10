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
 * Option Interface
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface OptionInterface
{
    /**
     * Return a unique identifier for the Option
     *
     * @return string
     */
    public function getId();

    /**
     * Return the value of the option
     *
     * @param  float $price Price the calculation depends on
     * @return float
     */
    public function getValue($price);
}
