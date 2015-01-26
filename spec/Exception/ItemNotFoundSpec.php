<?php

namespace spec\Indigo\Cart\Exception;

use PhpSpec\ObjectBehavior;

class ItemNotFoundSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('item_id');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\Exception\ItemNotFound');
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldReturn('Item with id "item_id" cannot be found in this cart');
    }
}
