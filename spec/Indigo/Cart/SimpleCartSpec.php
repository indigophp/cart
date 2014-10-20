<?php

namespace spec\Indigo\Cart;

use Indigo\Cart\Item;
use PhpSpec\ObjectBehavior;

class SimpleCartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Cart\SimpleCart');
        $this->shouldHaveType('Indigo\Cart\Cart');
        $this->shouldHaveType('IteratorAggregate');
    }

    function it_should_have_an_id()
    {
        $this->getId()->shouldBeString();
    }

    function it_should_allow_to_have_an_id()
    {
        $this->beConstructedWith('_CART_');

        $this->getId()->shouldReturn('_CART_');
    }

    function it_should_allow_to_add_an_item(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->hasItem('_ITEM_')->shouldReturn(true);
    }

    function it_should_allow_to_update_an_item(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');
        $item->getQuantity()->willReturn(1);
        $item->changeQuantity(1)->shouldBeCalled();

        $this->addItem($item);
        $this->addItem($item);

        $this->hasItem('_ITEM_')->shouldReturn(true);
    }

    function it_should_allow_to_remove_an_item(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->removeItem($item)->shouldReturn(true);
        $this->hasItem('_ITEM_')->shouldReturn(false);
    }

    function it_should_allow_to_remove_an_item_by_id(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->removeItem('_ITEM_')->shouldReturn(true);
        $this->hasItem('_ITEM_')->shouldReturn(false);
    }

    function it_should_return_false_when_item_is_not_present_on_removal()
    {
        $this->removeItem('_ITEM_')->shouldReturn(false);
    }

    function it_should_allow_to_calculate_total(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');
        $item->getSubtotal()->willReturn(1);

        $this->addItem($item);

        $this->getTotal()->shouldReturn(1);
    }

    function it_should_allow_to_calculate_total_using_total_calculator(Item $item)
    {
        $item->implement('Indigo\Cart\TotalCalculator');

        $item->getId()->willReturn('_ITEM_');
        $item->calculateTotal(null)->willReturn(2);

        $this->addItem($item);

        $this->getTotal()->shouldReturn(2);
    }

    function it_should_have_quantity(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');
        $item->getQuantity()->willReturn(1);

        $this->addItem($item);

        $this->getQuantity()->shouldReturn(1);
    }

    function it_should_be_empty_by_default()
    {
        $this->shouldBeEmpty();
    }

    function it_should_not_be_empty_when_items_added(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->shouldNotBeEmpty();
    }

    function it_should_allow_to_be_reset(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->reset()->shouldReturn(true);
        $this->isEmpty()->shouldBe(true);
    }

    function it_should_expose_items(Item $item)
    {
        $item->getId()->willReturn('_ITEM_');

        $this->addItem($item);

        $this->getItems()->shouldReturn(['_ITEM_' => $item]);
    }

    function it_should_allow_to_set_items(Item $item)
    {
        $items = ['_ITEM_' => $item];

        $this->setItems($items);

        $this->hasItem('_ITEM_')->shouldReturn(true);
    }

    function it_should_expose_an_iterator()
    {
        $this->getIterator()->shouldHaveType('ArrayIterator');
    }

    function it_should_have_count()
    {
        $this->count()->shouldBe(0);
    }
}
