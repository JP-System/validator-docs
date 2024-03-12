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
     * Set the format in the instance.
     */
    public function parameters(array $parameters = []): static
    {
        $this->parameters = $parameters;

        return $this;
    }
}
