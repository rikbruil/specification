<?php

namespace spec\Rb\Specification;

use PhpSpec\ObjectBehavior;
use Rb\Specification\SpecificationInterface;

class AndXSpec extends ObjectBehavior
{
    public function it_should_fail_if_one_child_fails(SpecificationInterface $specificationA, SpecificationInterface $specificationB)
    {
        $className = 'foo';
        $this->beConstructedWith($specificationA, $specificationB);

        $specificationA->isSatisfiedBy($className)->willReturn(false);
        $specificationB->isSatisfiedBy($className)->willReturn(true);

        $this->isSatisfiedBy($className)->shouldReturn(false);
    }

    public function it_should_pass_if_both_children_pass(SpecificationInterface $specificationA, SpecificationInterface $specificationB)
    {
        $className = 'foo';
        $this->beConstructedWith($specificationA, $specificationB);

        $specificationA->isSatisfiedBy($className)->willReturn(true);
        $specificationB->isSatisfiedBy($className)->willReturn(true);

        $this->isSatisfiedBy($className)->shouldReturn(true);
    }

    public function it_should_fail_if_both_children_fail(SpecificationInterface $specificationA, SpecificationInterface $specificationB)
    {
        $className = 'foo';
        $this->beConstructedWith($specificationA, $specificationB);

        $specificationA->isSatisfiedBy($className)->willReturn(false);
        $specificationB->isSatisfiedBy($className)->willReturn(false);

        $this->isSatisfiedBy($className)->shouldReturn(false);
    }
}
