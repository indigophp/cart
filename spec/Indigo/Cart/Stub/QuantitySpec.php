<?php

namespace spec\Indigo\Cart\Stub;

use PhpSpec\ObjectBehavior;

class QuantitySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\Stub\Quantity');
    }

    function it_should_have_quantity()
    {
        $this->getQuantity()->shouldBeInteger();
        $this->getQuantity()->shouldBe(1);
    }

    function it_should_allow_to_change_quantity()
    {
        $this->changeQuantity(1);

        $this->getQuantity()->shouldReturn(2);
    }

    function it_should_throw_an_exception_when_change_quantity_is_not_integer()
    {
        $this->shouldThrow('InvalidArgumentException')->duringChangeQuantity('123');
    }

    function it_should_allow_to_set_quantity()
    {
        $this->setQuantity(3);

        $this->getQuantity()->shouldReturn(3);
    }

    function it_should_throw_an_exception_when_set_quantity_is_not_integer()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetQuantity('123');
    }

    function it_should_throw_an_exception_when_set_quantity_is_not_positive()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetQuantity(-5);
    }
}
