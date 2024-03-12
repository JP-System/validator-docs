<?php

namespace ValidatorDocs\Traits;

trait WithParameters
{
    /**
     * The parameters in the instance.
     */
    protected array $parameters = [];

    /**
     * Set the format in the parameters.
     */
    public function format(bool $format = true): static
    {
        $this->parameters = collect($this->parameters)->when($format, fn ($c) => $c->push('format'))->toArray();

        return $this;
    }

    /**
     * Set the parameters in the instance.
     */
    public function parameters(array $parameters = []): static
    {
        $this->parameters = $parameters;

        return $this;
    }
}
