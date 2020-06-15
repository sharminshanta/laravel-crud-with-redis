<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
        $result = Cache::remember('get_members_cache', 10, function (){
            return self::get();
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

    /**
     * @param $postData
     * @return bool
     */
    public function updateMember($postData)
    {
        //Cache::forget('get_member_id');
        $getData = Redis::get('get_member_id');

        if(!empty($getData) || $getData !== null){
            DB::connection()->enableQueryLog();
            $member = $this->find($postData->member_id);
            $log = DB::getQueryLog();
            //print_r($log);

            Redis::set('get_member_id', $member->id);

            $memberInfo = $this->find($member->id);
            $memberInfo->first_name = $postData->first_name;
            $memberInfo->last_name = $postData->last_name;
            $memberInfo->gmail_address = $postData->gmail_address;
            $memberInfo->role = $postData->role;
            $memberInfo->location = $postData->location;

            if ($memberInfo->save() === true) {
                Redis::set('get_member_details', $memberInfo);
                return true;
            }

            return false;
        }
    }
}
