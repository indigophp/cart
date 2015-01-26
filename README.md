# Indigo Cart

[![Latest Version](https://img.shields.io/github/release/indigophp/cart.svg?style=flat-square)](https://github.com/indigophp/cart/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/indigophp/cart.svg?style=flat-square)](https://travis-ci.org/indigophp/cart)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/indigophp/cart.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/cart)
[![Quality Score](https://img.shields.io/scrutinizer/g/indigophp/cart.svg?style=flat-square)](https://scrutinizer-ci.com/g/indigophp/cart)
[![HHVM Status](https://img.shields.io/hhvm/indigophp/cart.svg?style=flat-square)](http://hhvm.h4cc.de/package/indigophp/cart)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/cart.svg?style=flat-square)](https://packagist.org/packages/indigophp/cart)
[![Dependency Status](https://img.shields.io/versioneye/d/php/indigophp:cart.svg?style=flat-square)](https://www.versioneye.com/php/indigophp:cart)

**Cart abstraction layer.**


## Install

Via Composer

``` bash
$ composer require indigophp/cart
```


## Usage

There is a simple Cart and Item implementation in the package:

``` php
use Indigo\Cart\SimpleCart;
use Indigo\Cart\SimpleItem;
use Indigo\Cart\Store\Session;

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

$store = new Session;
$store->save($cart);
```

Get existing cart:

``` php
use Indigo\Cart\Cart;
use Indigo\Cart\Store\Session;

$cart = new Cart('cart_id');

$store = new Session;
$store->load($cart);
```


## Testing

``` bash
$ phpspec run
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/cart/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
