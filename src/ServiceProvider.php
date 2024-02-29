<?php

namespace ValidatorDocs;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Support\Str;
use ValidatorDocs\Formats as Formats;
use ValidatorDocs\Rules as Rules;

/**
 * This pack was inspired by these packs:
 *
 * @see https://github.com/geekcom/validator-docs
 * @see https://github.com/LaravelLegends/pt-br-validator
 */
class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerTranslations();
    }

    /**
     * Bootstrap the application events.
     */
    public function boot(): void
    {
        $rules = $this->getRules();

        $rules->each(function ($class, $name) {
            $rule = new $class;

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['validator']->extend($name, $extension, $rule->message());
        });

        Str::macro('onlyNumbers', function (mixed $value): mixed {
            return preg_replace('/[^0-9]/', '', $value);
        });
    }

    /**
     * Get the file path in the src directory.
     */
    private function srcDir(string $path): string
    {
        return __DIR__."/{$path}";
    }

    /**
     * Register the package translations.
     */
    private function registerTranslations(): void
    {
        $this->loadTranslationsFrom($this->srcDir('lang'), 'docs');

        $this->publishes([$this->srcDir('lang') => $this->app->langPath()], 'docs');
    }

    /**
     * Get the Rules.
     */
    private function getRules(): Collection
    {
        return collect([
            // Rules
            'uf' => Rules\UF::class,
            'cnh' => Rules\CNH::class,
            'cns' => Rules\CNS::class,
            'cpf' => Rules\CPF::class,
            'pis' => Rules\PIS::class,
            'cnpj' => Rules\CNPJ::class,
            'cellphone' => Rules\CellPhone::class,
            'telephone' => Rules\TelePhone::class,
            'cpf_or_cnpj' => Rules\CPForCNPJ::class,
            'cellphone_with_ddd' => Rules\CellPhoneWithDDD::class,
            'telephone_with_ddd' => Rules\TelePhoneWithDDD::class,
            'cellphone_with_code' => Rules\CellPhoneWithCode::class,
            'telephone_with_code' => Rules\TelePhoneWithCode::class,
            'cellphone_with_code_no_mask' => Rules\CellPhoneWithCodeNoMask::class,
            // Formats
            'format_cep' => Formats\CEP::class,
            'format_cpf' => Formats\CPF::class,
            'format_pis' => Formats\PIS::class,
            'format_cnpj' => Formats\CNPJ::class,
            'format_cpf_or_cnpj' => Formats\CPForCNPJ::class,
            'format_vehicle_plate' => Formats\VehiclePlate::class,
        ]);
    }
}
