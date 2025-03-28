
# CSP Parser

This package contains a PHP class that will help you fetch and parse CSP headers from a website.

```php
require 'vendor/autoload.php';

$csp = new \Ssx\Csp\Parser('https://www.mywebsite.com/');
var_dump($csp->getDirectives());
```

You can use either `getDirectives()` to return an array of all the processed CSP directives or you can use `getDirective('script-src')` to get a particular type of directive.

Each directive will contain either an array of results or an empty array for a directive such as `upgrade-insecure-requests`:

```  
  "upgrade-insecure-requests" => []
  "font-src" => array:19 [
    0 => "fonts.gstatic.com"
    1 => "use.typekit.net"
    2 => "*.typekit.net"
    3 => "*.gstatic.com"
    4 => "*.hotjar.com"
    5 => "*.tidiochat.com"
    6 => "*.cookiebot.com"
    7 => "*.pcapredict.com"
    8 => "*.postcodeanywhere.co.uk"
    9 => "maxcdn.bootstrapcdn.com"
    10 => "*.stripe.com"
    11 => "klarna.com"
    12 => "*.klarna.com"
    13 => "*.klarnacdn.net"
    14 => "*.klarnaevt.com"
    15 => "*.superpayments.com"
    16 => "data:"
    17 => "'self'"
    18 => "'unsafe-inline'"
  ]
```
