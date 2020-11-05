@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-success">Go Back</a>
    <h1>{{$post->title}}</h1>
    {{-- the app will look at public folder to view the image --}}
    <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}" />
    <br><br>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
        <small>Written on: {{$post->created_at}} by {{$post->user->name}} </small>
    <hr>

    @if(!Auth::guest()) <!-- We cannot allow guests to view the blog posts-->
        @if(Auth::user()->id == $post->user_id) <!-- we cannot allow random users to manipulate one-another's posts-->
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'btn pull-right'])!!}
                {{-- Hidden spothing method, and submit --}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}
        @endif
    @endif
@endsection
