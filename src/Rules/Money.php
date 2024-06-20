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
     * The callback that should be used to validate the locale.
     */
    public static $localeCallback;

    /**
     * The callback that should be used to validate the currency.
     */
    public static $currencyCallback;

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
     * Set callback to get locale to be used in the validation rule.
     */
    public static function setLocaleCallback(callable $callback): void
    {
        static::$localeCallback = $callback;
    }

    /**
     * Set callback to get currency to be used in the validation rule.
     */
    public static function setCurrencyCallback(callable $callback): void
    {
        static::$currencyCallback = $callback;
    }

    /**
     * Determine if the money is valid.
     */
    private function checkMoney(mixed $value): bool
    {
        $money = Str::moneyValue($value);

        $money = Number::currency($money, $this->getCurrency(), $this->getLocale());

        return Str::of($money)->contains($value);
    }

    /**
     * Get the locale from callback or parameters.
     */
    private function getLocale(): mixed
    {
        $default = data_get($this->parameters, '1');

        return with($default, static::$localeCallback);
    }

    /**
     * Get the currency from callback or parameters.
     */
    private function getCurrency(): mixed
    {
        $default = data_get($this->parameters, '0', 'USD');

        return with($default, static::$currencyCallback);
    }
}
