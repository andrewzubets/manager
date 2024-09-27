<?php

namespace App\Models;

use App\Api\Model\Attributes\EnabledAttribute;
use App\Api\Model\Attributes\IdAttribute;
use App\Api\Model\Attributes\NameAttribute;
use App\Api\Model\ModelBase;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @method static Question first()
 * @method static Question findOrFail(int $id)
 */
class Question extends ModelBase
{
    use HasFactory;
    use IdAttribute, EnabledAttribute, NameAttribute;
    use SoftDeletes;

    public $hidden = ['deleted_at'];

    public static function search(array $filter): Builder
    {
        $query = static::query();
        $name = $filter['name'] ?? '';
        $withTrashed = $filter['trashed'] ?? false;
        if(!empty($name)){
            $query->where('name','like', '%'.$name.'%');
        }
        if($withTrashed){
            $query->withTrashed();
        }
        return $query;
    }
}
