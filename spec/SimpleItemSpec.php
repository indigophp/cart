<?php

namespace spec\Indigo\Cart;

use PhpSpec\ObjectBehavior;

class SimpleItemSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Item', 1, 1, '_ITEM_');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\SimpleItem');
        $this->shouldHaveType('Indigo\Cart\Item');
    }

    function it_should_throw_an_exception_when_price_is_not_numeric()
    {
        $this->shouldThrow('InvalidArgumentException')->during('__construct', ['Item', 'asd', 1]);
    }

    function it_should_have_an_id()
    {
        $this->beConstructedWith('Item', 1, 1);
        $this->getId()->shouldBeString();
    }

    function it_should_allow_to_have_an_id()
    {
        $this->getId()->shouldReturn('_ITEM_');
    }

    function it_should_have_name()
    {
        $this->getName()->shouldReturn('Item');
    }

    function it_should_have_price()
    {
        $this->getPrice()->shouldReturn(1);
    }

    function it_should_have_subtotal()
    {
        $this->getSubtotal()->shouldReturn(1);
    }
}
