@extends('layouts.app')

@section('content')

@include('partials.tinymce')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Create a new blog</h1>
    </div>

    <div class="col-md-12">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @include('partials.error-message')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Title</label>
                <textarea id="mytextarea" name="body" class="form-control my-editor"></textarea>
            </div>

            <div class="form-group from-check form-check-inline">
                @foreach ($categories as $category)
                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input">
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label class="btn btn-default">
                    <span class="btn btn-outline btn-sm btn-info">Featured Image</span>
                    <input type="file" name="featured_image" class="form-control" hidden>
                </label>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Create a new blog</button>
            </div>
        </form>
    </div>
</div>

@endsection