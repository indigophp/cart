<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Cart\Exception;

/**
 * Thrown when item cannot be found
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ItemNotFound extends \OutOfBoundsException
{
    /**
     * @param integer|string $id
     */
    public function __construct($id)
    {
        parent::__construct(sprintf('Item with id "%s" cannot be found in this cart', $id));
    }
}
