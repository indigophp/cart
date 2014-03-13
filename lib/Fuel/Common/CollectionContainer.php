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

use InvalidArgumentException;

/**
 * Collection container
 *
 * Store a collection of type
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class CollectionContainer extends DataContainer
{
    /**
     * Contains the name of the type
     *
     * @var string
     */
    private $type;

    /**
     * Check whether type is primitive (has is_ function)
     *
     * @var boolean
     */
    private $primitive;

    public function __construct($type, array $data = array(), $readOnly = false)
    {
        if (empty($type) or is_string($type) === false) {
            throw new InvalidArgumentException('Invalid type given');
        }

        $this->primitive = function_exists('is_'.$type);
        $this->type = $type;

        parent::__construct($data, $readOnly);
    }

    /**
     * Get type of collection
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Check whether type of collection is primitive
     *
     * @return boolean
     */
    public function isPrimitive()
    {
        return $this->primitive;
    }

    /**
     * Validate a value
     *
     * @param  mixed   $value
     * @return boolean
     */
    public function isValid($value)
    {
        if ($this->primitive === true) {
            return call_user_func('is_'.$this->type, $value);
        }

        return $value instanceof $this->type;
    }

    /**
     * {@inheritdocs}
     */
    public function set($key, $value)
    {
        if ($this->isValid($value) === false) {
            throw new InvalidArgumentException('The item is not of type '.$this->type);
        }

        return parent::set($key, $value);
    }

    /**
     * {@inheritdocs}
     */
    public function merge($arg)
    {
        $arguments = array_map(function ($array) {
            if ($array instanceof DataContainer) {
                return $array->getContents();
            }

            return $array;

        }, func_get_args());

        $arguments = call_user_func_array('Arr::merge', $arguments);

        foreach ($arguments as $key => $value) {
            if ($this->isValid($value) === false) {
                throw new InvalidArgumentException('The item is not of type '.$this->type);
            }
        }

        return parent::merge($arguments);
    }
}
