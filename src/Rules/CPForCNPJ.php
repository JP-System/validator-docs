<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithParameters;

class CPForCNPJ implements Rule
{
    use WithParameters;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return (new CPF)->parameters($this->parameters)->passes($attribute, $value)
            || (new CNPJ)->parameters($this->parameters)->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('cpf_or_cnpj');
    }
}
