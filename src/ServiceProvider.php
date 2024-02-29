<?php

namespace ValidatorDocs;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use ValidatorDocs\Rules as Rules;
use ValidatorDocs\Support\Macros;

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
        Macros::register();

        $rules = $this->getRules();

        $rules->each(function ($class, $name) {
            $rule = new $class;

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['validator']->extend($name, $extension, $rule->message());
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
            'cpf' => Rules\CPF::class,
            'cnpj' => Rules\CNPJ::class,
        ]);
    }
}
