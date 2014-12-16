<?php

namespace spec\Indigo\Cart\Store;

use Indigo\Cart\Cart;
use PhpSpec\ObjectBehavior;

class SessionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\Store\Session');
        $this->shouldHaveType('Indigo\Cart\Store');
    }

    function it_should_have_a_session_key()
    {
        $this->beConstructedWith('SESSION_KEY');

        $this->getSessionKey()->shouldReturn('SESSION_KEY');
    }

    function it_should_load_a_cart(Cart $cart)
    {
        $cart->getId()->willReturn('cart');

        $this->load($cart)->shouldReturn(false);
    }

    function it_should_save_a_cart(Cart $cart)
    {
        $cart->getId()->willReturn('cart');
        $cart->getItems()->willReturn([]);

        $this->save($cart)->shouldReturn(true);
    }

    function it_should_delete_a_cart(Cart $cart)
    {
        $cart->getId()->willReturn('cart');

        $this->delete($cart)->shouldReturn(true);
    }

    function it_should_load_an_existing_cart(Cart $cart)
    {
        $cart->getId()->willReturn('cart');
        $cart->getItems()->willReturn([]);
        $cart->setItems([])->shouldBeCalled();

        $this->save($cart)->shouldReturn(true);

        $this->load($cart)->shouldReturn(true);
    }
}
