<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
class Not extends CompositeSpecification
{
    /**
     * @var SpecificationInterface
     */
    protected $wrapped;

    /**
     * @param SpecificationInterface $x
     */
    public function __construct(SpecificationInterface $x)
    {
        $this->wrapped = $x;
    }

    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy($value)
    {
        return !$this->wrapped->isSatisfiedBy($value);
    }
}
