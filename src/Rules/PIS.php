<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use ValidatorDocs\Formats\PIS as FormatsPIS;
use ValidatorDocs\Support\Helpers;
use ValidatorDocs\Traits\WithFormat;

class PIS implements Rule
{
    use WithFormat;

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        if ($this->format === false) {
            return $this->checkPIS(Str::onlyNumbers($value));
        }

        return (new FormatsPIS)->formatted($value) && $this->checkPIS(Str::onlyNumbers($value));
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('pis');
    }

    /**
     * Determine if the PIS is valid.
     */
    private function checkPIS(mixed $p): bool
    {
        if (mb_strlen($p) != 11 || preg_match('/^'.$p[0].'{11}$/', $p)) {
            return false;
        }

        $multipliers = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $sum = 0;

        for ($position = 0; $position < 10; $position++) {
            $sum += (int) $p[$position] * $multipliers[$position];
        }

        $mod = $sum % 11;

        return (int) $p[10] === ($mod < 2 ? 0 : 11 - $mod);
    }
}
