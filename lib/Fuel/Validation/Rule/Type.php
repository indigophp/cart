<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fuel\Validation\Rule;

use Fuel\Validation\AbstractRule;

/**
 * Type Rule class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Type extends AbstractRule
{
    /**
     * {@inheritdocs}
     */
    protected $message = 'The field {label} is not one of the following type(s): {type}.';

    /**
     * {@inheritdocs}
     */
    public function validate($value, $field = null, $allFields = null)
    {
        $allowedTypes = (array) $this->getParameter();

        foreach ($allowedTypes as $type) {
            $isFunction = 'is_'.$type;

            if (function_exists($isFunction) && $isFunction($value)) {
                return true;
            } elseif ($value instanceof $type) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdocs}
     */
    public function getMessageParameters()
    {
        $type = $this->getParameter();

        if (is_array($type)) {
            $type = implode(', ', $type);
        }

        return array('type' => $type);
    }
}
