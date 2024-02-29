<?php

namespace ValidatorDocs\Rules;

use Illuminate\Contracts\Validation\Rule;
use ValidatorDocs\Support\Helpers;

class CNS implements Rule
{
    public function passes($attribute, $cns)
    {
        if (! isset($cns[0])) {
            return false;
        }

        $digit = (int) $cns[0];

        if (strlen($cns) != 15 || preg_match("/^{$digit}{15}$/", $cns) > 0) {
            return false;
        }

        return $digit >= 7 ? $this->cnsProv($cns) : $this->cns($cns);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return Helpers::getMessage('cns');
    }

    /**
     * Validate CNS that starts with 1, 2, 3, 4, 5 or 6
     */
    protected function cns(string $cns): bool
    {
        $pis = substr($cns, 0, 11);

        for ($sum = 0, $i = 0, $j = 15; $i <= 10; $i++, $j--) {
            $sum += intval($pis[$i]) * $j;
        }

        $dv = 11 - ($sum % 11);

        $dv != 11 ?: $dv = 0;

        if ($dv === 10) {
            for ($sum = 2, $i = 1, $j = 15; $i <= 10; $i++, $j--) {
                $sum += intval(substr($pis, $i - 1, $i)) * $j;
            }

            $dv = 11 - ($sum % 11);

            $dv != 11 ?: $dv = 0;

            $result = $pis.'001'.(string) $dv;

        } else {
            $result = $pis.'000'.(string) $dv;
        }

        return $cns === $result;
    }

    /**
     * Validate CNS that starts with 7, 8, 9
     */
    protected function cnsProv(string $cns): bool
    {
        if (strlen($cns) != 15) {
            return false;
        }

        for ($s = 0, $i = 0, $j = 15; $i < 15; $i++, $j--) {
            $s += intval($cns[$i]) * $j;
        }

        return $s % 11 === 0;
    }
}
