<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fuel\Validation;

class ContainerValidator extends Validator
{
    public function runField($fieldName, $value, $data, ResultInterface $result = null)
    {
        if ($result === null)
        {
            $result = new Result;
        }

        $result->setResult(true);

        $fieldResult = $this->validateField($fieldName, $value, $data, $result);

        if ( ! $fieldResult)
        {
            // There was a failure so log it to the result object
            $result->setResult(false);
        }

        return $result;
    }
}
