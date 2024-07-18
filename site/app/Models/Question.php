<?php

namespace App\Models;

use App\Api\Model\Attributes\EnabledAttribute;
use App\Api\Model\Attributes\IdAttribute;
use App\Api\Model\Attributes\NameAttribute;
use App\Api\Model\ModelBase;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 *
 * @property int $id
 * @property int $is_enabled
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static QuestionFactory factory($count = null, $state = [])
 * @method static Question|null find(int $id)
 * @method static Question findOrFail(int $id)
 */
class Question extends ModelBase
{
    use HasFactory;
    use IdAttribute, EnabledAttribute, NameAttribute;
}
