@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>write to:</b> {{$user->name}} - {{$user->email}}
                    </div>

                    <div class="card-body">
                        @if(count($messages) > 0)
                            <ul class="list-group" id="listGroup">
                                @foreach($messages as $msg)

                                    @if($msg->from == $currentUser->id)
                                        <li class="list-group-item" style="display:flex; justify-content: flex-end">
                                            <div style="width: 80%">
                                                <h4>Me</h4>
                                                <p>{{$msg->msg}}</p>
                                                <span>{{$msg->created_at}}</span>
                                            </div>
                                        </li>
                                    @else
                                        <li class="list-group-item" style="display:flex; justify-content: flex-start">
                                            <div style="width: 80%">
                                                <h4>{{$user->name}}</h4>
                                                <p>{{$msg->msg}}</p>
                                                <span>{{$msg->created_at}}</span>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                            <form action="{{route('home.store')}}" method="POST">
                                @csrf
                                <input style="display: none;" type="text" value="{{$currentUser->id}}" name="from">
                                <input style="display: none;" type="text" value="{{$user->id}}" name="to">
                                <div class="form-group">
                                    <label for="textMsg">Text Message</label>
                                    <input type="text" name="msg" class="form-control" id="textMsg" aria-describedby="msgText">
                                    <small id="msgText" class="form-text text-muted">Write your message</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('home-show-script', [$currentUser, $user])
