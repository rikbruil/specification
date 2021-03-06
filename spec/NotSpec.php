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

        $this->shouldHaveType('Rb\Specification\Not');
        $this->shouldHaveType('Rb\Specification\SpecificationInterface');
        $this->shouldHaveType('Rb\Specification\CompositeSpecification');
    }

    public function it_should_pass_if_child_fails(SpecificationInterface $specification)
    {
        $className = 'foo';
        $this->beConstructedWith($specification);

        $specification->isSatisfiedBy($className)->willReturn(false);

        $this->isSatisfiedBy($className)->shouldReturn(true);
    }
}
