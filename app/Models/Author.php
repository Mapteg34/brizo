<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 *
 * @property integer $id
 * @property string $name
 *
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|static whereName(string $name)
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Author extends Model
{
    protected $fillable = [
        'name',
    ];
}
