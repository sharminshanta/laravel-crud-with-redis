<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/**
 * Class MembersModel
 * @package App\Models
 */
class MembersModel extends Model
{
    /**
     * @var string
     */
    public $table = 'members';

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
        $result = Cache::remember('get_members_cache', 60 * 60 * 24, function (){
            self::get();
        });

        return $result;
    }

    /**
     * @param $postData
     * @return bool
     */
    public function addMember($postData)
    {
        $this->code = "MB". substr(uniqid('', true), -4);;
        $this->first_name = $postData['first_name'];
        $this->last_name = $postData['last_name'];
        $this->gmail_address = $postData['gmail_address'];
        $this->role = $postData['role'];
        $this->location = $postData['location'];

        if ($this->save() === true) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public static function getDetails($id)
    {
        $result = Cache::remember('get_member_details', 10, function () use ($id){
            return self::where('id', $id)->first();
        });

        return $result;
    }
}
