<?php

namespace ValidatorDocs\Contracts;

interface Formatted
{
    /**
     * Check if the value is formatted.
     */
    public function formatted(string $value): bool;
}
