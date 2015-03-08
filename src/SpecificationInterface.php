<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
interface SpecificationInterface
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

    /**
     * Returns a boolean indicating whether or not this specification can support the given class
     * @param  mixed $value
     * @return bool
     */
    public function isSatisfiedBy($value);
}
