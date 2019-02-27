@extends('layouts.app')
@section('title')
    Home Page
@stop
@section('content')
    <!--main section-->
        <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Welcome Back, {{ Auth::user()->name}}<h2></div>

                <div class="panel-body">
                    Your all activites goes here !! 
                   <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                  </form>
                  <div class="row">
                      <a href="{{ action('User\UserController@showprofile') }}">Update Profile</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
    
@stop
