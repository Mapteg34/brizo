<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
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

    public static function getStat(string $groupByPeriod, Carbon $from, Carbon $to)
    {
        $groups  = ['book_id'];
        $columns = ['book_id', 'COUNT(id) AS count'];
        switch ($groupByPeriod) {
            case 'month':
                $connection = config('database.default');
                $driver     = config("database.connections.{$connection}.driver");
                $columns[]  = $driver === 'sqlite' ? 'strftime(\'%y-%m\', `created_at`) AS month' : 'DATE_FORMAT(`created_at`,\'%Y-%m\') AS month';
                $groups[]   = 'month';
                break;
            case 'year':
                $connection = config('database.default');
                $driver     = config("database.connections.{$connection}.driver");
                $columns[]  = $driver === 'sqlite' ? 'strftime(\'%y\', `created_at`) AS year' : 'YEAR(created_at) AS year';
                $groups[]   = 'year';
                break;
        }

        return DB::table(with(new static)->getTable())
                 ->selectRaw(implode(',', $columns))
                 ->whereBetween('created_at', [$from, $to])
                 ->groupBy($groups)
                 ->get();
    }
}
