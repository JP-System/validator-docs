<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithFormat;

class CPForCNPJ implements Rule
{
    use WithFormat;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return (new CPF)->format($this->format)->passes($attribute, $value) || (new CNPJ)->format($this->format)->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('cpf_or_cnpj');
    }
}
