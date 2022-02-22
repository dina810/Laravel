@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5>Title</h5>
            <p>{{ $post->title }}</p>
            <h5>Description</h5>
            <p>{{ $post->description }}</p>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5>Name</h5>
            <p>{{$post->user ? $post->user->name : 'Not Found'}}</p>
            <h5>Email</h5>
            <p>{{$post->user ? $post->user->email : 'Not Found'}}</p>
            <h5>Created at</h5>
            <p>{{ $date }}</p>
        </div>
    </div>
</div>
@endsection