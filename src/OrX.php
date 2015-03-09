<?php

namespace Rb\Specification;

/**
 */
class OrX extends CompositeSpecification
{
    /**
     * @var SpecificationInterface
     */
    protected $x;

    /**
     * @var SpecificationInterface
     */
    protected $y;

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
    public function isSatisfiedBy($value)
    {
        return $this->x->isSatisfiedBy($value) || $this->y->isSatisfiedBy($value);
    }
}
