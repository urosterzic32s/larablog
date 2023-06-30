@extends('layouts.app')

@include('partials.meta_static')

@section('content')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Manage Blogs</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Published</h3>
            <hr>
            @foreach ($publishedBlogs as $blog)
            <h2><a href="{{ route('blogs.show', [$blog->id]) }}">{{ $blog->title }}</a></h2>
            {!! Str::limit($blog->body, 100, '...') !!}
            <form action="{{ route('blogs.update', ['id' => $blog->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="status" value="0" style="display:none;" checked>
                <button type="submit" class="btn btn-warning btn-xs">Save as draft</button>
            </form>
            @endforeach
        </div>
        <div class="col-md-6">
            <h3>Drafts</h3>
            <hr>
            @foreach ($draftBlogs as $blog)
            <h2><a href="{{ route('blogs.show', [$blog->id]) }}">{{ $blog->title }}</a></h2>
            {!! Str::limit($blog->body, 100, '...') !!}
            <form action="{{ route('blogs.update', ['id' => $blog->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="status" value="1" style="display:none;" checked>
                <button type="submit" class="btn btn-success btn-xs">Save as published</button>
            </form>
            @endforeach    
        </div>
    </div>


</div>

@endsection