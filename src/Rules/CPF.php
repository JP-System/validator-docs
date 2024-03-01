<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use ValidatorDocs\Formats\CPF as FormatsCPF;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithFormat;

class CPF implements Rule
{
    use WithFormat;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        if ($this->format === false) {
            return $this->checkCPF(Str::onlyNumbers($value));
        }

        return (new FormatsCPF)->formatted($value) && $this->checkCPF(Str::onlyNumbers($value));
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('cpf');
    }

    /**
     * Determine if the CPF is valid.
     */
    private function checkCPF(mixed $c): bool
    {
        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}
