<?php

namespace App\Models;

use App\Models\Attributes\EnabledAttribute;
use App\Models\Attributes\IdAttribute;
use App\Models\Attributes\NameAttribute;
use App\Models\Attributes\UpdateDataAttributes;
use App\Models\Interfaces\IQuestionModel;
use Database\Factories\QuestionFactory;
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
class Question extends ModelBase implements IQuestionModel
{
    use EnabledAttribute;
    use HasFactory;
    use IdAttribute;
    use NameAttribute;
    use SoftDeletes;
    use UpdateDataAttributes;

    public $hidden = ['deleted_at'];

}
