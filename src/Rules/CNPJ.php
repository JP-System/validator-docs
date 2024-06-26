<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use ValidatorDocs\Formats\CNPJ as FormatsCNPJ;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithParameters;

class CNPJ implements Rule
{
    use WithParameters;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        if (! $this->hasFormat()) {
            return $this->checkCNPJ(Str::onlyNumbers($value));
        }

        return (new FormatsCNPJ)->formatted($value) && $this->checkCNPJ(Str::onlyNumbers($value));
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('cnpj');
    }

    /**
     * Determine if the CNPJ is valid.
     */
    private function checkCNPJ(mixed $c): bool
    {
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        if (strlen($c) != 14) {
            return false;
        } elseif (preg_match("/^{$c[0]}{14}$/", $c) > 0) {
            return false;
        }

        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}
