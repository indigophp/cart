# Indigo Cart

[![Build Status](https://img.shields.io/travis/indigophp/cart/develop.svg?style=flat-square)](https://travis-ci.org/indigophp/cart)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/cart.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/cart)
[![Packagist Version](https://img.shields.io/packagist/v/indigophp/cart.svg?style=flat-square)](https://packagist.org/packages/indigophp/cart)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/cart.svg?style=flat-square)](https://packagist.org/packages/indigophp/cart)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/cart.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/cart)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Dependency Status](https://www.versioneye.com/user/projects/53c95da0c2756785da000026/badge.svg?style=flat)](https://www.versioneye.com/user/projects/53c95da0c2756785da000026)

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


## Usage

There is a simple Cart and Item implementation in the package:

``` php
use Indigo\Cart\SimpleCart;
use Indigo\Cart\SimpleItem;
use Indigo\Cart\SessionStore;

$cart = new Cart('cart_id');

// id, name, price, quantity
$cart->addItem(new SimpleItem(1, 'Product name', 1234, 1));

// Get total price
$cart->getTotal();

// Get item count (item * quantity)
$cart->getQuantity();

foreach($cart->getItems() as $id => $item) {
    // Get subtotal
    $item->getSubtotal();

    // Get price
    $item->getPrice();

    // Get name
    $item->getName();
}

$store = new SessionStore;
$store->save($cart);
```

Get existing cart:

``` php
use Indigo\Cart\Cart;
use Indigo\Cart\SessionStore;

$cart = new Cart('cart_id');

$store = new SessionStore;
$store->load($cart);
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/cart/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/cart/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/cart/blob/develop/LICENSE) for more information.
