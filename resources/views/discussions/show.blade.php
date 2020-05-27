@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">            
            <div class="mb-4">
                <h3 class="mb-2">
                    {{$discussion->title}}
                </h3>
                <hr>
                <div class="d-flex">
                    <img src="{{ Gravatar::src($discussion->author->email)}}" alt="" width="25" height="25" class="rounded-circle">
                    <span class="ml-2 mr-2"><strong>{{$discussion->author->name}}</strong></span> 
                    <strong>
                        <a href="">
                            {{$discussion->channel->name}}
                        </a>                    
                    </strong>
                </div>
            </div>           
            
            {!! $discussion->content !!}
            
            @if ($discussion->bestReply)
                <div class="card mt-3 mb-3 bg-success text-white">
                    <div class="card-header">
                        
                        <div class="d-flex justify-content-between">
                            <div>
                                <img src="{{ Gravatar::src($discussion->bestReply->owner->email)}}" alt="{{$discussion->bestReply->owner->email}}" class="rounded-circle" width="30" height="30">
                                <strong>{{$discussion->bestReply->owner->name}}</strong>
                            </div>
                            <div>
                                <strong>Best Reply</strong> 
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        {!!$discussion->bestReply->content!!}                
                    </div>
                </div>        
            @endif
        </div>
    </div>

    <h4 class="mt-4">Replies</h4>
    <hr>
    @foreach ($discussion->replies()->paginate(3) as $reply)
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{ Gravatar::src($reply->owner->email)}}" alt="{{$reply->owner->email}}" class="rounded-circle" width="30" height="30">
                        <strong>{{$reply->owner->name}}</strong>
                    </div>
                    <div>
                        @auth
                            @if(auth()->user()->id === $discussion->user_id)
                                <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">Mark as Best Reply</button> 
                                </form>                           
                            @endif   
                        @endauth
                                                                
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!!$reply->content!!}                
            </div>
        </div>        
    @endforeach
    {{$discussion->replies()->paginate(3)->links()}}

    <div class="card mt-4">
        <div class="card-header">
            Add a Reply
        </div>
        <div class="card-body">
            @auth
                <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="reply" type="hidden" value="" name="reply">
                        <trix-editor input="reply"></trix-editor>
                    </div>
                    <button class="btn btn-sm btn-success" type="submit">Reply</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-success btn-sm">Please sign in to add a reply.</a>
            @endauth
        </div>
    </div>
@endsection
