<?php

namespace ValidatorDocs\Support;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use ValidatorDocs\Rules as Rules;

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

        /**
         * Rules
         */
        Rule::macro('uf', function () {
            return new Rules\UF();
        });

        Rule::macro('cep', function () {
            return new Rules\CEP();
        });

        Rule::macro('cnh', function () {
            return new Rules\CNH();
        });

        Rule::macro('cns', function () {
            return new Rules\CNS();
        });

        Rule::macro('cpf', function () {
            return new Rules\CPF();
        });

        Rule::macro('pis', function () {
            return new Rules\PIS();
        });

        Rule::macro('cnpj', function () {
            return new Rules\CNPJ();
        });

        Rule::macro('cellphone', function () {
            return new Rules\CellPhone();
        });

        Rule::macro('telephone', function () {
            return new Rules\TelePhone();
        });

        Rule::macro('cpf_or_cnpj', function () {
            return new Rules\CPForCNPJ();
        });

        Rule::macro('vehicle_plate', function () {
            return new Rules\VehiclePlate();
        });

        Rule::macro('cellphone_with_ddd', function () {
            return new Rules\CellPhoneWithDDD();
        });

        Rule::macro('telephone_with_ddd', function () {
            return new Rules\TelePhoneWithDDD();
        });

        Rule::macro('cellphone_with_code', function () {
            return new Rules\CellPhoneWithCode();
        });

        Rule::macro('telephone_with_code', function () {
            return new Rules\TelePhoneWithCode();
        });

        Rule::macro('cellphone_with_code_no_mask', function () {
            return new Rules\CellPhoneWithCodeNoMask();
        });
    }
}
