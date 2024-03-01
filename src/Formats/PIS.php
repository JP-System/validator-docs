<?php

namespace ValidatorDocs\Formats;

use ValidatorDocs\Contracts\Formatted;

class PIS implements Formatted
{
    /**
     * Check if the value is formatted.
     */
    public function formatted(string $value): bool
    {
        return preg_match('/^\d{3}\.\d{5}\.\d{2}-\d{1}$/', $value) > 0;
    }
}
