<?php

namespace ValidatorDocs\Formats;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Helpers;

class CPF implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('format_cpf');
    }
}