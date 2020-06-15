@extends('layouts.application')
@section('title')Update Member @endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-3">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <span>Update Member</span>
                    </div>
                    <div class="col-lg-5 d-flex justify-content-end">
                        <a href="{{url('/members')}}" class="fa fa-file mt-1 text-decoration-none">
                            All Members
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{url('/members/update')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label for="fname">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" maxlength="20" class="form-control" placeholder="Enter First Name" value="{{$member->first_name}}" required="required">
                                    <span class="text-center text-danger">{{$errors->has('first_name') ? $errors->first('first_name') : ''}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="lname">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" maxlength="20" class="form-control"  placeholder="Enter Last Name" required="required" value="{{$member->last_name}}">
                                    <span class="text-center text-danger">{{$errors->has('last_name') ? $errors->first('last_name') : ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <label for="eAddress">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="gmail_address" maxlength="80" class="form-control" placeholder="Enter Email Address" required="required" value="{{$member->gmail_address}}">
                                    <span class="text-center text-danger">{{$errors->has('gmail_address') ? $errors->first('gmail_address') : ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label for="phone">Role <span class="text-danger">*</span></label>
                                    <input type="tel" name="role" maxlength="20" class="form-control" placeholder="Enter Role" required="required" value="{{$member->role}}">
                                    <span class="text-center text-danger">{{$errors->has('role') ? $errors->first('role') : ''}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="phone">Location <span class="text-danger">*</span></label>
                                    <input type="text" name="location" class="form-control" maxlength="80" placeholder="Enter Location" value="{{$member->location}}">
                                    <span class="text-center text-danger">{{$errors->has('location') ? $errors->first('location') : ''}}</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-1">Update Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
