<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
class OrX extends CompositeSpecification
{
    /**
     * @var SpecificationInterface
     */
    private $x;

    /**
     * @var SpecificationInterface
     */
    private $y;

    /**
     * @param SpecificationInterface $x
     * @param SpecificationInterface $y
     */
    public function __construct(SpecificationInterface $x, SpecificationInterface $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy($className)
    {
        return $this->x->isSatisfiedBy($className) || $this->y->isSatisfiedBy($className);
    }
}
