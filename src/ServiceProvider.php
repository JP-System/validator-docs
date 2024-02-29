<?php

namespace ValidatorDocs;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

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

        dd($rules->toArray());
    }

    /**
     * Register the package translations.
     */
    private function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/lang', 'validator-docs');

        $this->publishes([__DIR__.'/lang' => $this->app->langPath('vendor/validator-docs')], 'validator-docs.lang');
    }

    /**
     * Get the Rules.
     */
    private function getRules(): Collection
    {
        return collect([
            //
        ]);
    }
}
