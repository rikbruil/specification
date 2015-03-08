# Specification 
[![Build Status](https://travis-ci.org/rikbruil/specification.svg)](https://travis-ci.org/rikbruil/specification)
[![Coverage Status](https://coveralls.io/repos/rikbruil/specification/badge.svg?branch=master)](https://coveralls.io/r/rikbruil/specification?branch=master)

PHP implementation of the [Specification pattern][specification_pattern]

## Usage

```php
$overDue        = new OverDueSpecification();
$noticeSent     = new NoticeSentSpecification();
$inCollection   = new InCollectionSpecification();
 
// example of specification pattern logic chaining
$sendToCollection = $overDue->andX($noticeSent)
                            ->andX($inCollection->not());
 
foreach ($service->getInvoices() as $currentInvoice) {
    if (! $sendToCollection->IsSatisfiedBy($currentInvoice)) {
        continue;
    }
    
    $currentInvoice->sendToCollection();
}
```

## Requirements

- PHP 5.5+

However, I am planning to lower this to PHP 5.4+.

## License

Specification is licensed under the MIT License - see the `LICENSE` file for details

[specification_pattern]: http://en.wikipedia.org/wiki/Specification_pattern
