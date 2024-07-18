<?php

namespace App\Api\Model\Attributes;

use App\Api\Model\ModelBase;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder|ModelBase whereId(int $value)
 * @method mixed getAttribute
 * @method mixed setAttribute
 */
trait IdAttribute
{
    public function getId(): ?int {
        return $this->getAttribute('id') ?? null;
    }

    public function setId(?int $id): static {
        $this->setAttribute('id', $id);
        return $this;
    }

}
