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
    $className = get_class($currentInvoice);
    
    if (! $sendToCollection->IsSatisfiedBy($className))  {
        continue;
    }
    
    $currentInvoice->sendToCollection();
}
```

## Composition
A bonus of this pattern is composition, which makes specifications very reusable:

```php

use Entity\Advertisement;

class ExpiredAds extends SpecificationCollection
{
    public function __construct()
    {
        $specs = [
            new Equals('ended', 0),
            new OrX(
                new LowerThan('endDate', new \DateTime()),
                new AndX(
                    new IsNull('endDate'),
                    new LowerThan('startDate', new \DateTime('-4weeks'))
                )
            )
        ];
        parent::__construct($specs);
    }
    
    public function supports($className)
    {
        return $className === Advertisement::class;
    }
}

use Entity\User;

class AdsByUser extends SpecificationCollection
{
    public function __construct(User $user)
    {
        $specs = [
            new Select('u'),
            new Join('user', 'u'),
            new Equals('id', $user->getId(), 'u'),
        ];
        
        parent::__construct($specs);
    }

    public function supports($className)
    {
        return $className == Advertisement::class && parent::supports($className);
    }
}

class SomeService
{
    /**
     * Fetch Adverts that we should close but only for a specific company
     */
    public function myQuery(User $user)
    {
        $spec = new SpecificationCollection([
            new ExpiredAds(),
            new AdsByUser($user),
        ]);

        return $this->em->getRepository('Advertisement')->match($spec)->execute();
    }
    
    /**
     * Fetch adverts paginated by Doctrine Paginator with joins intact.
     * A paginator can be iterated over like a normal array or Doctrine Collection
     */
    public function myPaginatedQuery(User $user, $page = 1, $size = 10)
    {
        $spec = new SpecificationCollection([
            new ExpiredAds(),
            new AdsByUser($user),
        ]);
        
        $query = $this->em->getRepository('Advertisement')->match($spec);
        $query->setFirstResult(($page - 1) * $size))
            ->setMaxResults($size);
        return new Paginator($query);
    }
}
```

## Requirements

Doctrine-Specification requires:

- PHP 5.5+
- Doctrine 2.2

However, I am planning to lower this to PHP 5.4+.

## License

Doctrine-Specification is licensed under the MIT License - see the `LICENSE` file for details

## Acknowledgements

This library is heavily inspired by Benjamin Eberlei's [blog post][blog_post]
and [Happyr's Doctrine-Specification library][happyr_spec].

[specification_pattern]: http://en.wikipedia.org/wiki/Specification_pattern
[happyr_spec]: https://github.com/Happyr/Doctrine-Specification
[blog_post]: http://www.whitewashing.de/2013/03/04/doctrine_repositories.html
