@extends('layouts.application')
@section('title')Member List @endsection
@section('content')
    <div class="card-header py-3">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <span>All Members</span>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{url('/members/add')}}" class="fa fa-plus mt-1 text-decoration-none">
                    Add New
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(sizeof($members) != 0)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gmail Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($members as $member)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><a href="#" class="text-decoration-none">{{ucfirst(trans($member->first_name))}} {{ucfirst(trans($member->last_name))}}</a></td>
                        <td>{{$member->gmail_address}}</td>
                        <td>{{ucfirst(trans($member->role))}}</td>
                        <td>{{ucfirst(trans($member->location))}}</td>
                        <td>
                            <a href="{{url('/members/edit', $member->id)}}" title="Update this ?" class="text-info"><i class="fa fa-edit"></i></a>
                            <a href="#" title="Delete this ?" class="text-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center">
                <span class="text-danger font-weight-bold">
                    No Data Found !
                </span>
            </div>
        @endif
    </div>
@endsection
