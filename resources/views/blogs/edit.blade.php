@extends('layouts.app')

@section('content')
@include('partials.tinymce')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Edit - {{ $blog->title }}</h1>
    </div>

    <div class="col-md-12">
        <form action="{{ route('blogs.update', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
            </div>
            <div class="form-group">
                <label for="body">Title</label>
                {{-- <textarea name="body" class="form-control">{{ $blog->body }}</textarea> --}}
                <textarea id="mytextarea" name="body" class="form-control my-editor">{{ $blog->title }}</textarea>
            </div>

            <div class="form-group from-check form-check-inline">
                {{ $blog->category->count() ? 'Current categories: ' : '' }} &nbsp;
                @foreach ($blog->category as $category)
                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input" checked>
                    <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
            </div>

            <div class="form-group from-check form-check-inline">
                {{ $filtered->count() ? 'Unused categories: ' : '' }} &nbsp;
                @foreach ($filtered as $category)
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
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection