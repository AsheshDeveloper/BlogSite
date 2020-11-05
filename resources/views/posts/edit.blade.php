@extends('layouts.app')

@section('content')
    <h1>Edit The Blog</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}

    {{-- Form using Laravel Collective --}}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{-- Blank for the value --}}
        {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder' => 'Add a Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Content')}}
        {{-- Blank for the value --}}
        {{Form::textarea('body', $post->body, ['id'=>'article-ckeditor', 'class'=>'form-control', 'placeholder' => 'Add Contents'])}}
    </div>
    <div class="form-group">
        {{-- Whenever we set a upload file, we need to set enctype attribute, and set it to multipart/form-data. Always follow this rule--}}
        {{-- Two things which should happen after we save the form:
            1.we need to save the name of the image in database to access and display
            2.save the image in database so the app can know the image location --}}
        {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
