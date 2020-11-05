@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You Are Logged In!!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="font-weight-bold">Dashboard</div>
                    <hr>

                    <div class="row">
                        <div class="card col-md-12">
                            <h3 class="font-weight-bold">Your Blog Posts</h3>
                            @if(count($posts) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Blogs</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{-- Hidden spothing method, and submit --}}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @else
                                <p>You have not Create a Post Yet!</p>
                            @endif
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        </div>
                        {{-- end blogs --}}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
