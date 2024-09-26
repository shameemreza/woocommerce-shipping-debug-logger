# WooCommerce Shipping Debug Logger

Logs shipping calculation attempts and results.

## Here is how to use it:

* Download as a zip and install like a WordPress Plugin.
* Once activated, whenever someone interacts with the cart or checkout pages, this plugin will log information about shipping calculations to a file called `shipping-debug.log` in your `wp-content` directory.
* Try to reproduce the issue by adding products to your cart and proceeding to checkout.

## The log file will contain information about:

* When shipping calculations are triggered
* What shipping packages are being created
* What shipping rates are available for each package
