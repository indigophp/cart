<?php

namespace spec\Indigo\Cart\Stub;

use PhpSpec\ObjectBehavior;

class QuantitySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\Stub\Quantity');
        $this->shouldUseTrait('Indigo\Cart\Quantity');
    }

    function it_has_quantity()
    {
        $quantity = $this->getQuantity();

        $quantity->shouldBeInteger();
        $quantity->shouldBe(1);
    }

    function it_changes_quantity()
    {
        $this->changeQuantity(1);

        $this->getQuantity()->shouldReturn(2);
    }

    function it_throws_an_exception_when_change_quantity_is_not_integer()
    {
        $this->shouldThrow('InvalidArgumentException')->duringChangeQuantity('123');
    }

    function it_sets_quantity()
    {
        $this->setQuantity(3);

        $this->getQuantity()->shouldReturn(3);
    }

    function it_throws_an_exception_when_set_quantity_is_not_integer()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetQuantity('123');
    }

    function it_throws_an_exception_when_set_quantity_is_not_positive()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetQuantity(-5);
    }

    public function getMatchers()
    {
        return [
            'useTrait' => function ($subject, $trait) {
                return class_uses($subject, $trait);
            }
        ];
    }
}
