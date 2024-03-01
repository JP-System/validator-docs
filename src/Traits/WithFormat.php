<?php

namespace ValidatorDocs\Traits;

trait WithFormat
{
    /**
     * Determine if the format is enabled.
     */
    protected bool $format = false;

    /**
     * Set the format in the instance.
     */
    public function format(bool $format = true): static
    {
        $this->format = $format;

        return $this;
    }
}
