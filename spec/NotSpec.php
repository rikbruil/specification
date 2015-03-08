<?php

namespace spec\Rb\Specification;

use PhpSpec\ObjectBehavior;
use Rb\Specification\CompositeSpecification;
use Rb\Specification\Not;
use Rb\Specification\SpecificationInterface;

class NotSpec extends ObjectBehavior
{
    public function it_should_have_correct_types(SpecificationInterface $specification)
    {
        $this->beConstructedWith($specification);

        $this->shouldHaveType(Not::class);
        $this->shouldHaveType(SpecificationInterface::class);
        $this->shouldHaveType(CompositeSpecification::class);
    }

    public function it_should_satisfy_if_child_does_not_satisfy(SpecificationInterface $specification)
    {
        $className = 'foo';
        $this->beConstructedWith($specification);

        $specification->isSatisfiedBy($className)->willReturn(false);

        $this->isSatisfiedBy($className)->shouldReturn(true);
    }
}
