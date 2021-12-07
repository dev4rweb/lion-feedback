@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        @if($currentUser->is_admin)
                            @if(count($users) > 0)
                                <div class="list-group">
                                    @foreach($users as $user)
                                        @if($user->id != $currentUser->id)
                                            <a href="/home/{{$user->id}}" class="list-group-item list-group-item-action">
                                                {{$user->email}}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @else
                                <div class="list-group">
                                    <a href="/home/{{$users->id}}" class="list-group-item list-group-item-action active"
                                       aria-current="true">
                                        {{$users->email}}
                                    </a>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
