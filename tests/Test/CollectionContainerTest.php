<?php

namespace Indigo\Cart\Test;

use Fuel\Common\CollectionContainer;

class CollectionContainerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $collection = new CollectionContainer('integer', array(1,2,3));
    }

    public function testItem()
    {
        $this->assertTrue(true);
    }
}