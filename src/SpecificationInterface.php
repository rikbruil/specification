<?php

namespace Rb\Specification;

/**
 * @package Rb\Specification
 */
interface SpecificationInterface
{
    /**
     * Returns a boolean indicating whether or not this specification can support the given value
     * @param  mixed $value
     * @return bool
     */
    public function isSatisfiedBy($value);
}
