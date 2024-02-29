<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Enum\StateEnum;
use ValidatorDocs\Helpers;

class UF implements Rule
{
    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return collect(StateEnum::cases())
            ->map(fn (StateEnum $item) => $item->value)
            ->contains($value);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('uf');
    }
}
