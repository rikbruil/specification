<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
abstract class CompositeSpecification implements SpecificationInterface
{
    /**
     * @param  SpecificationInterface $specification
     * @return AndX
     */
    public function andX(SpecificationInterface $specification)
    {
        return new AndX($this, $specification);
    }

    /**
     * @param  SpecificationInterface $specification
     * @return OrX
     */
    public function orX(SpecificationInterface $specification)
    {
        return new OrX($this, $specification);
    }

    /**
     * @param  SpecificationInterface $specification
     * @return Not
     */
    public function not(SpecificationInterface $specification)
    {
        return new Not($specification);
    }
}
