<?php

namespace ValidatorDocs\Formats;

use ValidatorDocs\Contracts\Formatted;

class CPF implements Formatted
{
    /**
     * Check if the value is formatted.
     */
    public function formatted(string $value): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }
}
