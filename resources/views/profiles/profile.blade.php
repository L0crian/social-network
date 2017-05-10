@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        {{ $user->name }}'s Profile.
                    </p>
                </div>

                <div class="panel-body">
                    <div class="text-center">
                        <img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius: 50%;" alt="">
                    </div>
                    <br>
                    <p class="text-center">
                        @if(Auth::id() == $user->id)
                            <a href="{{ route('profile.edit') }}" class="btn btn-info">Edit your profile</a>
                        @endif
                    </p>
                    <br>
                    <p class="text-center">

                    </p>
                </div>
            </div>
            @if(Auth::id() !== $user->id)
            <div class="panel panel-default">
                <friend :profile_user_id = "{{$user->id}}"></friend>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        About me .
                    </p>
                </div>
                <div class="panel-body">
                    <p class="text-center">

                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
