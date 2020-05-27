@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Topic</th>
                    <th scope="col">Channel</th>
                    <th scope="col">Author</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($discussions as $discussion)
                        <tr>
                            <td class="text-primary" style="width:260px;">
                                <a href="{{ route('discussions.show', $discussion->slug)}}">
                                    <strong>{{$discussion->title}}</strong>
                                </a>
                                {!! Str::limit($discussion->content, 43) !!}
                            </td>
                            <td>
                                <a href="">
                                    {{$discussion->channel->name}}
                                </a>                                
                            </td>
                            <td>
                                <div class="d-flex">
                                    <img src="{{ Gravatar::src($discussion->author->email)}}" alt="" width="25" height="25" class="rounded-circle">
                                    <span class="ml-2"><strong>{{$discussion->author->name}}</strong></span>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>                
            </table>
        </div>
    </div>
    {{$discussions->appends(['channel' => request()->query('channel')])->links()}}
@endsection
