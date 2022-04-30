@extends('Frontend.Pages.users.app')
@section('title','About')
@section('sub-content')


<div class="container mt-10">
    <div class="row">
    <div class="col-md-6">
<div class="card">
    <div class="card-header text-center"><h3>User Profile</h3></div>
<div class="card-body">
    <form method="POST" name="frm-billing" action="{{ route('users.profile.update') }}" >
        @csrf
        <div class="form-group">
            <label for="first_name" :value="__('First Name')">First Name</label>
            <input id="first_name" class="form-control" type="text" name="first_name" value="{{$user->first_name}}">

        </div>

        <div class="form-group">
            <label for="last_name" :value="__('last Name')">Last Name</label>
            <input id="last_name" class="form-control" type="text" name="last_name" value="{{$user->last_name}}">

        </div>
        <div class="form-group">
            <label for="username" :value="__('Username')">Username</label>
            <input id="username" class="form-control" type="text" name="username" value="{{$user->username}}">
        </div>

        <div class="form-group">
            <label  for="email" :value="__('Email')">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{$user->email}}" >
        </div>

        <div class="form-group">
            <label  for="phone_no" :value="__('Phone Number')">Phone Number</label>
            <input id="phone_no" class="form-control" type="text" name="phone_no" value="{{$user->phone_no}}" required autofocus>
        </div>

     {{--  <div class="form-group">
            <label for="street_address">Street Address</label>
            <textarea class="form-control" id="street_address" rows="3"></textarea>
        </div>

        <div class="form-group mt-2">
            <label for="division_id" >Division</label>
            <select class="form-control" name="division_id">

                <option value="">please select your division</option>
                @foreach($divisions as $division)
                    <option value="{{$division->id}}" {{$user->division_id == $division->id ? 'selected':''}}>{{$division->name}}</option>
                @endforeach

            </select>
        </div>



        <div class="form-group mt-2">
            <label for="district_id" >District</label>
            <select class="form-control" name="district_id">

                <option value="">please select your District</option>
                @foreach($districts as $district)
                    <option value="{{$district->id}}" {{$user->$district == $district->id ? 'selected':''}}>{{$district->name}}</option>
                @endforeach


            </select>
        </div>


        <div class="form-group">
            <label for="zipcode">ZIPcode /Post:</label>
            <input id="zipcode" type="number" class="form-control" name="zipcode" value="" placeholder="Your postal code">
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <input id="country" type="text" class="form-control" name="country" value="" placeholder="Bangladesh">
        </div>--}}

        <div class="form-group row mb-0 text-center">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Update Profile
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>


@endsection


