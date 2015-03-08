<?php

namespace spec\Rb\Specification;

use PhpSpec\ObjectBehavior;
use Rb\Specification\AndX;
use Rb\Specification\CompositeSpecification;
use Rb\Specification\Not;
use Rb\Specification\OrX;
use Rb\Specification\SpecificationInterface;

class CompositeSpecificationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('spec\Rb\Specification\DummySpec');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Rb\Specification\CompositeSpecification');
    }

    public function it_should_return_and_specification(SpecificationInterface $specification)
    {
        $specification->isSatisfiedBy('foo')->willReturn(true);

        $and = $this->andX($specification);
        $and->shouldHaveType('Rb\Specification\AndX');
        $and->isSatisfiedBy('foo')->shouldReturn(true);
    }

    public function it_should_return_or_specification(SpecificationInterface $specification)
    {
        $specification->isSatisfiedBy('foo')->willReturn(false);

        $or = $this->orX($specification);
        $or->shouldHaveType('Rb\Specification\OrX');
        $or->isSatisfiedBy('foo')->shouldReturn(true);
    }

    public function it_should_return_not_specification(SpecificationInterface $specification)
    {
        $specification->isSatisfiedBy('foo')->willReturn(true);

        $not = $this->not($specification);
        $not->shouldHaveType('Rb\Specification\Not');
        $not->isSatisfiedBy('foo')->shouldReturn(false);
    }
}

class DummySpec extends CompositeSpecification
{
    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy($value)
    {
        return $value === 'foo';
    }
}
