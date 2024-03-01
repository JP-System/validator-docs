<?php

namespace ValidatorDocs\Formats;

use ValidatorDocs\Contracts\Formatted;

class CNPJ implements Formatted
{
    /**
     * Check if the value is formatted.
     */
    public function formatted(string $value): bool
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }
}
