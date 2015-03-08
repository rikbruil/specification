<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
interface CompositeSpecificationInterface extends SpecificationInterface
{
    /**
     * @param  SpecificationInterface $specification
     * @return AndX
     */
    public function andX(SpecificationInterface $specification);

    /**
     * @param  SpecificationInterface $specification
     * @return OrX
     */
    public function orX(SpecificationInterface $specification);

    /**
     * @param  SpecificationInterface $specification
     * @return Not
     */
    public function not(SpecificationInterface $specification);
}
