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

use Fuel\Validation\ContainerValidator as Validator;
use Fuel\Validation\RuleProvider\FromArray;

/**
 * Validable DataContainer
 *
 * DataContainer extension to validate data
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ValidableDataContainer extends DataContainer
{
    protected static $validation = [];

    protected static $defaultValidator;

    protected $validator;

    /**
     * {@inheritdocs}
     */
    public function __construct(array $data = array(), $readOnly = false, Validator $validator = null)
    {
        if ($validator === null) {
            $validator = static::getValidator();
        }

        $this->validator = $validator;

        $result = $validator->run($data);

        if (!$result->isValid()) {
            $error = $result->getErrors();

            throw new \Exception(reset($error));
        }

        parent::__construct($data, $readOnly);
    }

    public static function getValidator()
    {
        if (static::$defaultValidator === null) {
            static::forgeValidator();
        }

        return static::$defaultValidator;
    }

    public static function setValidator(Validator $validator)
    {
        static::$defaultValidator = $validator;
    }

    public static function forgeValidator()
    {
        static::$defaultValidator = new Validator;

        $generator = new FromArray;
        $generator->setData(static::$validation)->populateValidator(static::$defaultValidator);
    }

    public function set($key, $value)
    {
        $result = $this->validator->runField($key, $value, $this->data);

        if (!$result->isValid()) {
            $error = $result->getError($key);

            throw new \Exception($error);
        }

        return parent::set($key, $value);
    }
}
