<?php

/*
 * This file is part of the Indigo Cart package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fuel\Common;

use Fuel\Validation\Validator;
use Fuel\Validation\RuleProvider\FromArray;

/**
 * Struct Container
 *
 * DataContainer to store a given structure with validation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class StructContainer extends ValidationContainer
{
    protected static $struct = [];

    protected static $validatorClass = 'Fuel\\Validation\\ContainerValidator';

    public function __construct(array $data = array(), $readOnly = false)
    {
        $validator = new static::$validatorClass;
        $this->populateValidator($validator);

        parent::__construct($validator, $data, $readOnly);
    }

    public static function populateValidator(Validator $validator)
    {
        $generator = new FromArray;
        $generator->setData(static::$struct)->populateValidator($validator);

        return $validator;
    }
}
