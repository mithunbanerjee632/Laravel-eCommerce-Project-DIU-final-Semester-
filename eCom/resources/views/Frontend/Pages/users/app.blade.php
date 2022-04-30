@extends('Frontend.Layout.app')
@section('title','About')
@section('content')




    <div class="container mt-3 ">
        <div class="row">
            <div class="col-md-5">
                <div class="list-group">
                    <a href="" class="list-group-item">
                        <img src="{{App\Helpers\ImageHelper::getUserImage( Auth::user()->id )}}" style="width:100px;" class="img rounded-circle">
                    </a>
                    <a href="{{route('users.dashboard')}}" class="list-group-item {{Route::is('users.dashboard')?'active' : ''}}">Dashboard</a>
                    <a href="{{route('users.profile')}}" class="list-group-item {{Route::is('users.profile')?'active' : ''}}">Profile</a>

                   {{-- <a href="{{route('logout')}}" class="list-group-item">Logout</a>--}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf


                            <a class="list-group-item" href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">{{ __('Log Out') }}</a>

                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div clas="card">
                    <div class="card-body">
                        @yield('sub-content')
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


