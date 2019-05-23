<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @property integer $id
 * @property string $name
 *
 * @property-read \Carbon\Carbon $created_at
 * @property-read \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|static whereName(string $name)
 * @method static \Illuminate\Database\Eloquent\Builder|static search(string $search)
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Book extends Model
{
    protected $fillable = [
        'name',
    ];

    public function scopeSearch(\Illuminate\Database\Eloquent\Builder $query, string $search)
    {
        return $query->where(function(\Illuminate\Database\Eloquent\Builder $query) use ($search) {
            $query->orWhere('name', 'LIKE', '%'.$search.'%');

            return $query;
        });
    }
}
