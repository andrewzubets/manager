<?php

namespace App\Models;

use App\Api\Model\Attributes\EnabledAttribute;
use App\Api\Model\Attributes\IdAttribute;
use App\Api\Model\Attributes\NameAttribute;
use App\Api\Model\ModelBase;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Model class for questions.
 *
 * @property int $id
 * @property int $is_enabled
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static QuestionFactory factory($count = null, $state = [])
 * @method static Question|null find(int $id)
 * @method static Question first()
 * @method static Question findOrFail(int $id)
 */
class Question extends ModelBase
{
    use EnabledAttribute;
    use HasFactory;
    use IdAttribute;
    use NameAttribute;
    use SoftDeletes;

    public $hidden = ['deleted_at'];

    /**
     * Filters query by parameters.
     *
     * @param  array  $params
     *                         Array of key value pairs. Possible options: name, trashed, sortOrder.
     */
    public static function filter(array $params): Builder
    {
        $query = static::query();
        $name = $params['name'] ?? '';
        $withTrashed = $params['trashed'] ?? false;
        $query->orderBy('updated_at', $params['sortOrder'] ?? 'asc');
        if (! empty($name)) {
            $query->where('name', 'like', '%'.$name.'%');
        }
        if ($withTrashed) {
            $query->withTrashed();
        }

        return $query;
    }
}
