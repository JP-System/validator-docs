<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithParameters;

class Money implements Rule
{
    use WithParameters;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        return $this->checkMoney($value);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('money');
    }

    /**
     * Determine if the money is valid.
     */
    private function checkMoney(mixed $value): bool
    {
        $params = $this->money();

        $money = $this->getCurrency($value);

        $money = Number::currency($money, $params['currency'], $params['locale']);

        return Str::of($money)->contains($value);
    }

    /**
     * Get the currency value.
     */
    private function getCurrency(mixed $value): float
    {
        return (int) Str::money($value) / 100;
    }

    /**
     * Get the money parameters.
     */
    private function money(): array
    {
        return [
            'locale' => data_get($this->parameters, '1', 'pt_BR'),
            'currency' => data_get($this->parameters, '0', 'BRL'),
        ];
    }
}
