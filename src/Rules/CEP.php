<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Support\Helpers;

class CEP implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\d{2}\.?\d{3}-\d{3}$/', $value) > 0;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('format_cep');
    }
}
