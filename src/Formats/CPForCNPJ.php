<?php

namespace ValidatorDocs\Formats;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Helpers;

class CPForCNPJ implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return (new CPF)->passes($attribute, $value) || (new CNPJ)->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('format_cpf_or_cnpj');
    }
}
