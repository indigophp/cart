# Indigo Cart

**Indigo Cart manages shopping cart and takes care of the related tasks.**


## Install

Via Composer

``` json
{
    "require": {
        "indigophp/cart": "@stable"
    }
}
```

**Note**: Package uses PSR-4 autoloader, make sure you have a fresh version of Composer.


## Usage

Instantiate cart and fill it with items:

``` php
use Indigo\Cart\Cart;
use Indigo\Cart\Item;
use Indigo\Cart\Store\SessionStore;

$cart = new Cart('cart_id');

$cart->add(
    new Item(
        array(
            'id'       => 1,
            'name'     => 'Some Product',
            'price'    => 1.000,
            'quantity' => 1,
            'tax'      => 27,
        )
    )
);

// Get taxed price
$cart->getTotal(true);

// Get total tax
$cart->getTax();

// Get item count (item * quantity)
$cart->getQuantity();

foreach($cart as $id => $item) {
    // Get taxed subtotal
    $item->getSubtotal(true);

    // Get tax amount of ONE item
    $item->getTax();

    // Get taxed price
    $item->getPrice();
}

$store = new SessionStore;
$store->save($cart);
```

Get existing cart:

``` php
use Indigo\Cart\Cart;
use Indigo\Cart\Store\SessionStore;

$cart = new Cart('cart_id');

$store = new SessionStore;
$store->load($cart);
```


## Testing

``` bash
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/cart/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/cart/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/cart/blob/develop/LICENSE) for more information.