<?php

namespace App\Api\Model\Attributes;

use App\Api\Model\ModelBase;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder|ModelBase whereIsEnabled(bool $value)
 * @method mixed getAttribute
 * @method mixed setAttribute
 */
trait EnabledAttribute
{
    public function getIsEnabled(): bool{
        return (bool) $this->getAttribute('is_enabled');
    }

    public function setIsEnabled(bool $value): static{
        $this->setAttribute('is_enabled', $value);
        return $this;
    }
}
