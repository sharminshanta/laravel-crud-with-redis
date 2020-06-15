<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/**
 * Class StudentsModel
 * @package App\Models
 */
class StudentsModel extends Model
{
    /**
     * @var string
     */
    public $table = 'students';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'first_name', 'last_name', 'gmail_address', 'role', 'location'
    ];

    /**
     * StudentsModel constructor.
     */
    public function __construct()
    {
        $this->storage = Redis::connection();
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        $result = Cache::remember('get_students_cache', 60 * 60 * 24, function (){
            return self::get();
        });

        return $result;
    }
}
