@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        <form action="{{ route('discussions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" value="" name="content">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="channel">Channel</label>
                <select name="channel" id="channel" class="form-control custom-select">
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary btn-sm float-right" type="submit">
                Save Discussion
            </button>
        </form>
    </div>
</div>
@endsection
