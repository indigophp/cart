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

/**
 * Total price calculator
 *
 * Price can be represented multiple ways (eg. with monetary value objects)
 * therefore calculating total in Cart objects is really hard
 * (normal addition operators cannot be used without lower-level PHP hacking)
 *
 * To solve this problem you can implement this interface on any Item objects
 * to make it capable of calculating the total on its own (with the Cart's guidance)
 *
 * Total calculation can be decoupled from Cart objects (which can rely on this interface)
 *
 * NOTE: Mixing multiple items (implementing this interface) in one cart is dangerous
 * Always check that the different items are compatible
 * (eg. use the same monetary value representation)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface TotalCalculator
{
    /**
     * Null initial value means this is the first item in the chain
     *
     * Checking the format/type of the provided total is recommended
     *
     * @param mixed $total
     *
     * @return mixed New total
     */
    public function calculateTotal($total = null);
}
