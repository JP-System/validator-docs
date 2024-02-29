<?php

namespace ValidatorDocs\Support;

use Illuminate\Support\Str;

class Macros
{
    /**
     * Register the custom macros.
     */
    public static function register(): void
    {
        Str::macro('onlyNumbers', function (mixed $value): mixed {
            return preg_replace('/[^0-9]/', '', $value);
        });
    }
}
