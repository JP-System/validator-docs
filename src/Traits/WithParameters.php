<?php

namespace ValidatorDocs\Traits;

trait WithParameters
{
    /**
     * The parameters in the instance.
     */
    protected array $parameters = [];

    /**
     * Check if the parameters has the format.
     */
    protected function hasFormat(): bool
    {
        return in_array('format', $this->parameters, true);
    }

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
