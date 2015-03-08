<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
abstract class CompositeSpecification implements CompositeSpecificationInterface
{
    /**
     * {@inheritDoc}
     */
    public function andX(SpecificationInterface $specification)
    {
        return new AndX($this, $specification);
    }

    /**
     * {@inheritDoc}
     */
    public function orX(SpecificationInterface $specification)
    {
        return new OrX($this, $specification);
    }

    /**
     * {@inheritDoc}
     */
    public function not(SpecificationInterface $specification)
    {
        return new Not($specification);
    }
}
