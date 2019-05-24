<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transfer
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $user_id
 *
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Transfer extends Model
{
    protected $fillable = [
        'name',
        'book_id',
        'user_id',
    ];
}
