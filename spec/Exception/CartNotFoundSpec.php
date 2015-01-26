<?php

namespace spec\Indigo\Cart\Exception;

use PhpSpec\ObjectBehavior;

class CartNotFoundSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('cart_id');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\Exception\CartNotFound');
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldReturn('Cart with id "cart_id" cannot be found in this store');
    }
}
