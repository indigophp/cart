# Indigo Cart

[![Build Status](https://travis-ci.org/indigophp/cart.svg?branch=develop)](https://travis-ci.org/indigophp/cart)
[![Code Coverage](https://scrutinizer-ci.com/g/indigophp/cart/badges/coverage.png?s=08dc6c57aba0eb1fe81802736abc1d28e3730395)](https://scrutinizer-ci.com/g/indigophp/cart/)
[![Latest Stable Version](https://poser.pugx.org/indigophp/cart/v/stable.png)](https://packagist.org/packages/indigophp/cart)
[![Total Downloads](https://poser.pugx.org/indigophp/cart/downloads.png)](https://packagist.org/packages/indigophp/cart)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/indigophp/cart/badges/quality-score.png?s=8db49a4f6804240a1add0ac9400b621c1735a656)](https://scrutinizer-ci.com/g/indigophp/cart/)
[![License](https://poser.pugx.org/indigophp/cart/license.png)](https://packagist.org/packages/indigophp/cart)
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
$ codecept run
```


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/cart/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/cart/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/cart/blob/develop/LICENSE) for more information.
