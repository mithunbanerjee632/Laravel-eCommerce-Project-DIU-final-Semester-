@extends('Frontend.Pages.users.app')
@section('title','About')
@section('sub-content')


    <div class="container mt-3 text-center">
        <h2>Welcome {{$user->first_name.'  '.$user->last_name}}</h2>
        <p>You Can Update Your Profile Here</p>


    <hr/>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-body mt-2" onclick="location.href='{{route('users.profile')}}'">
                <a href="{{route('users.profile')}}">Update Profile</a>
            </div>
        </div>
    </div>
    </div>


@endsection

