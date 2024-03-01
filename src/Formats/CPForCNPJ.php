<?php

namespace ValidatorDocs\Formats;

use ValidatorDocs\Contracts\Formatted;

class CPForCNPJ implements Formatted
{
    /**
     * Check if the value is formatted.
     */
    public function formatted(string $value): bool
    {
        return (new CPF)->formatted($value) || (new CNPJ)->formatted($value);
    }
}
