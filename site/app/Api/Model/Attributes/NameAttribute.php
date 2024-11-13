<?php

namespace App\Api\Model\Attributes;

use App\Api\Model\ModelBase;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder|ModelBase whereName(string $value)
 * @method mixed getAttribute
 * @method mixed setAttribute
 */
trait NameAttribute
{
    public function getName(): ?string
    {
        return $this->getAttribute('name') ?? null;
    }

    public function setName(string $name): static
    {
        $this->setAttribute('name', $name);

        return $this;
    }
}
