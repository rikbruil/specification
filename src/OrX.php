<?php

namespace Rb\Specification;

/**
 */
class OrX extends AndX
{
    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy($value)
    {
        return $this->x->isSatisfiedBy($value) || $this->y->isSatisfiedBy($value);
    }
}
