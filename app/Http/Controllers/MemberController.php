<?php

namespace App\Http\Controllers;

use App\Models\MembersModel;
use Illuminate\Contracts\Redis\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

/**
 * Class MemberController
 * @package App\Http\Controllers
 */
class MemberController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        /**
         * Just Enable the database query log to see query log in text
         * And find the query is from db or cache
         */
       /* $cachedData  = Redis::get('get_all_members');
        if(empty($cachedData)){
            DB::connection()->enableQueryLog();
            $members = MembersModel::getAll();
            $log = DB::getQueryLog();
            print_r($log);

            Redis::set('get_all_members', $members);
        }*/

        //dd($cachedData);

        /*return view('members.list', [
            'members' => json_decode($cachedData),
        ]);*/

        //Cache::forget('get_members_cache');

        DB::connection()->enableQueryLog();
        $members = MembersModel::getAll();
        $log = DB::getQueryLog();
        //print_r($log);

        return view('members.list', [
            'members' => $members,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        /**
         * Create new member form view
         * Create a new member through this form
         */
        return view('members.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->addMemberValidation($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->messages());
        }

        $memberModel = New MembersModel();
        $createMember = $memberModel->addMember($request);

        if ($createMember === true) {
            Session::flash('success', 'Member has added successfully !');
            return redirect('/members');
        }

        Session::flash('error', 'Member add process is failed !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //Cache::forget('get_member_details');
        /**
         * Update member form view
         * Update member through this details
         */
        DB::connection()->enableQueryLog();
        $memberDetails = MembersModel::getDetails($id);
        $log = DB::getQueryLog();
        //print_r($log);

        return view('members.update', [
            'member' => $memberDetails,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function addMemberValidation(array $data){
        $rules = [
            'first_name'  => 'required',
            'last_name'  => 'required',
            'gmail_address' => 'required|email|unique:members,gmail_address',
            'role'  => 'required|max:20',
            'location'  => 'required|max:80',
        ];

        $messages = [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'gmail_address.required' => 'Gmail Address is required',
            'role.required' => 'Role is required',
            'location.required' => 'Location is required.',
        ];

        return validator($data, $rules, $messages);
    }
}
